<?php namespace App\Controllers;
class ActionGenderArt{
    private $objGenderArt;
    public function __construct()
    {
        $this->objGenderArt= new \App\Models\GenderArt;
    }
    public function exec(){
        echo "<h1> Url no encontrada</h1>";
    }
    public function showGendersArt(){
        $res=$this->objGenderArt->showcamp(['id_gender','name_gender'],'genders');
        return json_encode($res);
    }
    public function create($id)
    {
        $res=$this->objGenderArt->showcamp(['id_gender','name_gender'],'genders');
        $this->objGenderArt->delete('gender_art','fk_art_g',$id);
        for ($i=0; $i <count($res) ; $i++) {
            $name='name'; 
            $name.=$i;
            if (!empty($_POST[$name])) {       
                $this->objGenderArt->createNewRegister(['DEFAULT',$id,$_POST[$name]],'gender_art');
                $resp='Actualizando...'; 
            }
        }
        if (!$resp) {
            "No se reportaron cambios";
        }
        return json_encode($resp);
    }
}