<?php

class NextendSocialProviderLinkedIn extends NextendSocialProviderDummy {

    protected $color = '#0274b3';

    public function __construct() {
        $this->id    = 'linkedin';
        $this->label = 'LinkedIn';
        $this->path  = dirname(__FILE__);
    }
}

NextendSocialLogin::addProvider(new NextendSocialProviderLinkedIn());