<?php namespace App\Controllers;
//    use App\Models\User;  
    class ActionUser{
        private $man;
        public function __construct(){ 
           $this->man =new \App\Models\User();
           $this->view=new \App\View\ViewLogic();
        } 
        public function exec($data= array())
        {
            session_start();
            $this->sessionActive();
        }
        public function log(){            
            if ($_POST) {
                    if (!empty($_POST['mail']) && !empty($_POST['pass'])) {
                    $res=$this->man->log($_POST['mail'],$_POST['pass']);
                    switch ($res) {
                        case 'iniciando':                            
                            header('location: /Op-Art/Home/');
                            break;
                        case 'email':
                            $data=array('mesaje'=>'La contraseña es incorrecta');
                            $this->sessionActive($data);
                            break;
                        case 'nada':
                            $data=array('mesaje'=>'El usuario no esta registrado');
                            $this->sessionActive($data);      
                            break;
                        default:
                            break;
                    }                                        
                }
                else{    
                    header('location: /one_article/publico/');   
                }   
            }else{
                session_start();
                $this->sessionActive();
            }
            // return 'echo json_encode("hola")';
        }
        public function closeSession(){
            $this->man->closeSession();
            header('location: /Op-Art/');
        }
        public function sessionActive($data=array('mesaje'=>'Introduce tu correo y contraseña')){
            if (!empty($_SESSION['id'])) {
                $this->view->sendElement('view','home');
                $data['main']=file_get_contents('Recurces/Vistas/home.html');
                $data['name']=$this->man->showcamp(['name_user'],'users','id_user',$_SESSION['id'])[0]['name_user'];
                $this->view->sendElement('data',$data);
                $this->view->renderView();
            }else{
                $this->view->sendElement('data', $data);
                $this->view->sendElement('view','log');    
                $this->view->renderView();
            }
        }
        public function edit($camp){
            if(!empty($_POST['new'])){
                session_start();
                $this->man->update('users',$camp,trim($_POST['new']), 'id_user',$_SESSION['id']);
                $res="Sus datos fueron actualizados";
            }else{
                $res="Ocurrio un error al actualizar su datos";
            }
            return json_encode($res);
        }
        public function validateUser(){
            $validate=false;
            if(!empty($_SESSION['id'])){
                $validate=true;
            }
            return $validate;
        }
        public function rol( )
        {
            session_start();
            return json_encode($_SESSION['rol']);
        }
    }