<?php
Class BaseApp{

    private $_components;
    private $_controller;

    /**
     * @param $object
     */
    protected function setController($object){
        if(!$this->_controller)
            $this->_controller = $object;
    }

    /**
     * @return mixed
     */
    public function getController(){
        return $this->_controller;
    }

    /**
     * BaseApp constructor.
     * @param $config
     */
    public function __construct($config)
    {
        if(is_string($config))
            $config = require $config;

        if(isset($config['components']) && is_array($config['components']) && !empty($config['components'])){
            foreach ($config['components'] as $component => $componentConfig){
                $this->_components[$component] = $this->createComponent($component,$componentConfig);
            }
        }
    }

    /**
     * @param $component
     * @param $componentConfig
     * @return mixed
     */
    public function createComponent($component,$componentConfig){
        return new $component($componentConfig);
    }

    public function __get($name)
    {
        if(isset($this->_components[$name]))
            return $this->_components[$name];
        elseif (isset($this->{$name}))
            return $this->{$name};
        return null;
    }
}