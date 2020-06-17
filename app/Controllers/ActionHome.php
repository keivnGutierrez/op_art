<?php namespace App\Controllers;
   use App\Models\User;
    class ActionHome{
        public function __construct(){
            $this->user =new \App\Controllers\ActionUser();
            $this->view=new \App\View\ViewLogic();
            $this->test =new \App\Controllers\ActionTest();
        
        }
        public function exec(){
            session_start();
            $this->user->sessionActive();
        }
        
        public function edit(){
            session_start();
            if (!empty($_SESSION['id'])) {                
                $this->view->sendElement('view','home');
                $data['main']=file_get_contents('Recurces/Vistas/editarSesion.html');
                $this->view->sendElement('data',$data);
                $this->view->renderView();
            }else{
                echo"<h1>URL NO ENCONTRADA.</h1>";
            }
        }
        public function test(){
            session_start();
            if (!empty($_SESSION['id'])) {
                
                $this->view->sendElement('view','test');
                $data['main']=file_get_contents('Recurces/Vistas/test.html');
                $this->view->sendElement('data',$data);
                $this->view->renderView();
            }else{
                echo"<h1>URL NO ENCONTRADA.</h1>";
            }
        }
        public function article(){
            session_start();
            if (!empty($_SESSION['id'])) {
                
                $this->view->sendElement('view','article');
                $data['main']=file_get_contents('Recurces/Vistas/article.html');
                $this->view->sendElement('data',$data);
                $this->view->renderView();
            }else{
                echo"<h1>URL NO ENCONTRADA.</h1>";
            }
        }   
        public function gender(){
            session_start();
            if (!empty($_SESSION['id'])) {
                
                // print_r($_SESSION['rol']);
                if ($_SESSION['rol']==true) {
                    $this->view->sendElement('view','genders');
                    $data['main']=file_get_contents('Recurces/Vistas/genders.html');
                    $this->view->sendElement('data',$data);
                    $this->view->renderView();
                }else{
                    $this->user->sessionActive();               
                }
            }else{
                echo"<h1>URL NO ENCONTRADA.</h1>";
            }
        }
    }