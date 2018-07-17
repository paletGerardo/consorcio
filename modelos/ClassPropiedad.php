<?php
include_once "../config/conexion.php";

Class Propiedad
{
    public function __construct()
    {

    }

    function listar()
    {
        $sql= "SELECT p.id as id_propiedad, p.descripcion , p.metros_cuadrados, c.nombre as nombre_consorcio, u.nombre as nombre_propietario, u.telefono FROM Propiedad p join Consorcio c on p.consorcio_id = c.id join Usuario u on u.id = p.propietario_id ";
        return ejecutarConsulta($sql);
    }

    function insertar($descripcion,  $metros_cuadrados, $consorcioID, $propietarioID)
    {
        $sql= "INSERT INTO Propiedad (descripcion,  metros_cuadrados, id_consorcio, id_propietario)
		VALUES ('$descripcion',  '$metros_cuadrados', '$consorcioID', '$propietarioID')";
        return ejecutarConsulta($sql);
    }

    function editar($id, $descripcion,  $metros_cuadrados, $consorcioID, $propietarioID, $condicion)
    {
        $sql= "UPDATE Propiedad SET descripcion='$descripcion',metros_cuadrados='$metros_cuadrados',consorcio='$consorcioID',propietario='$propietarioID' WHERE id='$id'";
        return ejecutarConsulta($sql);

    }

    function desactivar($id)
    {
        $sql="UPDATE Propiedad SET condicion='0' WHERE id='$id'";
        return ejecutarConsulta($sql);
    }

    function activar($id)
    {
        $sql="UPDATE Propiedad SET condicion='1' WHERE id='$id'";
        return ejecutarConsulta($sql);
    }

    function mostrar($idCosorcio)
    {

        $sql= "SELECT * from Propiedad where id_consorcio = '$idCosorcio'";
        return ejecutarConsulta($sql);
    }
    function mostrarSimple($id)
    {
        $sql= "SELECT p.id as id_propiedad, p.descripcion , p.metros_cuadrados, c.nombre as nombre_consorcio, u.nombre as nombre_propietario, u.telefono FROM Propiedad p join Consorcio c on p.consorcio_id = c.id join Usuario u on u.id = p.propietario_id ";
        return ejecutarConsultaSimpleFila($sql);
    }


}

/*$propiedad = new Propiedad();
$rspta=$propiedad->mostrar(1);
 while ($reg=$rspta->fetch_object()){
          echo $reg->id.'<br>';
}*/

?>
