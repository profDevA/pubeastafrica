<?php

class NextendSocialProviderPaypal extends NextendSocialProviderDummy {

    protected $color = '#3b7bbf';

    public function __construct() {
        $this->id    = 'paypal';
        $this->label = 'PayPal';
        $this->path  = dirname(__FILE__);
    }
}

NextendSocialLogin::addProvider(new NextendSocialProviderPaypal());