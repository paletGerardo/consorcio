<?php
session_start();
require_once "../modelos/ClassConsorcio.php";

$consorcio=new Consorcio();

$id=isset($_POST["id"])? limpiarCadena($_POST["id"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$localidad =isset($_POST["localidad"])? limpiarCadena($_POST["localidad"]):"";
$cod_postal=isset($_POST["codPostal"])? limpiarCadena($_POST["codPostal"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$encargado=isset($_POST["encargado"])? limpiarCadena($_POST["encargado"]):"";
$latitud=isset($_POST["latitud"])? limpiarCadena($_POST["latitud"]):"";
$longitud=isset($_POST["longitud"])? limpiarCadena($_POST["longitud"]):"";


switch ($_GET["op"]){


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

         case 'listarAdm':
        $rspta=$consorcio->listarAdm();
        $data= Array();

        while ($reg=$rspta->fetch_object()){
           $data[]=array(
                "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>'.
                    ' <button class="btn btn-danger" onclick="desactivar('.$reg->id.')"><i class="fa fa-close"></i></button>':
                    '<button class="btn btn-warning" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>'.
                    ' <button class="btn btn-primary" onclick="activar('.$reg->id.')"><i class="fa fa-check"></i></button>',
                "1"=>$reg->nombre,
                "2"=>$reg->direccion,
                "3"=>$reg->localidad,
                "4"=>$reg->cod_postal,
                "5"=>$reg->telefono,
                "6"=>$reg->email,
                "7"=>$reg->encargado,
                "8"=>$reg->latitud,
                "9"=>$reg->longitud,
                "10"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
                    '<span class="label bg-red">Desactivado</span>'
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
