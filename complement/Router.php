<?php namespace Complement;
class Router {
    private $uri;
    private $controller;
    private $method;
    private $param;
    public function __construct(){
        $this->setUri();
        $this->setController();
        $this->setMethod();
        $this->setParam();
    }
    public function setUri(){
        $this->uri=explode('/',$_SERVER['REQUEST_URI']);
    }
    public function setController(){
        $this->controller=$this->uri[2]===""? 'Home':$this->controller=$this->uri[2];
    }
    public function setMethod(){
        $this->method= empty($this->uri[3])? "exec": $this->method=$this->uri[3] ;
    }
    public function setParam(){
        $this->param =empty($this->uri[4])? "":$this->param=$this->uri[4];
    }
    public function getUri(){
        return $this->uri;
    }
    public function getController(){
        return $this->controller;
    }
    public function getMethod(){
        return $this->method;
    }
    public function getParam(){
        return $this->param;
    }
}