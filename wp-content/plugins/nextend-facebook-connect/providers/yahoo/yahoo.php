<?php

class NextendSocialProviderYahoo extends NextendSocialProviderDummy {

    protected $color = '#720e9e';

    public function __construct() {
        $this->id    = 'yahoo';
        $this->label = 'Yahoo';
        $this->path  = dirname(__FILE__);
    }
}

NextendSocialLogin::addProvider(new NextendSocialProviderYahoo());