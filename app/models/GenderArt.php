<?php namespace App\Models;
class GenderArt{
    use crud;
    public function __construct()
    {
       $this->con=new \Complement\Connection();        
    }
    public function shearchId($fk_article,$fk_gender)
    {
        $sql="SELECT gender_art.id_gender_art FROM gender_art WHERE fk_art_g={$fk_article} AND fk_gender_a={$fk_gender}";
        $resSql=$this->con->queryReturns($sql);
        $res=mysqli_fetch_row($resSql);
        return $res;

    }
}