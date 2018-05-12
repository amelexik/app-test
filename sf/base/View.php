<?php

class View
{

    protected $data;
    protected $path;

    protected static function getDefaultViewPath()
    {
        $router = Sf::app()->Router;
        if (!$router) {
            return null;
        }
        $controller_dir = $router->getController();
        $template_name = $router->getAction() . '.php';

        return VIEWS_PATH . DS . $controller_dir . DS . $template_name;
    }

    /**
     * @return null|string
     */
    protected static function getLayoutViewPath()
    {
        $controller = Sf::app()->getController();
        if (!$controller) {
            return null;
        }


        if (!empty($controller->layout)) {
            return LAYOUT_PATH . DS . $controller->layout . '.php';
        }
        return null;
    }

    public function __construct($data = array(), $path = null)
    {
        if (!$path) {
            $path = self::getDefaultViewPath();
        }
        if (!file_exists($path)) {
            throw new Exception('Template file is not found in path: ' . $path);
        }
        $this->path = $path;
        $this->data = $data;
    }

    public function render()
    {
        $output = $this->renderFile($this->path, $this->data);
        if ($layout = $this::getLayoutViewPath()){
            $content = $output;
            ob_start();
            include($layout);
            $returnContent = ob_get_clean();
            echo $returnContent;
        }
        echo $output;
    }

    public function renderFile($view, $data)
    {
        $data = $data;
        ob_start();
        include($view);
        $content = ob_get_clean();
        return $content;
    }

}
