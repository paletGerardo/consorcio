<?php
session_start();
require_once "../modelos/ClassConsorcio.php";

$departamento=new Departamento();

$id=isset($_POST["id"])? limpiarCadena($_POST["id"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$metros_cuadrados=isset($_POST["metros_cuadrados"])? limpiarCadena($_POST["metros_cuadrados"]):"";
$id_consorcio =isset($_POST["id_consorcio"])? limpiarCadena($_POST["id_consorcio"]):"";
$id_propietario=isset($_POST["id_propietario"])? limpiarCadena($_POST["id_propietario"]):"";
$condicion=isset($_POST["condicion"])? limpiarCadena($_POST["condicion"]):"";


switch ($_GET["op"]){


    case 'listar':
        $rspta=$departamento->listar();
        $data= Array();

        while ($reg=$rspta->fetch_object()){
            $data[]=array(
                "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>'.
                    ' <button class="btn btn-danger" onclick="desactivar('.$reg->id.')"><i class="fa fa-close"></i></button>':
                    '<button class="btn btn-warning" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>'.
                    ' <button class="btn btn-primary" onclick="activar('.$reg->id.')"><i class="fa fa-check"></i></button>',
                "1"=>$reg->descripcion,
                "2"=>$reg->metros_cuadrados,
                "3"=>$reg->id_consorcio,
                "4"=>$reg->id_propietario,
                "5"=>$reg->condicion,
                "6"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
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

    case 'guardar':

            $rspta=$propiedad->insertar($nombre,  $direccion, $localidad,$cod_postal, $telefono, $email, $encargado);
            echo $rspta ? "Propiedad registrado" : "No se pudo registrar la propiedad";

        break;

    case 'desactivar':
        $rspta=$propiedad->desactivar($id);
        echo $rspta ? "Consorcio Desactivado" : "Consorcio no se puede desactivar";
        break;

    case 'activar':
        $rspta=$propiedad->activar($id);
        echo $rspta ? "Consorcio activado" : "Consorcio no se puede activar";
        break;

    case 'mostrar':
        $rspta=$propiedad->mostrar($id);
        //Codificar el resultado utilizando json
        echo json_encode($rspta);
        break;

         case 'listarAdm':
        $rspta=$propiedad->listarAdm();
        $data= Array();

        while ($reg=$rspta->fetch_object()){
           $data[]=array(
                "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>'.
                    ' <button class="btn btn-danger" onclick="desactivar('.$reg->id.')"><i class="fa fa-close"></i></button>':
                    '<button class="btn btn-warning" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>'.
                    ' <button class="btn btn-primary" onclick="activar('.$reg->id.')"><i class="fa fa-check"></i></button>',
                "1"=>$reg->descripcion,
                "2"=>$reg->metros_cuadrados,
                "3"=>$reg->id_consorcio,
                "4"=>$reg->id_propietario,
                "5"=>$reg->condicion,
                "6"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
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
