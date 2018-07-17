<?php
session_start();
require_once "../modelos/ClassIngresoFactura.php";

$factura=new IngresoFactura();

$consorcio_id = isset($_GET["consorcio"])? limpiarCadena($_GET["consorcio"]):"";
$id=isset($_POST["id"])? limpiarCadena($_POST["id"]):"";
//$numero_factura=isset($_POST["numero_factura"])? limpiarCadena($_POST["numero_factura"]):"";
$proveedor_id=isset($_POST["proveedor_id"])? limpiarCadena($_POST["proveedor_id"]):"";
$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";
$importe=isset($_POST["importe"])? limpiarCadena($_POST["importe"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";



switch ($_GET["op"]){


    case 'guardar':
            $rspta=$factura->insertar($proveedor_id, $importe, $descripcion, $consorcio_id);
            echo $rspta ? "Factura Ingresada": "No se pudo agregar Factura";

        break;

     case 'mostrar':
        $rspta=$factura->mostrar($consorcio_id);
        $data= Array();

        while ($reg=$rspta->fetch_object()){
            $data[]=array(

                "0"=>$reg->fecha,
                "1"=>$reg->nombre,
                "2"=>$reg->importe,
                "3"=>$reg->descripcion,

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

