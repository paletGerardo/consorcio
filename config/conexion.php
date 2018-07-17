<?php
$conexion = new mysqli('localhost', 'root', '', 'consorciodb');
/* Comprueba la conexión */
    if ($conexion->connect_errno) {
        printf("Connect failed: %s\n", $conexion->connect_error);
        exit();
    }

    if(!function_exists('ejecutarConsulta'))
    {
        function ejecutarConsulta($sql)
        {
            global $conexion;
            $query = $conexion->query($sql) or die ('Error: ' . mysqli_error($conexion));
            return $query;

        }

        function ejecutarConsultaSimpleFila($sql)
        {
            global $conexion;
            $query = $conexion->query($sql);
            $row = $query->fetch_assoc();
            return $row;
        }

        function ejecutarConsulta_retornarID($sql)
        {
            global $conexion;
            $query = $conexion->query($sql);
            return $conexion->insert_id;
        }

        function limpiarCadena($str)
        {
            global $conexion;
            $str= mysqli_real_escape_string($conexion,trim($str));
            return htmlspecialchars($str);
        }
    }
?>
