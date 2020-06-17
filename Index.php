<?php namespace Publico;
    require_once "Config/Autoload.php";
    use Config\Autoload;
    \Config\Autoload::startAutoload();
    $router=new \Complement\ Router();
    $uri=$router->getUri();
    $controller=$router->getController();
    $method=$router->getMethod();
    $param=$router->getParam();
    // $res="lsito";
    switch ($controller) {
        case 'User':
                $instanciaConroller=new \App\Controllers\ActionUser;
            break;
        case 'Home':
                $instanciaConroller=new \App\Controllers\ActionHome;
            break;
        case 'Test':
                $instanciaConroller=new \App\Controllers\ActionTest;
            break;
        case 'Gender':
                $instanciaConroller=new \App\Controllers\ActionGender;
            break;
        case 'Article':
                $instanciaConroller=new \App\Controllers\ActionArticle;
            break;
        case 'GenderArt':
                $instanciaConroller=new \App\Controllers\ActionGenderArt;
            break;
        case 'Comment':
                $instanciaConroller=new \App\Controllers\ActionComment;
            break;
        default:
                echo "<h1> Url no encontrada</h1>";
            break;
    }
    if (!empty($instanciaConroller)) {
        if (!empty($param)) {
            $res=$instanciaConroller->$method($param);
            print_r($res);
        }else{
            $res=$instanciaConroller->$method();
            print_r($res);
        }
    }
    
    // session_start();
    // print_r($_SESSION['rol']);
    // print_r($_SESSION['id']);
    // echo json_encode("skadjsla");
    // echo "URI :".print_r($uri)."<br> CONTROLLER :".$controller."<br> METHOD : ".$method."<br> PARAM :".$param.'<br>';
    // print_r($_SERVER['REQUEST_URI']);
    
   