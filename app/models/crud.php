<?php namespace App\Models;
    // require_once "../../complement/connection.php";
    use Complement\Connection;
    trait Crud{
        public function createNewRegister($values=array(),$table){
            $ul=end($values);
            reset($values);
            $valuesList="";
            while($array=current($values)){
                if ($array==$ul) {
                    $valuesList.="'".$array."' ";
                }else{
                    $valuesList.="'".$array."', ";    
                }
                next($values);
            }  
            $sql="INSERT INTO {$table} VALUES( {$valuesList})";
            $this->con->simpleQuery($sql);
        }
        public function delete($table, $campo, $id){
            $sql="DELETE FROM {$table} WHERE {$campo}={$id}";
            $this->con->simpleQuery($sql);
            return $sql;
        }
        public function showCamp($camp=array(),$table){
            $campAllList=" ";
            $ul=end($camp);
            reset($camp);
            while($array=current($camp)){
                // $key[]=key($camp);
                // print_r($array);
                if ($array==$ul) {
                    $campAllList.=$array." ";
                }else{
                    $campAllList.=$array.", ";    
                }
                next($camp);
            }  
            $sql="SELECT {$campAllList} FROM {$table}";
            $resSql=$this->con->queryReturns($sql);
            while($i=$resSql->fetch_assoc()){
               $res[]=$i;
            }
            // print_r($res);
            return  $res;    
        }
        public function update($table,$camp, $newValue, $idKey, $idValue){
            $sql="UPDATE {$table} SET {$camp}='{$newValue}' WHERE {$idKey}={$idValue}";
            $this->con->simpleQuery($sql);
            return $sql;
        }
    }
?>