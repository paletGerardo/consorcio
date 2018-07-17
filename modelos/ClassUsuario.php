<?php
include_once "../config/conexion.php";

Class Usuario
{
	public function __construct()
	{

	}

	function insertar($nombre,$apellido,$dni,$fecha_nacimiento,$telefono,$email,$login,$clave,$role)
	{
		$sql="INSERT INTO Usuario (nombre,apellido,dni,fecha_nacimiento,telefono,email,login,clave,role,condicion)
		VALUES ('$nombre','$apellido','$dni','$fecha_nacimiento','$telefono','$email','$login','$clave','$role', 1)";
		return ejecutarConsulta($sql);
	}

	function editar($id,$nombre,$apellido,$dni,$fecha_nacimiento,$telefono,$email,$login,$clave,$role,$condicion)
	{
		$sql="UPDATE Usuario SET nombre='$nombre',apellido='$apellido',dni='$dni',fecha_nacimiento='$fecha_nacimiento',telefono='$telefono',email='$email',login='$login',clave='$clave',role='$role', condicion = '$condicion' WHERE id='$id'";
		return ejecutarConsulta($sql);

	}

	function desactivar($id)
	{
		$sql="UPDATE Usuario SET condicion='0' WHERE id='$id'";
		return ejecutarConsulta($sql);
	}

	function activar($id)
	{
		$sql="UPDATE Usuario SET condicion='1' WHERE id='$id'";
		return ejecutarConsulta($sql);
	}

	function mostrar($id)
	{
		$sql="SELECT * FROM Usuario WHERE id='$id'";
		return ejecutarConsulta($sql);
	}

	function listar()
	{
		$sql="SELECT * FROM Usuario join Role on Usuario.role_id = Role.id";
		return ejecutarConsulta($sql);
	}
	function mostrarRole($id)
	{
		$sql="SELECT * FROM Role WHERE Usuario_id='$id'";
		return ejecutarConsulta($sql);
	}

	function verificar($login,$clave)
    {
    	$sql="SELECT * FROM Usuario WHERE login='$login' AND clave='$clave' AND condicion='1'";
    	return ejecutarConsulta($sql);
    }
}

?>
