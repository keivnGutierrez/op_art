<?php namespace App\Controllers;
    class ActionTest{
        private $classTest;
        public function __construct(){
            $this->classTest=new \App\Models\Test();            
        }
        public function exec(){
            echo "<h1> Url no encontrada</h1>";
        }
        public function create(){
            if( !empty($_POST['type_learning']) && !empty($_POST['description']) ){
                $this->classTest->createNewRegister([ 'DEFAULT', trim($_POST['type_learning']),trim($_POST['description'])],'tests');
                // $this->clashome->test();
                $res="Agregando...";
            }else{
                $res="Ocurrio algun error rellena todos los campos";
            }
            return json_encode($res);    
        }
        public function showTest()
        {
            $res=$this->classTest->showcamp(['id_test','type_learning','description_t_l'],'tests');
           return json_encode($res);
        }
        function showDataEdit(){
            if (!empty($_POST['idTest'])) {
                $res=$this->classTest->showcamp(['type_learning','description_t_l'],'tests','id_test',$_POST['idTest']);
            }
            return json_encode($res);
        }
        public function deleteTest(){
            if(!empty($_POST['idTest'])){
                $this->classTest->delete('tests','id_test',$_POST['idTest']);
                $res="Eliminado...";
            }else{
                $res="Algo salio mal";
            }
            return json_encode($res);
        }
        public function updateTest($id){
            if (!empty($_POST['type_learning']) && !empty($_POST['description'])) {
                $this->classTest->update('tests','description_t_l',$_POST['description'], 'id_test', $id);
                $this->classTest->update('tests','type_learning',$_POST['type_learning'], 'id_test', $id);
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