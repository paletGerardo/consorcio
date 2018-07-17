<?php
include_once "../config/conexion.php";

Class Resumen
{
    public function __construct()
    {

    }
    function mostrar($id)
    {

        $sql= " SELECT * FROM Resumen r  join Factura f on r.factura_id = f.id
                                        join Proveedor p on p.id = f.id_proveedor
                WHERE departamento_id = '$id' ";
        return ejecutarConsulta($sql);
    }

    function mostrarSimple($id)
    {
        $sql= "SELECT p.id as id_propiedad, p.descripcion , p.metros_cuadrados, c.nombre as nombre_consorcio, u.nombre as nombre_propietario, u.telefono FROM Propiedad p join Consorcio c on p.id_consorcio = c.id join Usuario u on u.id = p.id_propietario ";
        return ejecutarConsultaSimpleFila($sql);
    }


}

?>
