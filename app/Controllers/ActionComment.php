<?php namespace App\Controllers;
class ActionComment{
    private $objComent;
    public function __construct(){
        $this->objComment=new \App\Models\Comment();
    }
    public function exec(){
        echo "<h1> Url no encontrada</h1>";
    }
    public function create(){
        if(!empty($_POST['idArt']) && !empty($_POST['contentComent'])){
            if (!isset($_SESSION['id'])){
                session_start();
            }
            $this->objComment->createNewComment($_POST['idArt'],$_SESSION['id'],trim($_POST['contentComent']));
            $res="Agregando...";
        }else{
            $res="Ocurrio algun error rellena todos los campos sa";
        }
        return json_encode($res);        
    }
    public function delete()
    {
        if(!empty($_POST['id'])){
            $this->objComment->delete('Comments','id_comment',$_POST['id']);
            $res="Eliminado...";
        }else{
            $res="Algo salio mal.";
        }
        return json_encode($res);
    }
    public function showComents($idArt)
    {
        $res=$this->objComment->showComments($idArt);
        return json_encode($res);
    }
}