<?php
/** @var $currentProvider string */

$provider = NextendSocialLogin::$providers[$currentProvider];

$admin = $provider->getAdmin();

$admin->settingsForm();