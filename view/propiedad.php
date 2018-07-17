<?php
session_start();

if (!isset($_SESSION["login"]))
{
    header("Location: login.html");
}
else {
    require_once "../modelos/ClassConsorcio.php";

    $consorcio=new Consorcio();

    $id = isset($_GET["consorcio"])? limpiarCadena($_GET["consorcio"]):"";
    if($id != 'listar'){
        $elConsorcio= $consorcio->mostrar($id);
    }

    require 'layouts/header.php';
            if ($_SESSION['role'] == 1 || $_SESSION['role'] == 2) {
        ?>
<script src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyAiq3xISXSZYgkd9GDAOdajy4NK2d3L7dY"></script>

    <!--Contenido-->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="app">
        <!-- Main content -->
        <section class="content">
            <div class="row d-flex">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h1 class="box-title">Propiedades
                                <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i
                                            class="fa fa-plus-circle"></i> Agregar
                                    </button>
                            </h1>
                            <h2><?php echo $elConsorcio['nombre'] ?></h2>
                            <div class="box-tools pull-right">
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <!-- centro -->
                        <div class="panel-body table-responsive" id="listadoregistros">

                            <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                                <thead>
                                    <th>Descripcion</th>
                                    <th>Metros</th>
                                    <th>Consorcio</th>
                                    <th>Propietario</th>
                                    <th>Detalles</th>

                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <th>Descripcion</th>
                                    <th>Metros</th>
                                    <th>Consorcio</th>
                                    <th>Propietario</th>
                                    <th>Detalles</th>
                                </tfoot>
                            </table>
                        </div>
                        <div class="contenedorMap container">
                           <h2>Localizacion en el mapa</h2>
                            <div id="mapa" style="width:auto; height:400px;"></div>

                        </div>
                        <br>
                        <div class="panel-body" id="formularioregistros">
                            <form name="formulario" id="formulario" method="POST">
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Descripcion(*):</label>
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
        <script type="text/javascript" src="scripts/propiedad.js"></script>
