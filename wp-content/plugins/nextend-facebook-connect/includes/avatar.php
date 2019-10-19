<?php

class NextendSocialLoginAvatar {

    /**
     * @return NextendSocialLoginAvatar
     */
    public static function getInstance() {
        static $inst = null;
        if ($inst === null) {
            $inst = new self();
        }

        return $inst;
    }


    public function __construct() {
        if (NextendSocialLogin::$settings->get('avatar_store')) {
            add_action('nsl_update_avatar', array(
                $this,
                'updateAvatar'
            ), 10, 3);

            // WP User Avatar https://wordpress.org/plugins/wp-user-avatar/
            // Ultimate member
            if (!defined('WPUA_VERSION') && !class_exists('UM', false) && !class_exists('buddypress', false)) {
                add_filter('get_avatar', array(
                    $this,
                    'renderAvatar'
                ), 5, 6);

                add_filter('bp_core_fetch_avatar', array(
                    $this,
                    'renderAvatarBP'
                ), 3, 2);

                add_filter('bp_core_fetch_avatar_url', array(
                    $this,
                    'renderAvatarBPUrl'
                ), 3, 2);

            }

            add_filter('post_mime_types', array(
                $this,
                'addPostMimeTypeAvatar'
            ));

            add_filter('ajax_query_attachments_args', array(
                $this,
                'modifyQueryAttachmentsArgs'
            ));
        }
    }

    public function addPostMimeTypeAvatar($types) {
        $types['avatar'] = array(
            __('Avatar', 'nextend-facebook-connect'),
            __('Manage Avatar', 'nextend-facebook-connect'),
            _n_noop('Avatar <span class="count">(%s)</span>', 'Avatar <span class="count">(%s)</span>', 'nextend-facebook-connect')
        );

        return $types;
    }

    public function modifyQueryAttachmentsArgs($query) {
        if (!isset($query['meta_query']) || !is_array($query['meta_query'])) {
            $query['meta_query'] = array();
        }
        if ($query['post_mime_type'] === 'avatar') {
            $query['post_mime_type']         = 'image';
            $query['meta_query']['relation'] = 'AND';
            $query['meta_query'][]           = array(
                'key'     => '_wp_attachment_wp_user_avatar',
                'compare' => 'EXISTS'
            );
        } else {
            $avatars_in_all_media = NextendSocialLogin::$settings->get('avatars_in_all_media');

            //Avatars will be loaded in Media Libray Grid view - All media items if $avatars_in_all_media is disabled!
            if (!$avatars_in_all_media) {
                $query['meta_query']['relation'] = 'AND';
                $query['meta_query'][]           = array(
                    'key'     => '_wp_attachment_wp_user_avatar',
                    'compare' => 'NOT EXISTS'
                );
            }
        }

        return $query;
    }

