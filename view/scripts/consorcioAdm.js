var tabla;
//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function (e) {
        guardar(e);
    });
}

//Función limpiar
function limpiar() {
    $("#nombre").val("");
    $("#direccion").val("");
    $("#localidad").val("");
    $("#cod_postal").val("");
    $("#encargado").val("");
    $("#telefono").val("");
    $("#email").val("");
    $("#latitud").val("");
    $("#longitud").val("");
}

//Función mostrar formulario
function mostrarform(flag) {
    limpiar();
    if (flag) {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnagregar").hide();
    } else {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        $("#btnagregar").show();
    }
}

//Función cancelarform
function cancelarform() {
    limpiar();
    mostrarform(false);
}

//Función para Listar DATATABLE
function listar() {
    tabla = $('#tbllistado').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del control de tabla
        buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf'
            ],
        "ajax": {
            url: '../ajax/consorcioAjaxAdm.php?op=listarAdm',
            type: "get",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 5, //Paginación
        "order": [[0, "desc"]] //Ordenar (columna,orden)
    }).DataTable();
}

//Función para guardar o editar

function guardar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/consorcioAjaxAdm.php?op=guardar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function (datos) {
            bootbox.alert(datos);
            mostrarform(false);
            tabla.ajax.reload();
        }

    });
    limpiar();
}

function mostrar(id)
{
	$.post("../ajax/consorcioAjaxAdm.php?op=mostrar",{id : id}, function(data, status){
	//$.get("../ajax/proveedorAjax.php?op=mostrar&id=1", function(data, status){

		data = JSON.parse(data);
		mostrarform(true);
		$("#nombre").val(data.nombre);
		$("#direccion").val(data.direccion);
		$("#localidad").val(data.localidad);
		$("#cod_postal").val(data.cod_postal);
		$("#encargado").val(data.encargado);
		$("#email").val(data.email);
		$("#latitud").val(data.latitud);
		$("#longitud").val(data.longitud);
		$("#telefono").val(data.telefono);
 	});

}

//Función para desactivar registros
function desactivar(id) {
    bootbox.confirm("¿Está Seguro de desactivar el consorcio?", function (result) {
        if (result) {
            $.post("../ajax/consorcioAjaxAdm.php?op=desactivar", {
                id: id
            }, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

//Función para activar registros
function activar(id) {
    bootbox.confirm("¿Está Seguro de activar el consorcio?", function (result) {
        if (result) {
            $.post("../ajax/consorcioAjaxAdm.php?op=activar", {
                id: id
            }, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

init();
