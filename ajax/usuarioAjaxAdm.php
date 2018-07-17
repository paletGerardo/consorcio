<?php
session_start();
require_once "../modelos/ClassUsuario.php";

$usuario=new Usuario();

$id=isset($_POST["id"])? limpiarCadena($_POST["id"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$apellido=isset($_POST["apellido"])? limpiarCadena($_POST["apellido"]):"";
$dni=isset($_POST["dni"])? limpiarCadena($_POST["dni"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$cargo=isset($_POST["cargo"])? limpiarCadena($_POST["cargo"]):"";
$login=isset($_POST["login"])? limpiarCadena($_POST["login"]):"";
$clave=isset($_POST["clave"])? limpiarCadena($_POST["clave"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";

switch ($_GET["op"]){
    case 'guardar':

        if (empty($id)){
            $rspta=$usuario->insertar($nombre,$apellido,$dni,$fecha_nacimiento,$telefono,$email,$role,$login,$clave);
            echo $rspta ? "Usuario registrado" : "No se pudieron registrar todos los datos del usuario";
        }
        else {
            $rspta=$usuario->editar($id,$nombre,$apellido,$dni,$fecha_nacimiento,$telefono,$email,$role,$login,$clave);
            echo $rspta ? "Usuario actualizado" : "Usuario no se pudo actualizar";
        }
        break;

    case 'desactivar':
        $rspta=$usuario->desactivar($id);
        echo $rspta ? "Usuario Desactivado" : "Usuario no se puede desactivar";
        break;

    case 'activar':
        $rspta=$usuario->activar($id);
        echo $rspta ? "Usuario activado" : "Usuario no se puede activar";
        break;

    case 'mostrar':
        $rspta=$usuario->mostrar($id);
        //Codificar el resultado utilizando json
        echo json_encode($rspta);
        break;

    case 'listar':
        $rspta=$usuario->listar();
        $data= Array();

        while ($reg=$rspta->fetch_object()){
            $data[]=array(
                "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>'.
                    ' <button class="btn btn-danger" onclick="desactivar('.$reg->id.')"><i class="fa fa-close"></i></button>':
                    '<button class="btn btn-warning" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>'.
                    ' <button class="btn btn-primary" onclick="activar('.$reg->id.')"><i class="fa fa-check"></i></button>',
                "1"=>$reg->nombre,
                "2"=>$reg->apellido,
                "3"=>$reg->dni,
                "4"=>$reg->direccion,
                "5"=>$reg->fecha_nacimiento,
                "6"=>$reg->telefono,
                "7"=>$reg->email,
                "8"=>$reg->login,
                "9"=>$reg->role_id,
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

    case 'verificar':
        $login=$_POST['login'];
        $clave=$_POST['clave'];

        //Hash SHA256 en la contraseña
        $clavehash=hash("SHA256",$clave);

        $rspta=$usuario->verificar($login, $clave);

        $fetch=$rspta->fetch_object();

        if (isset($fetch))
        {
            //Declaramos las variables de sesión
            $_SESSION['login']=$fetch->login;
            $_SESSION['role']=$fetch->role_id;
            $_SESSION['nombre']=$fetch->nombre;
        }
        echo json_encode($fetch);
        break;

    case 'salir':
        //Limpiamos las variables de sesión
        session_unset();
        //Destruìmos la sesión
        session_destroy();
        //Redireccionamos al login
        header("Location: ../login.thml");

        break;
}
?>
