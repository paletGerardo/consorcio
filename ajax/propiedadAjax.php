<?php
session_start();
require_once "../modelos/ClassPropiedad.php";

$propiedad =new Propiedad();

$idConsorcio = isset($_GET["consorcio"])? limpiarCadena($_GET["consorcio"]):"";

$consorcio_id=isset($_POST["consorcio_id"])? limpiarCadena($_POST["consorcio_id"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$metros=isset($_POST["metros"])? limpiarCadena($_POST["metros"]):"";
$consorcio_nombre =isset($_POST["consorcio"])? limpiarCadena($_POST["consorcio"]):"";
$propietario_id =isset($_POST["propietario"])? limpiarCadena($_POST["propietario"]):"";

switch ($_GET["op"]){

    case 'guardar':

            $rspta=$propiedad->insertar($descripcion,  $metros, $consorcio_id, $propietario_id);
            echo $rspta ? "Propiedad registrada" : "No se pudo registrar la propiedad";


        break;

    case 'desactivar':
        $rspta=$propiedad->desactivar($id);
        echo $rspta ? "Propiedad Desactivada" : "la propiedad no se puedo desactivar";
        break;

    case 'activar':
        $rspta=$propiedad->activar($id);
        echo $rspta ? "Propiedad activada" : "la propiedad no se puedo activar";
        break;

    case 'mostrar':
        $rspta=$propiedad->mostrar($idConsorcio);
        $data= Array();

        while ($reg=$rspta->fetch_object()){
            $data[]=array(

               "0"=>$reg->descripcion,
                "1"=>$reg->metros_cuadrados,
                "2"=>$reg->id_consorcio,
                "3"=>$reg->id_propietario,
                "4"=>'<a href="../view/resumen.php?departamento='.$reg->id_propietario.'" class="btn btn-primary" >Ver resumen</a>',

            );
        }
        $results = array(
            "sEcho"=>1, //Información para el datatables
            "iTotalRecords"=>count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
            "aaData"=>$data);
        echo json_encode($results);
        break;




    case 'salir':
        //Limpiamos las variables de sesión
        session_unset();
        //Destruìmos la sesión
        session_destroy();
        //Redireccionamos al login
        header("Location: ../login.html");

        break;
}
?>
