<?php
include_once "../config/conexion.php";

Class IngresoFactura
{
	public function __construct()
	{

	}
	function insertar($proveedor_id, $importe, $descripcion, $consorcio_id)
	{
        //inserto factura para luego obtener el ultimo registro
        $sql2="INSERT INTO Factura (id_proveedor,importe,descripcion,consorcio_id)
		VALUES ('$proveedor_id','$importe','$descripcion','$consorcio_id')";
        $result = ejecutarConsulta($sql2);

        //obtengo el ultimo registro de factura
        $sql3= "select id from Factura order by id asc limit 1";
        $factura_id= ejecutarConsulta_retornarID($sql3);



        //Selecciono todas las propiedades para recorrerlas con el foreach
        $sql4= "SELECT * FROM Propiedad WHERE id_consorcio = '$consorcio_id'";
        $listaPropiedades=ejecutarConsulta($sql4);
        //var_dump($listaPropiedades);

        //obtengo la cantidad de metros cuadrados del consorcio
        $sql5= "SELECT SUM(metros_cuadrados) as suma FROM Propiedad WHERE id_consorcio = '$consorcio_id'";
        $totalMts= ejecutarConsultaSimpleFila($sql5);
        $mts= $totalMts['suma'];

        //echo json_encode($listaPropiedades);
        //var_dump($listaPropiedades->fetch_object());

        //recorro la lista
        while ($reg=$listaPropiedades->fetch_object()){ //tranformo en objeto resultado de la consulta

            $porcentajeDepto= ($reg->metros_cuadrados * 100)/$mts;
            $importeDepto = ($importe * $porcentajeDepto)/100;

            $sql6="INSERT INTO Resumen (departamento_id, factura_id, monto)
            VALUES ('$reg->id','$factura_id','$importeDepto')";
            $algo= ejecutarConsulta($sql6);
        }

        return $result;

	}

	function editar($id,$empresa,$importe,$fecha,$descripcion)
	{
		$sql="UPDATE Factura SET empresa='$empresa',importe='$importe',fecha='$fecha',descripcion=$descripcion, WHERE id='$id'";
		return ejecutarConsulta($sql);

	}

//	function desactivar($id)
//	{
//		$sql="UPDATE proveedor SET condicion='0' WHERE id='$id'";
//		return ejecutarConsulta($sql);
//	}
//
//	function activar($id)
//	{
//		$sql="UPDATE proveedor SET condicion='1' WHERE id='$id'";
//		return ejecutarConsulta($sql);
//	}

    function mostrar($id)
    {
        $sql="SELECT * FROM Factura f join Proveedor p on f.id_proveedor = p.id WHERE f.consorcio_id = '$id' ORDER BY f.fecha DESC";
        return ejecutarConsulta($sql);
    }

	function listar()
	{
		$sql="SELECT * FROM Factura";
		return ejecutarConsulta($sql);
	}


}



$clase = new IngresoFactura();
$clase->insertar('Edenor',100000,'descripcion',0);
?>
