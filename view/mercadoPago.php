<?php
session_start();
require_once ('../mercadoPago/mercadopago.php');


$mp = new MP('2067679754919470', 'br0EC5WaPzmDM41mi5wOjQzaaZ2rndrA');

$precio= floatval($_GET["precio"]);
$fecha= $_GET["fecha"];

$preference_data = array(
	"items" => array(
		array(
			"title" => "Cobro de expensas del mes de .'$fecha'.",
			"quantity" => 1,
			"currency_id" => "ARS", // Available currencies at: https://api.mercadopago.com/currencies
			"unit_price" => $precio
		)
	)
);

$preference = $mp->create_preference($preference_data);

if (!isset($_SESSION["login"]))
{
    header("Location: login.html");
}
else {
    require_once "../modelos/ClassPropiedad.php";

    $propiedad=new Propiedad();

    $id = isset($_GET["departamento"])? limpiarCadena($_GET["departamento"]):"";
    if($id != 'listar'){
        $laPropiedad= $propiedad->mostrar($id);
    }

    require 'layouts/header.php';
            if ($_SESSION['role'] == 1 || $_SESSION['role'] == 2) {
        ?>
<script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
        <!--Contenido-->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" id="app">
            <!-- Main content -->
            <section class="content">
                <div class="row d-flex">
                    <div class="col-md-12">
                        <div class="box">
                           <div class="container d-flexo">
                               <h2>Usted esta por abonar las expensas del mes de <?php echo $fecha; ?></h2>
                            <a href="<?php echo $preference['response']['init_point']; ?>" class="label bg-blue aparte"> Pagar </a>
                            <br>
                           </div>
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->

        </div>
        <!-- /.content-wrapper -->
        <!--Fin-Contenido-->
        <?php

    } else {
        require 'noacceso.php';
    }
    require 'layouts/footer.php';
}
?>
<script type="text/javascript" src="scripts/resumen.js"></script>
