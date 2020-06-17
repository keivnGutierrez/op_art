<?php namespace Complement;
    class Connection{
        private $data = array(
        'host' => 'localhost',
        'user'=>'root',
        'pass'=>'',
        'db'=>'one_article' );
        private $con;
        public function __construct(){
            $this->con=new \mysqli(
                $this->data['host'],
                $this->data['user'],$this->data['pass'],
                $this->data['db']
            );
        }
        public function simpleQuery($sql){
            $this->con->query($sql);
        }
        public function queryReturns($sql){
            $data=$this->con->query($sql);
            return $data;
        }
    } 