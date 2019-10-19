<?php

class NextendSocialProviderAmazon extends NextendSocialProviderDummy {

    protected $color = '#2f292b';

    public function __construct() {
        $this->id    = 'amazon';
        $this->label = 'Amazon';
        $this->path  = dirname(__FILE__);
    }
}

NextendSocialLogin::addProvider(new NextendSocialProviderAmazon());