<?php

class NextendSocialLoginSettings {

    protected $optionKey;

    protected $settings = array(
        'default' => array(),
        'stored'  => array(),
        'final'   => array()
    );

    /**
     * NextendSocialLoginSettings constructor.
     *
     * @param $optionKey             string
     * @param $defaultSettings       array
     */
    public function __construct($optionKey, $defaultSettings) {
        $this->optionKey = $optionKey;

        $this->settings['default'] = $defaultSettings;


        $storedSettings = get_option($this->optionKey);
        if ($storedSettings !== false) {
            $storedSettings = (array)maybe_unserialize($storedSettings);
        } else {
            $storedSettings = array();
        }

        $this->settings['stored'] = array_merge($this->settings['default'], $storedSettings);

        $this->settings['final'] = apply_filters('nsl_finalize_settings_' . $optionKey, $this->settings['stored']);
    }

    public function get($key, $storage = 'final') {
        return $this->settings[$storage][$key];
    }

    public function set($key, $value) {
        $this->settings['stored'][$key] = $value;
        $this->storeSettings();
    }

    public function getAll($storage = 'final') {
        return $this->settings[$storage];
    }

    public function update($postedData) {
        if (is_array($postedData)) {
            $newData = array();
            $newData = apply_filters('nsl_update_settings_validate_' . $this->optionKey, $newData, $postedData);

            if (count($newData)) {

                $isChanged = false;
                foreach ($newData AS $key => $value) {
                    if ($this->settings['stored'][$key] != $value) {
                        $this->settings['stored'][$key] = $value;
                        $isChanged                      = true;
                    }
                }

                if ($isChanged) {
                    $allowedKeys              = array_keys($this->settings['default']);
                    $this->settings['stored'] = array_intersect_key($this->settings['stored'], array_flip($allowedKeys));

                    $this->storeSettings();
                }
            }
        }
    }

    protected function storeSettings() {
        update_option($this->optionKey, maybe_serialize($this->settings['stored']));

        $this->settings['final'] = apply_filters('nsl_finalize_settings_' . $this->optionKey, $this->settings['stored']);
    }
}