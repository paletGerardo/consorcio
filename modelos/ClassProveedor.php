<?php
include_once "../config/conexion.php";

Class Proveedor
{
	public function __construct()
	{

	}
	function insertar($nombre,$apellido,$dni,$direccion_calle,$direccion_numero,$codigo_postal,$fecha_nacimiento,$telefono,$email)
	{
		$sql="INSERT INTO Proveedor (nombre,apellido,dni,direccion_calle,direccion_numero,codigo_postal,fecha_nacimiento,telefono,email)
		VALUES ('$nombre','$apellido','$dni','$direccion_calle','$direccion_numero','$codigo_postal','$fecha_nacimiento','$telefono','$email')";
		return ejecutarConsulta($sql);
	}

	function editar($id,$nombre,$apellido,$dni,$direccion_calle,$direccion_numero,$codigo_postal,$fecha_nacimiento,$telefono,$email)
	{
		$sql="UPDATE Proveedor SET nombre='$nombre', apellido='$apellido', dni='$dni', direccion_calle='$direccion_calle', direccion_numero='$direccion_numero', codigo_postal='$codigo_postal', fecha_nacimiento='$fecha_nacimiento', telefono='$telefono', email='$email' WHERE id='$id'";
		return ejecutarConsulta($sql);

	}

	function desactivar($id)
	{
		$sql="UPDATE Proveedor SET condicion='0' WHERE id='$id'";
		return ejecutarConsulta($sql);
	}

	function activar($id)
	{
		$sql="UPDATE Proveedor SET condicion='1' WHERE id='$id'";
		return ejecutarConsulta($sql);
	}

	function mostrar($id)
	{
		$sql="SELECT * FROM Proveedor WHERE id='$id'";
		return ejecutarConsulta($sql);
	}

	function listar()
	{
		$sql="SELECT * FROM Proveedor where condicion = 1";
		return ejecutarConsulta($sql);
	}

    function listarAdm()
	{
		$sql="SELECT * FROM Proveedor";
		return ejecutarConsulta($sql);
	}


}

?>
