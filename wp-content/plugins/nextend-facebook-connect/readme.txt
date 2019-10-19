=== Nextend Social Login and Register ===
Contributors: nextendweb
Tags: social login, facebook, google, twitter, linkedin, register, login, social, nextend facebook connect, social sign in
Donate link: https://www.facebook.com/nextendweb
Requires at least: 4.5
Tested up to: 5.2
Stable tag: 3.0.20
Requires PHP: 5.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

One click registration & login plugin for Facebook, Google, Twitter and more. Quick setup and easy configuration.

== Description ==

Nextend Social Login is a professional, easy to use and free WordPress plugin. It lets your visitors  register and login to your site using their social profiles (Facebook, Google, Twitter, etc.) instead of forcing them to spend valuable time to fill out the default registration form. Besides that, they don't need to wait for validation emails or keep track of their username and password anymore.

>[Demo](https://try-nextend-social-login.nextendweb.com/wp-login.php)  |  [Tutorial videos](https://www.youtube.com/watch?v=buPTza2-6xc&list=PLSawiBnEUNftt3EDqnP2jIXeh6q0pZ5D8&index=1)  |  [Docs](https://nextendweb.com/nextend-social-login-docs/documentation/)  |  [Support](https://nextendweb.com/contact-us/nextend-social-login-support/)  |  [Pro Addon](https://nextendweb.com/social-login/)

[youtube https://www.youtube.com/watch?v=buPTza2-6xc]

Nextend Social Login seamlessly integrates with your existing WordPress login and registration form. Existing users can add or remove their social accounts at their WordPress profile page. A single user can attach as many social account as they want allowing them to log in with Facebook, Google or Twitter.

#### Three popular providers: Facebook, Google and Twitter

Providers are the services which the visitors can use to register and log in to your site. Nextend Social Login allows your visitors to log in with their account from the most popular social networks: Facebook, Google and Twitter.

#### Free version features

* One click registration and login via Facebook, Google and Twitter
* Your current users can easily connect their Facebook, Google or Twitter profiles with their account
* Social accounts are tied to a WordPress user account so every account can be accessed with and without social account
* You can define custom redirect URL after the registration (upon first login) using any of the social accounts.
* You can define custom redirect URL after each login with any of the enabled social accounts.
* Display Facebook, Google, Twitter profile picture as avatar
* Login widget and shortcodes
* Customizable designs to match your site
* Editable and translatable texts on the login buttons
* Very simple to setup and use
* Clean, user friendly UI
* Fast and helpful support

#### Additional features in the [Pro addon](https://nextendweb.com/social-login/)

* WooCommerce compatibility
* Pro providers: LinkedIn, Amazon, VKontakte VK.com and more coming soon
* Configure whether email address should be asked on registration at each provider
* Configure whether username should be asked on registration at each provider
* Choose from icons or wide buttons
* Several login layouts
* Restrict specific user roles from using the social logins. (You can restrict different roles for each provider.)
* Assign specific user roles to the newly registered users who use any social login provider. (You can set different roles for each provider.)

#### Usage

After you activated the plugin configure and enable the provider you want to use, then the plugin will automatically

* add the login buttons to the WordPress login page. See screenshot #1
* add the account linking buttons to the WordPress profile page. See screenshot #2

== Frequently Asked Questions ==

= Can I make my site GDPR compliant with Nextend Social Login installed? =
Sure, Nextend Social Login provides you the tools to make your site GDPR compliant. [Check out the Nextend Social Login GDPR documentation](https://nextendweb.com/nextend-social-login-docs/gdpr/) to learn more about the topic.

= 1. Where does Nextend Social Login display the social login buttons? =
The free version of Nextend Social Login displays the social login buttons automatically on the /wp-login.php's login form and all forms made using the wp_login_form action.
You can use Nextend Social Login's widget and shortcodes if you need to display the buttons anywhere. If you need to publish the login buttons in your theme, you can use the [PHP code](https://nextendweb.com/nextend-social-login-docs/theme-developer/).

= 2. How can I get the email address from the Twitter users? =
After you set up your APP go to the Settings tab and enter the URL of your Terms of Service and Privacy Policy page. Then hit the Update your settings button. Then go to the Permissions tab and check the "Request email addresses from users" under "Additional Permissions". [There's a documentation](https://nextendweb.com/nextend-social-login-docs/provider-twitter/#get-email) that explains the process with screenshots.

= 3. Why are random email addresses generated for users registering with their FaceBook account? =
When the user tries to register with their Facebook account Facebook pops up a window where each user can view what kind of access they give for the app. In this modal they can chose not to share their email address. When they're doing so we generate a random email address for them. They can of course change this at their profile.
If the permission is given to the app, there are still [other factors](https://nextendweb.com/nextend-social-login-docs/provider-facebook/#get-email) which can result Facebook not sending back any email address.

In the Pro Addon it's possible to ask an email address if it's not returned by Facebook.

= 4. What should I do when I experience any problems? =
[Contact us](https://nextendweb.com/contact-us/nextend-social-login-support/) via email and explain the issue you have.

= 5. How can I translate the plugin? =
Find the `.pot` file at the /languages folder. From that you can start the translation process. [Drop us](https://nextendweb.com/contact-us/nextend-social-login-support/) the final `.po` and `.mo` files and we'll put them to the next releases.

= 6. I have a feature request... =
That's awesome! [Contact us](https://nextendweb.com/contact-us/nextend-social-login-support/) and let's discuss the details.

= 7. Does Nextend Social Login work with BuddyPress? =
Nextend Social Login Free version does not have BuddyPress specific settings and the login buttons will not appear there. However your users will still be able login and register at the normal WordPress login page. Then when logged in they can use every BuddyPress feature their current user role have access to.

Using the Pro Addon you can set where the login buttons should appear on the Register form and how they should look like.

== Installation ==

### Automatic installation

1. Search for Nextend Social Login through 'Plugins > Add New' interface.
2. Find the plugin box of Nextend Social Login and click on the 'Install Now' button.
3. Then activate the Nextend Social Login plugin.
4. Go to the 'Settings > Nextend' Social Connect to see the available providers.
5. Configure the provider you would like to use. (You'll find detailed instructions for each provider.)
6. Test the configuration then enable the provider.

### Manual installation

1. Download [Nextend Social Login](https://downloads.wordpress.org/plugin/nextend-facebook-connect.zip)
2. Upload Nextend Social Login through 'Plugins > Add New > Upload' interface or upload nextend-facebook-connect folder to the `/wp-content/plugins/` directory.
3. Activate the Nextend Social Login plugin through the 'Plugins' menu in WordPress.
4. Go to the 'Settings > Nextend Social Connect' to see the available providers.
5. Configure the provider you would like to use. (You'll find detailed instructions for each provider.)
6. Test the configuration then enable the provider.


== Screenshots ==

1. Nextend Social Login and Register on the main WP login page
2. Nextend Social Login and Register in the profile page for account linking

== Changelog ==
= 3.0.20 =
* Fix: Ultimate Member Auto Approve + Support Login Restriction - Avatars will be synchronized.
* Fix: Error message didn't show up when an "OAuth redirect uri proxy page" was selected.
* Feature: Shortcode - [Grid style](https://nextendweb.com/nextend-social-login-docs/theme-developer/#shortcode)
* Feature: German translation files added.
* Improvement: redirect_to URL parameter will be stronger than current page url
* Improvement: [nsl_registration_user_data](https://nextendweb.com/nextend-social-login-docs/backend-developer/) filter can now be also used
  for [preventing the registration](https://nextendweb.com/nextend-social-login-docs/backend-developer/#prevent-registration).

* PRO: Improvement: PayPal updated endpoints. New Sync Data field: PayPal account ID (payer ID)
* PRO: Removed: [PayPal Sync Data](https://nextendweb.com/nextend-social-login-docs/provider-paypal/#sync_data) fields: Date of birth, Age range, Phone, Account type, Account creation date, Time zone, Locale, Language.

= 3.0.19 =
* Fix: Shortcode - align parameter notice
* Fix: Social buttons didn't show up properly when the action where we check jQuery was called multiple times.
* Improvement: Google Select account modal before the login.

* PRO: Fix: Jetpack - display our social buttons on custom Jetpack comment form
* PRO: Feature: BuddyPress - option to disable the social buttons on the action: bp_sidebar_login_form
* PRO: Improvement: LinkedIn v2 REST API update. Getting Started section updated with the new App creation steps.
* PRO: Removed: [LinkedIn Sync data](https://nextendweb.com/nextend-social-login-docs/provider-linkedin/#sync_data)

= 3.0.18 =
* Fix:  _nsl is not defined error
* Fix:  The shortcode of [Page for register flow](https://nextendweb.com/nextend-social-login-docs/global-settings/) will be rendered into the correct position.
* Fix: Google - G+ logo is replaced with simple G logo.

* PRO: Fix: [Target window](https://nextendweb.com/nextend-social-login-docs/global-settings/#pro-settings) will open the auth window of the provider in the selected way again.
* PRO: Fix: Update notice when the Free and Pro Addon are not compatible.
* PRO: Feature: Social buttons for BuddyPress - Login widget
* PRO: Feature: Option to disable the WordPress Toolbar on the front-end for some roles.
* PRO: New provider - [Yahoo](https://nextendweb.com/nextend-social-login-docs/provider-yahoo/)
* PRO: Note: We had plans to implement the [Instagram](https://nextendweb.com/nextend-social-login-docs/provider-instagram/) provider. Unfortunately we need to change our mind, since the Instagram API will become deprecated soon!

= 3.0.17 =
* Fix: Activation fix on certain sub-domains.

= 3.0.16 =
* Fix: NSL Avatars used to override the specified BuddyPress avatars.
* Fix: 500 error when the Extended Profiles setting is disabled in BuddyPress.
* Fix: By default, users won’t be redirected to the homepage after unlinking their accounts, instead will be redirected back to the page, where the unlink action has happened.
* Fix: Nextend Social Login will now wait for jQuery before positioning the social buttons.
* Fix: Getting Started section of some providers are updated with the new App creation steps.
* Feature: Russian translation added.
* Feature: [Display avatars in “All media items”](https://nextendweb.com/nextend-social-login-docs/global-settings/) – Images can now load faster in Media Library – Grid view, when this option is enabled.
* Feature: Social button alignment option for WordPress forms, shortcode and widget.
* Feature: [Membership](https://nextendweb.com/nextend-social-login-docs/global-settings/) – is now available in the FREE version and provides support for WordPress default membership as well.
* Feature: new hook allows overriding the username and email before registration - [nsl_registration_user_data](https://nextendweb.com/nextend-social-login-docs/backend-developer/)
* Facebook – Graph API v3.2 - old API-s may require [API Call version upgrade](https://nextendweb.com/nextend-social-login-docs/facebook-upgrade-api-call/)!
* Old Nextend Facebook/Twitter/Google Connect compatibility has been removed.
* Social Buttons use flex-box layout now.


* PRO: Fix: Internet Explorer – Pro Addon activation.
* PRO: Fix: Facebook provider – Sync data: Gender, Profile link, Age range can be retrieved again.
* PRO: Feature: Social button alignment option for WooCommerce, Comment, BuddyPress, MemberPress, UserPro, Ultimate Member forms.
* PRO: Feature: [Unlink](https://nextendweb.com/nextend-social-login-docs/global-settings/) option to disable unlink buttons.
* PRO: Feature: PayPal – Option to [disable the email scope](https://nextendweb.com/nextend-social-login-docs/provider-paypal/#settings).
* PRO: Removed: Facebook provider – Sync data fields: Currency, TimeZone, Locale became deprecated.
* PRO: Improvement: Google+ API will shut down soon, so [Google Sync data](https://nextendweb.com/nextend-social-login-docs/provider-google/#sync_data) will use Google People API instead.

= 3.0.14 =
* Fix: Conflict with Login with Ajax reset password.
* Fix: BuddyPress related themes, that render the avatar with the bp_displayed_user_avatar() will be able to get the avatar of the user.
* Fix: New email and profile Google scopes, since old ones became deprecated.
* Fix: WooCommerce User Email Verification plugin prevented users with NSL from logging in.
* Fix: registerComplete function is hooked later to let other plugins send their email notifications.
* Old Nextend Twitter/Google Connect - backwards compatibility notice added. In the 3.0.15 release the backward compatibility will be removed.

* PRO: Fix: Ultimate Member - missing avatar when Support login restriction is disabled.
* PRO: Fix: Authorized domain notification when the page was authorized on non www but was visited on www or vice versa.
* PRO: New provider - [WordPress.com](https://nextendweb.com/nextend-social-login-docs/provider-wordpress-com/)
* PRO: New provider - [Disqus](https://nextendweb.com/nextend-social-login-docs/provider-disqus/)

= 3.0.13 =
* Fix: Twitter Getting Started and Settings page updated according to the new Twitter App creation.
* Fix: Won't stuck on a blank page anymore when the login and registration is blocked by WP Cerber.
* Fix: Infinite redirect loop when home page was selected as OAuth redirect uri proxy page.
* Fix: Safari will no longer close the page automatically after logging in with NSL.
* Feature: Login restriction - Some plugins are now able to prevent the login of NSL when admin approval or email verification is necessary!
* Feature: Google button skins.
* Feature: Portuguese (Brazilian) translation added.

* PRO: Fix: USM Premium prevented the authorization of NSL Pro Addon.
* PRO: Fix: WooCommerce default button layout fix for Billing.
* PRO: Fix: Separator duplication by some themes.

= 3.0.12 =
* Fix: Further changes to prevent some issues with Theme My Login.
* Fix: 'profile_update' WordPress hook won't be triggered anymore upon a registration process.
* Fix: Chrome and Android Facebook login issue via Facebook App.
* Feature: Debug menu and option to test the connection of each provider.
* Feature: Twitter - Selecting profile image size is an option now.
* Feature: Blacklisted redirects
* Feature: Nextend Social Login newsletters subscription!

* PRO: Fix: Google Sync data - Error message for Google+ API when it is not enabled.
* PRO: Feature: PayPal provider and PayPal Sync data!
* PRO: Feature: Social Buttons for MemberPress - Memberships form.
* PRO: Feature: Social Buttons for Ultimate Member forms.

= 3.0.11 =
* Fix: Twitter - 32bit and Windows servers are lost the id precision
* Feature: Jetpack SSO login form extension
* Feature: Prevent external redirect
* Feature: Added Debug menu and Provider connection test
* Theme My Login version 7 breaks Nextend Social Login, so notice displays with details

* PRO: Feature: Sync Google fields
* PRO: Feature: Sync Twitter fields

= 3.0.10 =
* Fix: display_post_states is static now

= 3.0.9 =
* Fix: Parse error for alternate login page

= 3.0.8 =
* Feature: A page can be selected which handles the extra fields for Register flow.
* Feature: A page can be selected which handles the OAuth flow.
* Feature: Spanish (Latin America) translation added.
* Feature: GDPR - add custom Terms and conditions on register.
* Feature: GDPR - retrieved fields can now be exported with the Export Personal Data tool of WordPress.
* Fix: Jetpack - Secure Sign On
* Fix: Dokan - redirection

* PRO: Feature: Authorized domain name check and notice for changed domain name.
* PRO: Feature: Option to change the button layouts for WooCommerce login/register/billing forms.
* PRO: Feature: Sync LinkedId fields

= 3.0.7 =
* Feature: AJAX compatibility
* Feature: Default Redirect URL
* Feature: Twitter screen name as username
* Fix: SocialRabbit compatibility

* PRO: New provider - [VKontakte - vk.com](https://nextendweb.com/nextend-social-login-docs/provider-vkontakte/)
* PRO: New provider - [Amazon](https://nextendweb.com/nextend-social-login-docs/provider-amazon/)
* PRO: New provider -  [UserPro Login and Register support.](https://nextendweb.com/nextend-social-login-docs/global-settings-userpro/)

= 3.0.6 =
* Avatars are stored in your media library as Facebook blocked the url access
* Code improvements
* PHP and WordPress version check
* Improved template-parts
* Fix: Login and redirect cleanup
* Fix: Socialize theme

* PRO: Sync Facebook fields
* PRO: Force to ask password and username when enabled
* PRO: MemberPress integration

= 3.0.5 =
* Session cookie name changed to properly work on Pantheon hosting. It can be changed with Can be changed with nsl_session_name filter and NSL_SESSION_NAME constant.
* Fix for Hide my WP plugin @see https://codecanyon.net/item/hide-my-wp-amazing-security-plugin-for-wordpress/4177158

= 3.0.4 =
* Remove whitespaces from username
* Provider test process renamed to "Verify Settings"
* NextendSocialLogin::renderLinkAndUnlinkButtons($heading = '', $link = true, $unlink = true) allows to display link and unlink buttons
* Link and unlink shortcode added: [nextend_social_login login="0" link="1" unlink="1" heading="Connect Social Accounts"]
* [Theme My Login](https://wordpress.org/plugins/theme-my-login/) plugin compatibility fixes.
* Embedded login form settings for wp_login_form
* Prevent account linking if it is already linked
* BuddyPress register form support and profile link and unlink buttons
* iThemes Security - Filter Long URL removed as it prevents provider to return oauth params.
* All In One WP Security - Fixed Verify Settings in providers
* Instruction when redirect Uri changes
* Added new shortcode parameter: trackerdata.

= 3.0.3 =
* Added fallback username prefix
* Fixed avatar for Google, Twitter and LinkedIn providers
* Fixed avatars on retina screen
* Optimized registration process
* Fixed Shopkeeper theme conflict
* WP HTTP api replaced the native cURL
* Twitter provider client optimization, removed force_login param, [added email permission](https://nextendweb.com/nextend-social-login-docs/provider-twitter/#get-email)
* Removed mb_strlen, so "PHP Multibyte String" not required anymore
* Fixed rare case when the redirect to last state url was missing
* Added [WebView support](https://nextendweb.com/nextend-social-login-docs/can-use-nextend-social-login-webview/) (Google buttons are hidden in WebView as Google does not allow to use)
* Fixed rare case when user can stuck in legacy mode while importing provider.

= 3.0.2 =
* Fixed upgrade script

= 3.0.1 =
* Nextend Facebook Connect renamed to Nextend Social Login and contains Google and Twitter providers too.
* Brand new UI
* Popup login
* Pro Addon

= 2.1 =
* New providers: Twitter and Google
* Major UI redesign
* API testing before a provider is enabled to eliminate possible configuration issues

= 2.0.2 =
* Fix: Fatal error: Call to undefined method Facebook\Facebook::getAccessToken()

= 2.0.1 =
* Fix: Redirect uri mismatch in spacial server environment

= 2.0.0 =
* The latest Facebook PHP API used: https://github.com/facebook/php-graph-sdk
* Facebook SDK for PHP requires PHP 5.4 or greater.
* Fix: Facebook 2.2 API does not work anymore