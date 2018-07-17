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
                                <h1 class="box-title">Departamentos
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
                                    <th>Descripcion</th>
                                    <th>Metros Cuadrados</th>
                                    <th>Nombre Consorcio</th>
                                    <th>Nombre Propietario</th>


                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                    <th>Descripcion</th>
                                    <th>Metros Cuadrados</th>
                                    <th>Nombre Consorcio</th>
                                    <th>Nombre Propietario</th>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="panel-body" id="formularioregistros">
                                <form name="formulario" id="formulario" method="POST">
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Descripcion(*):</label>
                                        <input type="hidden" name="id" id="id">
                                        <input type="text" class="form-control" name="descripcion" id="descripcion"
                                               maxlength="100" placeholder="Descripcion" required>
                                    </div>

                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Metros Cuadrados(*):</label>
                                        <input type="text" class="form-control" name="metros_cuadrados" id="metros_cuadrados"
                                               maxlength="100" placeholder="metros_cuadrados" required>
                                    </div>

                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Aca va el nombre del consorcio(*):</label>
                                        <input type="text" class="form-control" name="nombre_consorcio"
                                               id="nombre_consorcio" maxlength="20" placeholder="Nombre del Consorcio" required>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Nombre Propietario:</label>
                                        <input type="text" class="form-control" name="nombre_propietario" id="nombre_propietario"
                                               placeholder="Nombre Propietario" maxlength="70">
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
<script type="text/javascript" src="scripts/departamentoAdm.js"></script>
