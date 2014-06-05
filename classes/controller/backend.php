<?php

namespace Config;

class Controller_Backend extends \Controller_Base_Backend
{
    public $module = 'config';
    public $dataGlobal = array();
    public $media = false;

    public function before() {
        if (\Input::is_ajax())
        {
            return parent::before();
        }
        else
        {
            parent::before();
        }
        
        // Load language
        \Lang::load('config', true);

        // Message class exist ?
        $this->use_message = class_exists('\Messages');

        // Use Casset ?
        $this->casset = (\Config::get('lb.theme.use_casset') && class_exists('\Casset'));

        // Set Media
        $this->setModuleMedia();
    }

    public function setModuleMedia()
    {
        // If media already set
        if ($this->media) return true;

        if ($this->casset)
        {
            $activeTheme = $this->theme->active();
            \Casset::add_path('theme', $activeTheme['asset_base']);
        }

        is_callable('parent::setModuleMedia') and parent::setModuleMedia();

        $this->media = true;
    }

}