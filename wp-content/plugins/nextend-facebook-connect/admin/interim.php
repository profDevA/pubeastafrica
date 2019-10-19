<?php
if (!defined('ABSPATH')) {
    exit;
}

global $interim_login;
$customize_login = isset($_REQUEST['customize-login']);
if ($customize_login) {
    wp_enqueue_script('customize-base');
}

$message = '<p class="message">' . __('You have logged in successfully.') . '</p>';
$interim_login = 'success';
?><!DOCTYPE html>
<!--[if IE 8]>
<html xmlns="http://www.w3.org/1999/xhtml" class="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 8) ]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>"/>
    <title><?php __('You have logged in successfully.'); ?></title>
</head>
<body class="login interim-login interim-login-success">
    <?php
    echo $message;
    /** This action is documented in wp-login.php */
    do_action('login_footer'); ?>
    <?php if ($customize_login) : ?>
        <script type="text/javascript">setTimeout(function () {
                new wp.customize.Messenger({url: '<?php echo wp_customize_url(); ?>', channel: 'login'}).send(
                    'login');
            }, 1000);</script>
    <?php endif; ?>
</body>
</html>
<?php exit;