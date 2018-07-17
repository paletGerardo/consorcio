<?php
include "../config/conexion.php";

Class Reclamo
{
	public function __construct()
	{
	}
	function insertar($consorcio,$departamento,$reclamo)
	{
		$sql="INSERT INTO Reclamo (consorcio_id,departamento_id,rec)
		VALUES ('$consorcio','$departamento','$reclamo')";
		return ejecutarConsulta($sql);
	}

	function listar()
	{
		$sql="SELECT * FROM Reclamo";
		return ejecutarConsulta($sql);

	}
}
?>
