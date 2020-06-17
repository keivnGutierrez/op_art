<?php namespace App\Controllers;
class ActionGender{
    private $objGender;
    public function __construct(){
        $this->objGender=new \App\Models\Gender();
    }
    public function create(){
        if(!empty($_POST['name_gender']) && !empty($_POST['description_gender'])){
            $this->objGender->createNewRegister(['DEFAULT',trim($_POST['name_gender']),trim($_POST['description_gender'])],'genders');
            $res="Agregando...";
        }else{
            $res="Ocurrio algun error rellena todos los campos sa";
        }
        return json_encode($res);        
    }
    public function showGenders(){
        $res=$this->objGender->showcamp(['id_gender','name_gender','description_gender'],'genders');
        return json_encode($res);
    }
    
    public function deleteGender(){
        if(!empty($_POST['idGender'])){
            $this->objGender->delete('genders','id_gender',$_POST['idGender']);
            $res="Eliminado...";
        }else{
            $res="Algo salio mal.";
        }
        return json_encode($res);
    }
    function showDataEdit(){
        if (!empty($_POST['idGender'])) {
            $res=$this->objGender->showcamp(['name_gender','description_gender'],'genders','id_gender',$_POST['idGender']);
        }
        return json_encode($res);
    }
    public function exec(){
        echo "<h1> Url no encontrada</h1>";
    }
    public function updateGender($id){
        if (!empty($_POST['gender']) && !empty($_POST['descriptionGender'])) {
            $this->objGender->update('genders','description_gender',$_POST['descriptionGender'], 'id_gender', $id);
            $this->objGender->update('genders','name_gender',$_POST['gender'], 'id_gender', $id);
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
}
