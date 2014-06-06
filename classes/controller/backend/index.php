<?php

namespace Config;

class Controller_Backend_Index extends \Config\Controller_Backend
{

    /**
     * List all config
     */
    public function action_index()
    {
        $configs = \Config::get('lbconfig.configs');
        $tabs = array();

        // Create Fieldset
        $form = \Fieldset::forge('config');

        foreach($configs as $config)
        {
            if (empty($config)) continue;
            $file = $config['file'];
            foreach($config['list'] as $key => $value)
            {
                $panelName = (isset($value['panel']) ? $value['panel'] : (isset($config['module']['panel']) ? $config['module']['panel'] : 'Config'));
                $panelClass = (isset($value['panel_class']) ? $value['panel_class'] : (isset($config['module']['panel_class']) ? $config['module']['panel_class'] : 'panel-default'));
                

                $tabName = (isset($value['tab']) ? $value['tab'] : (isset($config['module']['tab']) ? $config['module']['tab'] : 'Config'));
                $label = isset($value['label']) ? $value['label'] : $key;
                $rules = isset($value['rules']) ? $value['rules'] : array();
                $values = isset($value['values']) ? $value['values'] : array();
                // Format options
                foreach($values as $k => $v)
                {
                    if (is_numeric($k))
                    {
                        $values[$v] = $v;
                        unset($values[$k]);
                    }
                }

                $type = isset($value['type']) ? $value['type'] : (is_bool($value['value']) ? 'bool' : (empty($values) ? 'input' : 'select'));
                $value = $value['value'];

                $tabs[$tabName][$panelName]['panel_class'] = $panelClass;
                $tabs[$tabName][$panelName]['configs'][$key]['label'] = $label;
                $tabs[$tabName][$panelName]['configs'][$key]['value'] = $value;
                $tabs[$tabName][$panelName]['configs'][$key]['values'] = $values;
                $tabs[$tabName][$panelName]['configs'][$key]['type'] = $type;
                $tabs[$tabName][$panelName]['configs'][$key]['file'] = $file;

                // Add field
                $name = 'configs['.$key.'][value]';
                $form->add($name, $label, array(), $rules);
            }
        }
        $this->data['tabs'] = $tabs;

        // Form process
        if (\Input::post('add'))
        {
            // validate the input
            $form->validation()->run();

            // if validated, create the object
            if (!$form->validation()->error())
            {
                $configs = \Input::post('configs');
                foreach($configs as $key => $config)
                {
                    if ($config['type'] == 'bool')
                    {
                        $value = ($config['value'] == '1') ? true : false;
                    }
                    else
                    {
                        $value = $config['value'];
                    }

                    if (is_numeric($value)) $value = (is_float($value) ? (float)$value : (int)$value);

                    \Config::set('lbconfig.configs.'.$config['file'].'.list.'.$key.'.value', $value);
                }

                \Config::save('lbconfig', 'lbconfig');

            }
            else
            {
                foreach ($form->validation()->error() as $error)
                {
                    $this->use_message and \Messages::error($error);
                }
            }
        }

        $form->repopulate();
        $this->data['form'] = $form;
        $this->theme->get_template()->set('pageTitle', 'Config');
        $this->theme->set_partial('content', 'backend/index')->set($this->data, null, false);
    }    


}