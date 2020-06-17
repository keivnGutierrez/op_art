<?php namespace App\Models;
    class User{
        use Crud;
        public $id='DEFAULT';
        public $nameUser;
        public $email;
        private $passUser;
        private $con;
        public function __construct(){
            $this->con=new \Complement\Connection();
        }
       public function log($mail,$pass) {
            $this->email=$mail;
            $this->passUser=$pass;
            $sql="SELECT id_user FROM users WHERE email='{$this->email}' AND password_user='{$this->passUser}'";
            $resSql=$this->con->queryReturns($sql);          
            $estado=$this->ValidateUserLog($resSql);
            return $estado;
        }
       private function ValidateUserLog($res){      
        $estado="nada";    
        if (!empty($res)) {
                $user=$res->fetch_assoc();
                if(!empty($user['id_user'])){
                    session_start(); 
                    $_SESSION['id']=$user['id_user'];
                    $sql="SELECT rol FROM users WHERE id_user={$user['id_user']}";
                    $resSql=$this->con->queryReturns($sql);   
                    $i=$resSql->fetch_assoc();
                    $_SESSION['rol']=$i['rol'];
                    $estado="iniciando";
                }else{
                    $sqlEamil="SELECT id_user FROM users WHERE email='{$this->email}'";
                    $resSqlEmail=$this->con->queryReturns($sqlEamil);
                    if($resSqlEmail){
                        $resEmail=$resSqlEmail->fetch_assoc();
                        if(isset($resEmail['id_user'])){
                            $estado="email";
                        }else{
                            $estado="nada";
                        }                        
                    }
                }                
            }
            return $estado;
       }
       public function closeSession(){
            if(!isset($_SESSION)){
                session_start();
            }
           session_destroy();
       }
    }
    // $kevin = new User();
    // $kevin->update('users','name_user','kevin gutierrez', 'id_user', 1);
    
    // $res=$kevin->showcamp(['name_user','email'],'users');
    // print_r($res);

    // $kevin->createNewRegister(['DEFAULT', 'kevin','kaksdlj@gmail.com','contraseña'],'users');
    // $kevin->log('keivn@gmail.com','contraseña');
    
