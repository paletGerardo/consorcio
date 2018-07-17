var tabla;
//Función que se ejecuta al inicio
function init(){
    mostrarform(false);
    listar();

    $("#formulario").on("submit",function(e)
    {
        guardar(e);
    });

}

//Función para Listar DATATABLE
function listar()
{
    tabla=$('#tbllistado').dataTable(
        {
            "aProcessing": true,//Activamos el procesamiento del datatables
            "aServerSide": true,//Paginación y filtrado realizados por el servidor
            dom: 'Bfrtip',//Definimos los elementos del control de tabla
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf'
            ],
            "ajax":
                {
                    url: '../ajax/consorcioAjax.php?op=listar',
                    type : "get",
                    dataType : "json",
                    error: function(e){
                        console.log(e.responseText);
                    }
                },
            "bDestroy": true,
            "iDisplayLength": 5,//Paginación
            "order": [[ 0, "asc" ]]//Ordenar (columna,orden)
        }).DataTable();
}

//Función limpiar
function limpiar()
{
    $("#nombre").val("");
    $("#direccion").val("");
    $("#localidad").val("");
    $("#cod_postal").val("");
    $("#telefono").val("");
    $("#email").val("");
    $("#encargado").val("");
    $("#latitud").val("");
    $("#longitud").val("");

}

//Función mostrar formulario
function mostrarform(flag)
{
    limpiar();
    if (flag)
    {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled",false);
        $("#btnagregar").hide();
    }
    else
    {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        $("#btnagregar").show();
    }
}

//Función cancelarform
function cancelarform()
{
    limpiar();
    mostrarform(false);
}




//Función para guardar o editar

function guardar(e)
{
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled",true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/consorcioAjax.php?op=guardar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos)
        {
            bootbox.alert(datos);
            mostrarform(false);
            tabla.ajax.reload();
        }

    });
    limpiar();
}

function mostrar(id)
{
    $.post("../ajax/propiedadAjax.php?op=mostrar",{id : id}, function(data, status)
    {
        data = JSON.parse(data);
        mostrarform(true);

        $("#descripcion").val(data.descripcion);
        $("#metros").val(data.metros_cuadrados);
        $("#consorcio").val(data.consorcio);
        $("#propietario").val(data.propietario);

    });
}

//Función para desactivar registros
function desactivar(idusuario)
{
    bootbox.confirm("¿Está Seguro de desactivar el usuario?", function(result){
        if(result)
        {
            $.post("../ajax/usuarioAdm.php?op=desactivar", {idusuario : idusuario}, function(e){
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

//Función para activar registros
function activar(idusuario)
{
    bootbox.confirm("¿Está Seguro de activar el Usuario?", function(result){
        if(result)
        {
            $.post("../ajax/usuarioAdm.php?op=activar", {idusuario : idusuario}, function(e){
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

init();
