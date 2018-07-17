<?php
session_start();

if (!isset($_SESSION["login"]))
{
    header("Location: login.html");
}
else {
    require 'layouts/header.php';
    if ($_SESSION['role'] == 1) {
        ?>
        <!--Contenido-->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" id="app">
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h1 class="box-title">Consorcio
                                    <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i
                                            class="fa fa-plus-circle"></i> Agregar
                                    </button>
                                </h1>
                                <div class="box-tools pull-right">
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <!-- centro -->
                            <div class="panel-body table-responsive" id="listadoregistros">
                                <table id="tbllistado"
                                       class="table table-striped table-bordered table-condensed table-hover">
                                    <thead>
                                    <th>Nombre y Localizacion</th>
                                    <th>Direccion</th>
                                    <th>Localidad</th>
                                    <th>Cod. Postal</th>
                                    <th>Telefono</th>
                                    <th>Email</th>
                                    <th>Encargado</th>
                                    <th>Departamentos</th>
                                    <th>Facturar</th>


                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                    <th>Nombre y Localizacion</th>
                                    <th>Direccion</th>
                                    <th>Localidad</th>
                                    <th>Cod. Postal</th>
                                    <th>Telefono</th>
                                    <th>Email</th>
                                    <th>Encargado</th>
                                    <th>Departamentos</th>
                                    <th>Facturar</th>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="panel-body" id="formularioregistros">
                                <form name="formulario" id="formulario" method="POST">
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Nombre(*):</label>
                                        <input type="hidden" name="id" id="id">
                                        <input type="text" class="form-control" name="nombre" id="nombre"
                                               maxlength="100" placeholder="nombre" required>
                                    </div>

                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Direccion(*):</label>
                                        <input type="text" class="form-control" name="direccion" id="direccion"
                                               maxlength="100" placeholder="direccion" required>
                                    </div>

                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Localidad:</label>
                                        <input type="text" class="form-control" name="localidad" id="localidad"
                                               placeholder="localidad" maxlength="70">
                                    </div>

                                       <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Codigo postal:</label>
                                        <input type="text" class="form-control" name="cod_postal" id="cod_postal"
                                               placeholder="codigo postal" maxlength="70">
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Teléfono:</label>
                                        <input type="text" class="form-control" name="telefono" id="telefono"
                                               maxlength="20" placeholder="Teléfono">
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Email:</label>
                                        <input type="email" class="form-control" name="email" id="email"
                                               maxlength="50" placeholder="Email">
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Nombre encargado:</label>
                                        <input type="text" class="form-control" name="encargado" id="encargado"
                                               maxlength="20" placeholder="encargado">
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
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->

        </div><!-- /.content-wrapper -->
        <!--Fin-Contenido-->
        <?php

    } else {
        require 'noacceso.php';
    }
    require 'layouts/footer.php';
}
?>
<script type="text/javascript" src="scripts/consorcio.js"></script>
