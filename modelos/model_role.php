<?php
require "../config/conexion.php";

Class Role
{
	public function __construct()
	{

	}

	public function insertar($tipo, $descripcion)
	{
		$sql="INSERT INTO Role (tipo, descripcion)
		VALUES ('$tipo','$descripcion')";
		return ejecutarConsulta($sql);
	}

	public function editar($id,$tipo,$descripcion)
	{
		$sql="UPDATE Role SET tipo='$tipo',descripcion='$descripcion'";
		return ejecutarConsulta($sql);

	}

	public function eliminar($id)
	{
		$sql="DELETE FROM Role WHERE id='$id'";
		return ejecutarConsulta($sql);
	}

	public function listarRoles()
	{
		$sql="SELECT * FROM Role";
		return ejecutarConsulta($sql);
	}

	public function mostrarRole($id)
	{
		$sql="SELECT * FROM Role WHERE id='$id'";
		return ejecutarConsulta($sql);
	}

}

?>
