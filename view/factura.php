<?php
session_start();

    if (!isset($_SESSION["login"]))
    {
        header("Location: login.html");
    }
    else {
        require_once "../modelos/ClassConsorcio.php";
        require_once "../modelos/ClassProveedor.php";

        $consorcio=new Consorcio();
        //intancio proveedor para el bombobox
        $proveedor=new Proveedor();
        $listaDeProv = $proveedor->listar();

        $id = isset($_GET["consorcio"])? limpiarCadena($_GET["consorcio"]):"";
        if($id != 'listar'){
            $elConsorcio= $consorcio->mostrar($id);
        }
            require 'layouts/header.php';
            if ($_SESSION['role'] == 1 || $_SESSION['role'] == 2) {
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
                            <h1 class="box-title">Factura
                                <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i
                                                    class="fa fa-plus-circle"></i> Agregar
                                        </button>
                            </h1>
                            <h2>
                                <?php echo $elConsorcio['nombre'] ?>
                            </h2>
                            <div class="box-tools pull-right">
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <!-- centro -->
                        <div class="panel-body table-responsive" id="listadoregistros">
                            <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                                <thead>
                                    <th>Fecha</th>
                                    <th>Proveedor</th>
                                    <th>Importe</th>
                                    <th>Descripción</th>

                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <th>Fecha</th>
                                    <th>Proveedor</th>
                                    <th>Importe</th>
                                    <th>Descripción</th>
                                </tfoot>
                            </table>
                        </div>
                        <div class="panel-body" id="formularioregistros">
                            <form name="formulario" id="formulario" method="POST">

                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Numero de Factura(*):</label>
                                    <input type="text" class="form-control" name="numero_factura" id="numero_factura" maxlength="100" placeholder="Numero de Factura" required>
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Proveedor(*):</label>
                                    <select class="form-control form-control-lg" name="proveedor_id" id="proveedor_id">
                                       <?php    foreach($listaDeProv as $reg){
                                        ?>
                                        <option value="<?php echo $reg['id']; ?>"><?php echo $reg['nombre']; ?></option>
                                        <?php
                                                }
                                        ?>

                                    </select>
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Importe(*):</label>
                                    <input type="text" class="form-control" name="importe" id="importe" maxlength="20" placeholder="Importe" required>
                                </div>


                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Fecha de Vencimiento:</label>
                                    <input type="date" class="form-control" name="fecha_vencimiento" id="fecha_vencimiento" placeholder="Fecha De Vencimiento">
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Descripcion (*):</label>
                                    <input type="textarea" class="form-control" name="descripcion" id="descripcion" maxlength="2500" placeholder="Descripcion del Gasto" required>
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
        <script type="text/javascript" src="scripts/factura.js"></script>
