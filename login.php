<?php 

if ($_SERVER['REQUEST_METHOD']=="POST"){    
    $correo = $_POST['email'];
    $contraseña = $_POST['pass'];

    require_once("../model/conexion.php");
    $obj = new connection();
    $obj = $obj->login($correo,$contraseña);
    
    echo json_encode(["estado"=>$obj]);
}

