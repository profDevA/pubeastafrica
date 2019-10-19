<?php

abstract class NextendSocialProviderDummy {

    protected $id;
    protected $label;
    protected $path;

    protected $color = '#fff';

    protected $popupWidth = 600;

    protected $popupHeight = 600;

    /** @var NextendSocialLoginSettings */
    public $settings;

    /** @var NextendSocialProviderAdmin */
    protected $admin = null;

    public function needPro() {
        return true;
    }

    /**
     * @return string
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLabel() {
        return $this->label;
    }

    public function enable() {
        return false;
    }

    public function isEnabled() {
        return false;
    }

    public function isTested() {
        return false;
    }

    public function isTest() {
        return false;
    }

    public function connect() {

    }

    public function getState() {
        return 'pro-only';
    }

    public function getIcon() {
        return plugins_url('/providers/' . $this->id . '/' . $this->id . '.png', NSL_PATH_FILE);
    }

    /**
     * @return string
     */
    public function getColor() {
        return $this->color;
    }

    /**
     * @return int
     */
    public function getPopupWidth() {
        return $this->popupWidth;
    }

    /**
     * @return int
     */
    public function getPopupHeight() {
        return $this->popupHeight;
    }

    /**
     * @return mixed
     */
    public function getPath() {
        return $this->path;
    }

    /**
     * @return NextendSocialProviderAdmin
     */
    public function getAdmin() {
        return $this->admin;
    }

    /**
     * @param string $subview
     *
     * @return bool
     */
    public function adminDisplaySubView($subview) {

        return false;
    }

}