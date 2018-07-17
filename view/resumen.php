<?php
session_start();

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
                            <div class="box-header with-border">
                                <h1 class="box-title">Resumen
                                    <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i
                                            class="fa fa-plus-circle"></i> Agregar
                                    </button>
                                </h1>
                                <h2>Consorcio: <?php /* echo $laPropiedad['id']; ?> Propiedad: <?php echo $laPropiedad['descripcion']; */ ?> </h2>
                                <div class="box-tools pull-right">
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <!-- centro -->
                            <div class="panel-body table-responsive" id="listadoregistros">

                                <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                                    <thead>
                                    <th>Fecha</th>
                                    <th>Factura</th>
                                    <th>Importe</th>
                                    <th>Estado</th>


                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                    <th>Fecha</th>
                                    <th>Factura</th>
                                    <th>Importe</th>
                                    <th>Estado</th>

                                    </tfoot>
                                </table>
                            </div>
                            <div class="panel-body" id="formularioregistros">
                                <form name="formulario" id="formulario" method="POST">
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Descripcion(*):</label>
                                        <input type="hidden" name="id" id="id">
                                        <input type="text" class="form-control" name="descripcion" id="descripcion" maxlength="100" placeholder="descripcion" required>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Metros(*):</label>
                                        <input type="text" class="form-control" name="metros" id="metros" maxlength="100" placeholder="metros" required>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Consorcio(*):</label>
                                        <input type="text" class="form-control" name="consorcio" id="consorcio" maxlength="20" placeholder="" value="<?php echo $elConsorcio['nombre']; ?>" readonly>
                                        <input type="hidden" class="form-control" name="consorcio_id" id="consorcio_id" maxlength="20" value="<?php echo $elConsorcio['id']; ?>">
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Propietario:</label>
                                        <input type="text" class="form-control" name="localidad" id="localidad" placeholder="localidad" maxlength="70">
                                    </div>
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <button class="btn btn-primary" type="submit" id="btnGuardar"><i
                                                class="fa fa-save"></i> Guardar
                                        </button>
                                        <button class="btn btn-danger" onclick="cancelarform()" type="button"><i
                                                class="fa fa-arrow-circle-left"></i> Cancelar
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <!--Fin centro -->
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
