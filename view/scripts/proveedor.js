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
	$("#nombre").val("");
	$("#apellido").val("");
	$("#dni").val("");
	$("#direccion_calle").val("");
	$("#direccion_numero").val("");
	$("#codigo_postal").val("");
	$("#fecha_nacimiento").val("");
	$("#telefono").val("");
	$("#email").val("");

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
					url: '../ajax/proveedorAjax.php?op=listar',
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


//Función para guardar o editar

function guardar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/proveedorAjax.php?op=guardar",
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
	$.post("../ajax/proveedorAjax.php?op=mostrar",{id : id}, function(data, status){
	//$.get("../ajax/proveedorAjax.php?op=mostrar&id=1", function(data, status){

		data = JSON.parse(data);
		mostrarform(true);
        $("#id").val(data[0].id);
		$("#nombre").val(data[0].nombre);
		$("#apellido").val(data[0].apellido);
		$("#dni").val(data[0].dni);
		$("#direccion_calle").val(data[0].direccion_calle);
		$("#direccion_numero").val(data[0].direccion_numero);
		$("#codigo_postal").val(data[0].codigo_postal);
		$("#fecha_nacimiento").val(data[0].fecha_nacimiento);
		$("#telefono").val(data[0].telefono);
		$("#email").val(data[0].email);
 	});

}

//Función para desactivar registros
function desactivar(id)
{
	bootbox.confirm("¿Está Seguro de desactivar el Proveedor?", function(result){
		if(result)
        {
        	$.post("../ajax/proveedorAjax.php?op=desactivar", {id : id}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}

//Función para activar registros
function activar(id)
{
	bootbox.confirm("¿Está Seguro de activar el Proveedor?", function(result){
		if(result)
        {
        	$.post("../ajax/proveedorAjax.php?op=activar", {id : id}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}

init();
