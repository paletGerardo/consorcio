<?php
session_start();
require_once "../modelos/ClassConsorcio.php";

$consorcio=new Consorcio();

$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$id=isset($_POST["id"])? limpiarCadena($_POST["id"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$localidad =isset($_POST["localidad"])? limpiarCadena($_POST["localidad"]):"";
$cod_postal=isset($_POST["cod_postal"])? limpiarCadena($_POST["cod_postal"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$encargado=isset($_POST["encargado"])? limpiarCadena($_POST["encargado"]):"";


switch ($_GET["op"]){


    case 'listar':
        $rspta=$consorcio->listar();
        $data= Array();

        while ($reg=$rspta->fetch_object()){
            $data[]=array(

                "0"=>$reg->nombre,
                "1"=>$reg->direccion,
                "2"=>$reg->localidad,
                "3"=>$reg->cod_postal,
                "4"=>$reg->telefono,
                "5"=>$reg->email,
                "6"=>$reg->encargado,
                "7"=>'<a href="../view/propiedad.php?op=mostrar&consorcio='.$reg->id.'" class="btn btn-primary" >Ver...</a>',
                "8"=>'<a href="../view/factura.php?op=mostrar&consorcio='.$reg->id.'" class="btn btn-primary" >Facturar</a>',
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

            $rspta=$consorcio->insertar($nombre,  $direccion, $localidad,$cod_postal, $telefono, $email, $encargado);
            echo $rspta ? "Consorcio registrado" : "No se pudo registrar el consorcio";

        break;

    case 'desactivar':
        $rspta=$consorcio->desactivar($id);
        echo $rspta ? "Consorcio Desactivado" : "Consorcio no se puede desactivar";
        break;

    case 'activar':
        $rspta=$consorcio->activar($id);
        echo $rspta ? "Consorcio activado" : "Consorcio no se puede activar";
        break;

    case 'mostrar':
        $rspta=$consorcio->mostrar($id);
        //Codificar el resultado utilizando json
        echo json_encode($rspta);
        break;
case 'mostrarLat':
        $rspta=$consorcio->mostrarLat($id);
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
}
?>
