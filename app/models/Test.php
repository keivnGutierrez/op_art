<?php namespace App\Models;
// require_once "Crud.php";
// id_test	type_learning	description_t_l
class Test{
    use crud ;
    private $con;
    public function __construct(){
        $this->con=new \Complement\Connection();
    }
}
// $resul= new Test;
// $resul->createNewRegister(['DEFAULT', 'Reflexivo','skadjlaksjdlkasjdlorm'],'tests');
// $res=$resul->showcamp(['type_learning','description_t_l'],'tests');
// print_r($res);
//  $resul->update('tests','description_t_l','El aprendizaje reflexivo es un tipo de apredizaje donde necesitas analizar mas las cosas para comprederlas', 'id_test', 1);
// $resul->delete('tests','id_test',2);