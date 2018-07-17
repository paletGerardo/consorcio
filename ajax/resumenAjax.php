<?php
session_start();
require_once "../modelos/ClassResumen.php";

$resumen =new Resumen();

$departamentoID = isset($_GET["departamento"])? limpiarCadena($_GET["departamento"]):"";


switch ($_GET["op"]){

    case 'mostrar':
        $rspta=$resumen->mostrar($departamentoID);
        $data= Array();
        while ($reg=$rspta->fetch_object()){
            $data[]=array(

               "0"=>$reg->fecha,
                "1"=>$reg->nombre,
                "2"=>$reg->monto,
                "3"=>($reg->estado)?'<span class="label bg-green">Pagado</span>':
                    '<a href="mercadoPago.php?precio='.$reg->monto.'&fecha='.$reg->fecha.'" class="label bg-red">Pagar</span>'
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
