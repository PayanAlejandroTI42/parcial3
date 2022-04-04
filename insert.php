
<?php

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $nombre = $_POST['name'];
    $correo = $_POST['email'];
    $contraseña = $_POST['pass'];

    require_once("../model/conexion.php");
    $obj = new connection();
    $resultado = $obj->registro($nombre,$correo,$contraseña);
    echo json_encode(["estado"=>$resultado]);

}