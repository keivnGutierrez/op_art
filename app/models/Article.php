<?php namespace App\Models;
class Article{
    use crud;
    private $con;
    public function __construct(){
        $this->con=new \Complement\Connection();
    }
    public function createNewArt($idUser,$title,$content)
    {
        $sql="INSERT INTO `articles`(`id_article`, `fk_user_a`, `title_article`, `content`, `create_add`, `alter_add`) 
        VALUES (DEFAULT,{$idUser},'{$title}','{$content}',now(),now())";
        $this->con->queryReturns($sql);
    }
    public function showMyArt($id)
    {
        $sql="SELECT articles.id_article as id, articles.title_article as titulo, articles.content as contenido, GROUP_CONCAT(genders.name_gender)tema FROM articles lEFT JOIN gender_art ON articles.id_article=gender_art.fk_art_g LEFT JOIN genders ON gender_art.fk_gender_a=genders.id_gender
        WHERE articles.fk_user_a={$id}
        GROUP BY articles.id_article ";
        $resSql=$this->con->queryReturns($sql);
       
        return $res=$this->CreatebaseArt($resSql);
    }
    public function getUser($id)
    {
        $sql="SELECT users.name_user FROM users WHERE users.id_user ={$id}";
        $resSql=$this->con->queryReturns($sql);
        $res=mysqli_fetch_assoc($resSql);
        return $res['name_user'];
        

    }
    public function showArtsDesc(){
        if (!isset($_SESSION['id'])){
            session_start();
        }
        $sql="SELECT articles.id_article as id,
        articles.title_article as title,
        LEFT(articles.content,150) as contenido,
        users.name_user as autor, 
        COUNT(comments.id_comment)num_c 
                FROM articles
                LEFT JOIN users ON articles.fk_user_a=users.id_user 
                LEFT JOIN gender_art ON articles.id_article=gender_art.fk_art_g 
                LEFT JOIN genders ON gender_art.fk_gender_a=genders.id_gender
                LEFT JOIN comments on articles.id_article=comments.fk_art_c
                GROUP BY articles.id_article 
                LIMIT 5";
        $resSql=$this->con->queryReturns($sql);
        return $res=$this->CreatebaseArt($resSql);
    }
    public function ShowArtsRecent(){
        if (!isset($_SESSION['id'])){
            session_start();
        }
        $sql="SELECT articles.id_article as id,
        articles.title_article as title, 
        LEFT(articles.content,150) as contenido,
        users.name_user as autor, 
        GROUP_CONCAT(genders.name_gender) as genero
                FROM articles
                LEFT JOIN users ON articles.fk_user_a=users.id_user 
                LEFT JOIN gender_art ON articles.id_article=gender_art.fk_art_g 
                LEFT JOIN genders ON gender_art.fk_gender_a=genders.id_gender
                GROUP BY articles.id_article 
                ORDER BY articles.create_add DESC
                LIMIT 5";
        $resSql=$this->con->queryReturns($sql);
        return $res=$this->CreatebaseArt($resSql);
    }
    public function showOneArt($id)
    {
        $sql="SELECT 
        articles.id_article as id,
        articles.title_article as title,
        articles.content as content,
        articles.create_add as fecha,
        GROUP_CONCAT(genders.name_gender),
        users.name_user as autor
        FROM articles
        LEFT JOIN users ON articles.fk_user_a=users.id_user
        LEFT JOIN gender_art ON articles.id_article=gender_art.fk_art_g
        LEFT JOIN genders ON gender_art.fk_gender_a=genders.id_gender 
        WHERE (articles.id_article={$id})
        GROUP BY title";
        $resSql=$this->con->queryReturns($sql);
        return $res=mysqli_fetch_assoc($resSql);
    }
    public function CreatebaseArt($datasql){
        while($i=$datasql->fetch_assoc()){
            $res[]=$i;
        }
        if(!isset($res)){
            $res='No ha sido incluido ningun Articulo.';
        }
        return $res;
    }
}