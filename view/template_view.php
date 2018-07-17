<?php

    session_start();

    if (!isset($_SESSION["nombre"]))
    {
        header("Location: login.html");
    }
    else
    {
        require 'layouts/header.php';
        if ($_SESSION['acceso']==1)
        {


            include 'usuarioAdm.php';


        }
        else
        {
            require 'noacceso.php';
        }
        require 'layouts/footer.php';



    }
    ob_end_flush();

