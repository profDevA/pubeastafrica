<?php

class NextendSocialProviderVK extends NextendSocialProviderDummy {

    protected $color = '#45668e';

    public function __construct() {
        $this->id    = 'vk';
        $this->label = 'VKontakte';
        $this->path  = dirname(__FILE__);
    }
}

NextendSocialLogin::addProvider(new NextendSocialProviderVK());