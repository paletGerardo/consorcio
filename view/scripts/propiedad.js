    var latitud ;
    var longitud;

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    var all = true;
    return results === null ? all : decodeURIComponent(results[1].replace(/\+/g, " "));
}


var id = getParameterByName('consorcio');

var tabla;
//Función que se ejecuta al inicio
function init() {


    $.post("../ajax/consorcioAjax.php?op=mostrar",{id : id}, function(data, status)
    {
        data = JSON.parse(data);
        longitud = data.longitud;
        latitud = data.latitud;

        loadMap(latitud, longitud);
    });

    mostrarform(false);

    if (id != 'listar') {

        mostrar(id);
    }
    $("#formulario").on("submit", function (e) {
        guardar(e);
    });



}

//Función para Listar DATATABLE

function mostrar(id) {
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
            url: '../ajax/propiedadAjax.php?op=mostrar&consorcio=' + id,
            type: "get",
            dataType: "json",
            error: function (e) {
                //console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 5, //Paginación
        "order": [[0, "desc"]] //Ordenar (columna,orden)
    }).DataTable();
}

//Función limpiar
function limpiar() {
    $("#descripcion").val("");
    $("#metros").val("");
    $("#propietario").val("");

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




//Función para guardar o editar

function guardar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/propiedadAjax.php?op=guardar",
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

//Función para desactivar registros
function desactivar(id) {
    bootbox.confirm("¿Está Seguro de desactivar esta propiedad?", function (result) {
        if (result) {
            $.post("../ajax/propiedadAjax.php?op=desactivar", {
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
    bootbox.confirm("¿Está Seguro de activar esta propiedad?", function (result) {
        if (result) {
            $.post("../ajax/propiedadAjax.php?op=activar", {
                id: id
            }, function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

function loadMap(latitud, longitud) {
    var mapOptions = {
        center: new google.maps.LatLng(latitud, longitud),
        zoom: 12,
        panControl: false,
        zoomControl: false,
        scaleControl: false,
        mapTypeControl: false,
        streetViewControl: true,
        overviewMapControl: true,
        rotateControl: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP

    };

    var map = new google.maps.Map(document.getElementById("mapa"), mapOptions);

    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(latitud, longitud),
        map: map
    });

}

init();
