<?php
include_once "../config/conexion.php";

Class Consorcio
{
    public function __construct()
    {

    }

    function listar()
    {
        $sql="SELECT * FROM Consorcio WHERE condicion = 1";
        return ejecutarConsulta($sql);
    }

    function listarAdm()
    {
        $sql="SELECT * FROM Consorcio";
        return ejecutarConsulta($sql);
    }

    function insertar($nombre,  $direccion , $localidad, $cod_postal, $telefono, $email, $encargado, $latitud, $longitud)
    {
        $sql="INSERT INTO Consorcio (nombre, direccion, localidad, cod_postal, telefono, email, encargado, latitud, longitud)
		VALUES ('$nombre', '$direccion', '$localidad', '$cod_postal', '$telefono', '$email', '$encargado', '$latitud','$longitud')";
        return ejecutarConsulta($sql);
    }

    function editar($id, $nombre,  $direccion, $id_localidad, $latitud, $longitud, $encargado)
    {
        $sql="UPDATE Consorcio SET nombre='$nombre',direccion='$direccion',localidad='$id_localidad',latitud='$latitud',longitud='$longitud',encargado='$encargado' WHERE id='$id'";
        return ejecutarConsulta($sql);

    }

    function desactivar($id)
    {
        $sql="UPDATE Consorcio SET condicion='0' WHERE id='$id'";
        return ejecutarConsulta($sql);
    }

    function activar($id)
    {
        $sql="UPDATE Consorcio SET condicion='1' WHERE id='$id'";
        return ejecutarConsulta($sql);
    }

    function mostrar($id)
    {
        $sql="SELECT * FROM Consorcio WHERE id='$id' ORDER BY nombre ASC";
        return ejecutarConsultaSimpleFila($sql);
    }

    function mostrarLat($id)
    {
        $sql="SELECT * FROM Consorcio WHERE id='$id' ORDER BY nombre ASC";
        return ejecutarConsulta($sql);
    }

}

//$unconsorcio = new Consorcio();

//ar_dump( $unconsorcio->listar());
//$unconsorcio->desactivar(0);

?>
