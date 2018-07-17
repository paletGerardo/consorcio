<?php
session_start();
require_once "../modelos/ClassProveedor.php";

$proveedor=new Proveedor();

$id=isset($_POST["id"])? limpiarCadena($_POST["id"]):"";
//$id=isset($_GET["id"])? limpiarCadena($_GET["id"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$apellido=isset($_POST["apellido"])? limpiarCadena($_POST["apellido"]):"";
$dni=isset($_POST["dni"])? limpiarCadena($_POST["dni"]):"";
$direccion_calle=isset($_POST["direccion_calle"])? limpiarCadena($_POST["direccion_calle"]):"";
$direccion_numero=isset($_POST["direccion_numero"])? limpiarCadena($_POST["direccion_numero"]):"";
$codigo_postal=isset($_POST["codigo_postal"])? limpiarCadena($_POST["codigo_postal"]):"";
$fecha_nacimiento=isset($_POST["fecha_nacimiento"])? limpiarCadena($_POST["fecha_nacimiento"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";


switch ($_GET["op"]){


    case 'listar':
        $rspta=$proveedor->listarAdm();
        $data= Array();

        while ($reg=$rspta->fetch_object()){
            $data[]=array(
                "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>'.
                    ' <button class="btn btn-danger" onclick="desactivar('.$reg->id.')"><i class="fa fa-close"></i></button>':
                    '<button class="btn btn-warning" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>'.
                    ' <button class="btn btn-primary" onclick="activar('.$reg->id.')"><i class="fa fa-check"></i></button>',
                "1"=>$reg->nombre,
                "2"=>$reg->descripcion,
                "3"=>$reg->telefono,
                "4"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
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
            if(!empty($id)){
                $rspta=$proveedor->editar($id,$nombre, $apellido, $dni, $direccion_calle,$direccion_numero,$codigo_postal,$fecha_nacimiento, $telefono, $email);
                echo $rspta ? "Proveedor Editado" : "No se pudo editar el proveedor";
            }else{
                $rspta=$proveedor->insertar($nombre, $apellido, $dni, $direccion_calle,$direccion_numero,$codigo_postal,$fecha_nacimiento, $telefono, $email);
                echo $rspta ? "Proveedor registrado" : "No se pudo registrar el proveedor";
            }

        break;

    case 'desactivar':
        $rspta=$proveedor->desactivar($id);
        echo $rspta ? "Consorcio Desactivado" : "Consorcio no se puede desactivar";
        break;

    case 'activar':
        $rspta=$proveedor->activar($id);
        echo $rspta ? "Consorcio activado" : "Consorcio no se puede activar";
        break;

    case 'mostrar':
        $rspta=$proveedor->mostrar($id);

        echo json_encode($rspta->fetch_all(MYSQLI_ASSOC));
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

/*$result= $proveedor->mostrar(1);
while ($fila = $result->fetch_assoc()) {
        printf ("%s (%s)\n", $fila["nombre"], $fila["id"]);
    }*/

?>

