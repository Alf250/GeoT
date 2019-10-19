<?php
    include_once 'ExtracionGeneralController.php';
    include_once 'ExtracionEspecificaController.php';
    include_once 'ErrorController.php';
    //include_once 'Controllers/TileController.php';
    //include_once 'Controllers/ValidacionController.php';

    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");

    $all = new ExtracionGeneralController();
    $sel = new ExtracionEspecificaController();
    //$validar = new ValidacionController();
    //$tile = new TileController();
    $error = new ErrorController();

    if(isset($_GET['url'])){
        $item = $_GET['url'];
        $numero = intval(preg_replace('/[^0-9]+/','',$item),10);
        if($_SERVER['REQUEST_METHOD']=='GET'){
            switch($item){
                /*case "Tile/Show";
                    $tile->All();
                break;
                case "Tile/$numero";
                    $tile->Sel($numero);
                break;*/
                case "All/Show";
                    $all->All();
                break; 
                case "All/$numero";
                    $sel->Sel($numero);
                break;
                default;
                    $error->Mensaje('La direcion URL no existe');
                break;
            }

        }else if($_SERVER['REQUEST_METHOD']=='POST'){
            $body = file_get_contents('php://input');
            
            if(json_last_error()==0){
                switch($item){
                    default;
                        $error->Mensaje("La direcion URL no existe");
                    break;
                }
            }else{
                $error->Mensaje("Solo acepta archivos .json o la estructura del archivo tiene un error");
            }

        }else if($_SERVER['REQUEST_METHOD']=='PUT'){
            $body = file_get_contents('php://input');
            
            if(json_last_error()==0){
                switch($item){
                    default;
                        $error->Mensaje("La direcion URL no existe");
                    break;
                }
            }else{
                $error->Mensaje("Solo acepta archivos .json o la estructura del archivo tiene un error");
            }

        }else if($_SERVER['REQUEST_METHOD']=='DELETE'){
            switch($item){
                default;
                    $error->Mensaje("La direcion URL no existe");
                break;
            }

        }else{
            $error->Mensaje("El tipo de Operacion que eligio no existe");
        }
    }
?>