    /**
     * @param NextendSocialProvider $provider
     * @param                       $user_id
     * @param                       $avatarUrl
     */
    public function updateAvatar($provider, $user_id, $avatarUrl) {
        global $blog_id, $wpdb;
        if (!empty($avatarUrl)) {

            if (class_exists('UM', false)) {
                require_once(ABSPATH . '/wp-admin/includes/file.php');
                $profile_photo = get_user_meta($user_id, 'profile_photo', true);
                if (empty($profile_photo)) {
                    $extension = 'jpg';
                    if (preg_match('/\.(jpg|jpeg|gif|png)/', $avatarUrl, $match)) {
                        $extension = $match[1];
                    }
                    $avatarTempPath = download_url($avatarUrl);
                    if (!is_wp_error($avatarTempPath)) {
                        $filename     = pathinfo($avatarTempPath, PATHINFO_FILENAME);
                        $UMUploadTemp = UM()->files()->upload_temp . $filename . '/';
                        if (wp_mkdir_p($UMUploadTemp)) {
                            if (rename($avatarTempPath, $UMUploadTemp . $filename . '.' . $extension)) {
                                UM()
                                    ->files()
                                    ->new_user_upload($user_id, $UMUploadTemp . $filename . '.' . $extension, 'profile_photo');
                            }
                        }
                    }

                    UM()
                        ->user()
                        ->remove_cache($user_id);
                };

                return;
            }

            //upload user avatar for BuddyPress - bp_displayed_user_avatar() function
            if (class_exists('BuddyPress', false)) {
                if (!empty($avatarUrl)) {
                    $extension = 'jpg';
                    if (preg_match('/\.(jpg|jpeg|gif|png)/', $avatarUrl, $match)) {
                        $extension = $match[1];
                    }

                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    $avatarTempPath = download_url($avatarUrl);

                    if (!is_wp_error($avatarTempPath)) {
                        if (!function_exists('xprofile_avatar_upload_dir')) {
                            require_once(buddypress()->plugin_dir . '/bp-xprofile/bp-xprofile-functions.php');
                        }
                        $pathInfo = xprofile_avatar_upload_dir('avatars', $user_id);

                        if (wp_mkdir_p($pathInfo['path'])) {
                            if ($av_dir = opendir($pathInfo['path'] . '/')) {
                                $hasAvatar = false;
                                while (false !== ($avatar_file = readdir($av_dir))) {
                                    if ((preg_match("/-bpfull/", $avatar_file) || preg_match("/-bpthumb/", $avatar_file))) {
                                        $hasAvatar = true;
                                        break;
                                    }
                                }
                                if (!$hasAvatar) {
                                    copy($avatarTempPath, $pathInfo['path'] . '/' . 'avatar-bpfull.' . $extension);
                                    rename($avatarTempPath, $pathInfo['path'] . '/' . 'avatar-bpthumb.' . $extension);
                                }
                            }
                            closedir($av_dir);
                        }
                    }
                }
            }


            /**
             * $original_attachment_id is false, if the user has had avatar set but the path is not found.
             */
            $original_attachment_id = get_user_meta($user_id, $wpdb->get_blog_prefix($blog_id) . 'user_avatar', true);
            if ($original_attachment_id && !get_attached_file($original_attachment_id)) {
                $original_attachment_id = false;
            }
            $overwriteAttachment = false;
            /**
             * Overwrite the original attachment if avatar was set and the provider attachment exits.
             */
            if ($original_attachment_id && get_post_meta($original_attachment_id, $provider->getId() . '_avatar', true)) {
                $overwriteAttachment = true;
            }

            if (!$original_attachment_id) {
                /**
                 * If the user unlink and link the social provider back the original avatar will be used.
                 */
                $args  = array(
                    'post_type'   => 'attachment',
                    'post_status' => 'inherit',
                    'meta_query'  => array(
                        array(
                            'key'   => $provider->getId() . '_avatar',
                            'value' => $provider->getAuthUserData('id')
                        )
                    )
                );
                $query = new WP_Query($args);
                if ($query->post_count > 0) {
                    $original_attachment_id = $query->posts[0]->ID;
                    $overwriteAttachment    = true;
                    update_user_meta($user_id, $wpdb->get_blog_prefix($blog_id) . 'user_avatar', $original_attachment_id);
                }
            }

            /**
             * If there was no original avatar or overwrite mode is on, download the avatar of the selected provider.*
             */
            if (!$original_attachment_id || $overwriteAttachment === true) {
                require_once(ABSPATH . '/wp-admin/includes/file.php');

                $avatarTempPath = download_url($avatarUrl);
                if (!is_wp_error($avatarTempPath)) {
                    $mime        = wp_get_image_mime($avatarTempPath);
                    $mime_to_ext = apply_filters('getimagesize_mimes_to_exts', array(
                        'image/jpeg' => 'jpg',
                        'image/png'  => 'png',
                        'image/gif'  => 'gif',
                        'image/bmp'  => 'bmp',
                        'image/tiff' => 'tif',
                    ));

                    /**
                     * If the uploaded image has extension from the mime type and it is appear in the $mime_to_ext.
                     * Make a unique filename, depending on the extension.
                     * Copy the downloaded file with the new name to the uploads path.
                     * Unlin the downloaded file.
                     */
                    if (isset($mime_to_ext[$mime])) {

                        $wp_upload_dir = wp_upload_dir();
                        $filename      = 'user-' . $user_id . '.' . $mime_to_ext[$mime];

                        $filename = wp_unique_filename($wp_upload_dir['path'], $filename);

                        $newAvatarPath = trailingslashit($wp_upload_dir['path']) . $filename;
                        $newFile       = @copy($avatarTempPath, $newAvatarPath);
                        @unlink($avatarTempPath);

                        if (false !== $newFile) {
                            $url = $wp_upload_dir['url'] . '/' . basename($filename);

                            if ($overwriteAttachment) {
                                $originalAvatarImage = get_attached_file($original_attachment_id);

                                // we got the same image, so we do not want to store it
                                if (md5_file($originalAvatarImage) === md5_file($newAvatarPath)) {
                                    @unlink($newAvatarPath);
                                } else {
                                    // Store the new avatar and remove the old one
                                    @unlink($originalAvatarImage);
                                    update_attached_file($original_attachment_id, $newAvatarPath);

                                    // Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
                                    require_once(ABSPATH . 'wp-admin/includes/image.php');

                                    wp_update_attachment_metadata($original_attachment_id, wp_generate_attachment_metadata($original_attachment_id, $newAvatarPath));

                                    update_user_meta($user_id, $wpdb->get_blog_prefix($blog_id) . 'user_avatar', $original_attachment_id);
                                }
                            } else {
                                $attachment = array(
                                    'guid'           => $url,
                                    'post_mime_type' => $mime,
                                    'post_title'     => '',
                                    'post_content'   => '',
                                    'post_status'    => 'private',
                                );

                                $new_attachment_id = wp_insert_attachment($attachment, $newAvatarPath);
                                if (!is_wp_error($new_attachment_id)) {

                                    // Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
                                    require_once(ABSPATH . 'wp-admin/includes/image.php');

                                    wp_update_attachment_metadata($new_attachment_id, wp_generate_attachment_metadata($new_attachment_id, $newAvatarPath));

                                    update_post_meta($new_attachment_id, $provider->getId() . '_avatar', $provider->getAuthUserData('id'));
                                    update_post_meta($new_attachment_id, '_wp_attachment_wp_user_avatar', $user_id);

                                    update_user_meta($user_id, $wpdb->get_blog_prefix($blog_id) . 'user_avatar', $new_attachment_id);
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function renderAvatar($avatar = '', $id_or_email, $size = 96, $default = '', $alt = false, $args = array()) {
        global $blog_id, $wpdb;

        $id = 0;
        /**
         * Get the user id depending on the $id_or_email, it can be the user id, email and object.
         */
        if (is_numeric($id_or_email)) {
            $id = $id_or_email;
        } else if (is_string($id_or_email)) {
            $user = get_user_by('email', $id_or_email);
            if ($user) {
                $id = $user->ID;
            }
        } else if (is_object($id_or_email)) {
            if (!empty($id_or_email->comment_author_email)) {
                $user = get_user_by('email', $id_or_email->comment_author_email);
                if ($user) {
                    $id = $user->ID;
                }
            } else if (!empty($id_or_email->user_id)) {
                $id = $id_or_email->user_id;
            }
        }
        if ($id == 0) {
            return $avatar;
        }

        $url = '';

        /**
         * Get the avatar attachment id of the user.
         */
        $attachment_id = get_user_meta($id, $wpdb->get_blog_prefix($blog_id) . 'user_avatar', true);
        if (wp_attachment_is_image($attachment_id)) {
            $get_size        = is_numeric($size) ? array(
                $size,
                $size
            ) : $size;
            $image_src_array = wp_get_attachment_image_src($attachment_id, $get_size);

            $url = $image_src_array[0];

            if (is_numeric($size)) {
                $args['width']  = $image_src_array[1];
                $args['height'] = $image_src_array[2];
            }
        }

        if (empty($url)) {
            $url = NextendSocialLogin::getAvatar($id);
        }

        if (!$url) {
            return $avatar;
        }

        if (defined('IS_PROFILE_PAGE') && IS_PROFILE_PAGE) {
            add_filter('user_profile_picture_description', array(
                $this,
                'removeProfilePictureGravatarDescription'
            ));
        }

        $class = array(
            'avatar',
            'avatar-' . (int)$args['size'],
            'photo'
        );

        if ($args['class']) {
            if (is_array($args['class'])) {
                $class = array_merge($class, $args['class']);
            } else {
                $class[] = $args['class'];
            }
        }

        return sprintf("<img alt='%s' src='%s' class='%s' height='%d' width='%d' %s/>", esc_attr($args['alt']), esc_url($url), esc_attr(join(' ', $class)), (int)$args['height'], (int)$args['width'], $args['extra_attr']);
    }

    public function renderAvatarBP($avatar, $params) {

        if (strpos($avatar, 'gravatar.com', 0) > -1) {

            $avatar = $this->renderAvatar($avatar, ($params['object'] == 'user') ? $params['item_id'] : '', ($params['object'] == 'user') ? (($params['type'] == 'thumb') ? 50 : 150) : 50, '', '');
        }

        return $avatar;
    }

    public function renderAvatarBPUrl($avatar, $params) {

        if (strpos($avatar, 'gravatar.com', 0) > -1) {

            $avatar = $this->renderAvatar($avatar, ($params['object'] == 'user') ? $params['item_id'] : '', ($params['object'] == 'user') ? (($params['type'] == 'thumb') ? 50 : 150) : 50, '', '');
        }

        return $avatar;
    }

    public function removeProfilePictureGravatarDescription($description) {
        if (strpos($description, 'Gravatar') !== false) {
            return '';
        }

        return $description;
    }
}

NextendSocialLoginAvatar::getInstance();