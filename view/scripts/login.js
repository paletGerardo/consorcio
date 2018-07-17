$("#frmAcceso").on('submit',function(e)
{
	e.preventDefault();
    login=$("#login").val();
    clave=$("#clave").val();

    $.post("../ajax/usuarioAjaxAdm.php?op=verificar",
            {"login":login,"clave":clave},
            function(data)
            {
                if (data!="null")
                {
                    $(location).attr("href","consorcio.php");
                }
                else
                {
                    bootbox.alert("Usuario y/o Password incorrectos");
                    alert("Usuario y/o Password incorrectos");
                }
            }
          );
});
