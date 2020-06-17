<?php namespace App\Models;
class Comment{
    use crud ;
    public function __construct(){
        $this->con=new \Complement\Connection();
    }
    public function createNewComment($idArt,$idUser,$cont){
        $sql="INSERT INTO `comments`(`id_comment`, `fk_art_c`, `fk_user_c`, `content_comment`, `create_add`) VALUES (DEFAULT,{$idArt},{$idUser},'{$cont}',now())";
        $this->con->queryReturns($sql);
   }
    public function showComments($idArt){
        if (!isset($_SESSION['id'])){
            session_start();
        }
	
        $sql="SELECT comments.id_comment, 
        comments.fk_user_c,users.name_user,
        comments.content_comment  
        FROM comments 
        INNER JOIN users 
        ON comments.fk_user_c=users.id_user 
        WHERE comments.fk_art_c={$idArt}
        ORDER BY comments.create_add DESC";
        $resSql=$this->con->queryReturns($sql);
        $id=0;
        while($i=$resSql->fetch_assoc()){
            $res[]=$i;
            if ($i['fk_user_c']==$_SESSION['id']) {
                $res[$id]['status']=true;
            }else{
                $res[$id]['status']=false;
            }
            $id++;
        }
        if(!isset($res)){
            $res='No ha sido incluido ningun registro.';
        }
        return $res;
    }
}