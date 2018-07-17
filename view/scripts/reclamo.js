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

//Función limpiar
function limpiar()
{
	$("#numero_factura").val("");
	$("#empresa").val("");
	$("#importe").val("");
	$("#fecha").val("");
	$("#descripcion").val("");


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
					url: '../ajax/reclamoAjax.php?op=listar',
					type : "get",
					dataType : "json",
					error: function(e){
						console.log(e.responseText);
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}


//Función para guardar o editar

function guardar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/reclamoAjax.php?op=guardar",
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
	$.post("../ajax/reclamoAjax.php?op=mostrar",{id : id}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);

		$("#id").val(data.id);
		$("#nombre").val(data.nombre);
		$("#apellido").val(data.apellido);
		$("#direccion").val(data.direccion);
		$("#departamento").val(data.departamento);
        $("#localidad").val(data.localidad);
		$("#telefono").val(data.telefono);
		$("#email").val(data.email);
        $("#fecha").val(data.fecha);
        $("#reclamo").val(data.reclamo);




 	});

}

//Función para desactivar registros
//function desactivar(id)
//{
//	bootbox.confirm("¿Está Seguro de desactivar el Proveedor?", function(result){
//		if(result)
//        {
//        	$.post("../ajax/proveedor.php?op=desactivar", {id : id}, function(e){
//        		bootbox.alert(e);
//	            tabla.ajax.reload();
//        	});
//        }
//	})
//}
//
////Función para activar registros
//function activar(id)
//{
//	bootbox.confirm("¿Está Seguro de activar el Proveedor?", function(result){
//		if(result)
//        {
//        	$.post("../ajax/proveedor.php?op=activar", {id : id}, function(e){
//        		bootbox.alert(e);
//	            tabla.ajax.reload();
//        	});
//        }
//	})
//}

init();
