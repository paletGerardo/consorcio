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
                            <h1 class="box-title">Proveedores
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
                            <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                                <thead>
                                    <th>Nombre</th>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>Telefono</th>
                                    <th>Condicion</th>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <th>Nombre</th>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>Telefono</th>
                                    <th>Condicion</th>
                                </tfoot>
                            </table>
                        </div>
                        <div class="panel-body" id="formularioregistros">
                            <form name="formulario" id="formulario" method="POST">

                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Nombre(*):</label>
                                    <input type="hidden" name="id" id="id">
                                    <input type="text" class="form-control" name="nombre" id="nombre" maxlength="100" placeholder="Nombre" required>

                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Descripcion(*):</label>
                                    <input type="text" class="form-control" name="descripcion" id="descripcion" maxlength="100" placeholder="descripcion" required>
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Telefono(*):</label>
                                    <input type="text" class="form-control" name="telefono" id="telefono" maxlength="20" placeholder="telefono" required>
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
        <script type="text/javascript" src="scripts/proveedorAdm.js"></script>
