<?php
session_start();
require_once "../modelos/ClassReclamo.php";

$rec= new Reclamo();

$id=isset($_POST["id"])? limpiarCadena($_POST["id"]):"";
$consorcio=isset($_POST["consorcio"])? limpiarCadena($_POST["consorcio"]):"";
$departamento=isset($_POST["departamento"])? limpiarCadena($_POST["departamento"]):"";
$reclamo=isset($_POST["reclamo"])? limpiarCadena($_POST["reclamo"]):"";



switch ($_GET["op"]){

    case 'listar':
        $rspta=$rec->listar();
        $data= Array();

        while ($reg=$rspta->fetch_object()){
            $data[]=array(

                "0"=>$reg->fecha,
                "1"=>$reg->consorcio_id,
                "2"=>$reg->departamento_id,
                "3"=>$reg->reclamo,
             );
        }
        $results = array(
            "sEcho"=>1, //Información para el datatables
            "iTotalRecords"=>count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
            "aaData"=>$data);
        echo json_encode($results);

        break;

    case 'guardar':
        $rspta=$rec->insertar($consorcio, $departamento, $reclamo);
            echo $rspta ? "Reclamo Ingresado" : "No se pudo agregar el Reclamo";

        break;

   // case 'desactivar':
   //     $rspta=$proveedor->desactivar($id);
   //     echo $rspta ? "Consorcio Desactivado" : "Consorcio no se puede desactivar";
   //     break;

   // case 'activar':
   //     $rspta=$proveedor->activar($id);
    //    echo $rspta ? "Consorcio activado" : "Consorcio no se puede activar";
    //    break;

    case 'mostrar':
        $rspta=$rec->mostrar($id);
        //Codificar el resultado utilizando json
        echo json_encode($rspta);
        break;




    case 'salir':
        //Limpiamos las variables de sesión
        session_unset();
        //Destruìmos la sesión
        session_destroy();
        //Redireccionamos al login
        header("Location: ../login.html");

        break;

        case 'saludar':
        echo   $_GET["op"]  ;
        $rspta=$rec->saludar();
        break;
}

?>



