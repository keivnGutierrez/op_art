<?php namespace App\View;
class ViewLogic{
    public $dictionary=array();
    public $view;
    public $data;
    public function getElment($element){
        return $this->$element;
    }
    public function sendElement($element, $value){
        $this->$element=$value;
    }
    public function identifier(){        
        switch ($this->view) {
            case 'home':
                $this->view='layout';
                $identifier=array('main',"name");
                break;
            case 'log':
                $identifier=array('mesaje');
                break;
            case 'editUser':
                $this->view='layout';
                $identifier=array('main');
                break;
            case 'test':
                $this->view='layout';
                $identifier=array('main');
                break;
            case 'genders':
                $this->view='layout';
                $identifier=array('main');
                break;
            case 'article':
                $this->view='layout';
                $identifier=array('main');
                break;
            default:
                break;
        }
        return $identifier;
    }
    public function NewDictionary(){
        $identifier=$this->identifier();
        foreach ($identifier as $iden) {
            if(array_key_exists($iden, $this->data)){
                $this->dictionary[$iden]=$this->data[$iden];
            }
        }
    } 
    public function renderView(){
        $html="";
        if(($this->view)&&($this->data)){
            $this->NewDictionary();
            if($this->dictionary){
                $html=file_get_contents('Recurces/Vistas/'.$this->view.'.html');
                foreach($this->dictionary as $key=>$value){
                    $html=str_replace('{'.$key.'}',$value,$html);
                }
            }
        }elseif($this->view){
            $html=file_get_contents('../Recurces/Vistas/'.$this->view.'.html');
        }
        print $html;
    }
}