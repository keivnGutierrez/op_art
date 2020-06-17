<?php namespace App\Controllers;
class ActionArticle{
    private $objArt;
    public function __construct(){
        $this->objArt=new \App\Models\Article();
    }
    public function exec(){
        echo "<h1> Url no encontrada</h1>";
    }
    public function create(){
        if(!empty($_POST['title']) && !empty($_POST['contentArt'])){
            if (!isset($_SESSION['id'])){
                session_start();
            }
            $this->objArt->createNewArt($_SESSION['id'],trim($_POST['title']) ,trim($_POST['contentArt']));
            $res="Agregando...";
        }else{
            $res="Ocurrio algun error rellena todos los campos sa";
        }
        return json_encode($res);        
    }
    public function showMyArt(){
        if (!isset($_SESSION['id'])){
            session_start();
        }
        // $res=$this->objArt->showcamp(['id_article','title_article','content'],'articles','fk_user_a',$_SESSION['id']);

        $res=$this->objArt->showMyArt($_SESSION['id']);
        return json_encode($res);
    }
    public function deleteArt(){
        if(!empty($_POST['idArt'])){
            $this->objArt->delete('articles','id_article',$_POST['idArt']);
            $res="Eliminado...";
        }else{
            $res="Algo salio mal.";
        }
        return json_encode($res);
    }
    public function showDataEdit(){
        if (!empty($_POST['idArt'])) {
            $res=$this->objArt->showcamp(['title_article','content'],'articles','id_article',$_POST['idArt']);
        }
        return json_encode($res);
    }
    public function updateArt($id){
        if (!empty($_POST['titleArt']) && !empty($_POST['contentArt'])) {
            $this->objArt->update('articles','content',$_POST['contentArt'], 'id_article', $id);
            $this->objArt->update('articles','title_article',$_POST['titleArt'], 'id_article', $id);
            $res='Actualizando...';
        }else{
            $res='Tenemos un error ¿Llenaste todos los campos?';
        }
        if (!$res) {
            # code...
            $res="error";
        }
        return json_encode($res);
        
    }
    public function showDesc()
    {
        $res=$this->objArt->showArtsDesc();
        return json_encode($res);
    }
    public function showRecent()
    {
        $res=$this->objArt->ShowArtsRecent();
        return json_encode($res);
    }
    public function showOneArt()
    {
        if ($_POST['idArt']) {
            $res=$this->objArt->showOneArt($_POST['idArt']);
        }else{
            $res='Ocurrio un error';
        }
        return json_encode($res);
    }
}