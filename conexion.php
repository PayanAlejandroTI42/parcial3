<?php

//Esta clase sirve para conectarnos a clase principal de BD

class Connection
{

	public $drive;
	public $host;
	public $user;
	public $password;
	public $database;
	public $conn;
	
	function __construct()
	{
	   $this->drive    = "mysql";
	   $this->host     = "localhost";
	   $this->user     = "root";
	   $this->password = "";
	   $this->database = "clima";

	   $this->get_connection();
	}

	public function get_connection(){

		try {
  $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->database, $this->user, $this->password);
  // set the PDO error mode to exception
  $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";
            } catch(PDOException $e) {
  //echo "Connection failed: " . $e->getMessage();
         }

	}


    function login($correo,$contraseña){

	  $sql = "CALL login(?,?)";
	  $statement = $this->conn->prepare($sql);
	  $statement->bindparam(1,$correo);
	  $statement->bindparam(2,$contraseña);

	  if($statement->execute()){
	      $count=$statement->rowCount();
            if($count){
              $cookie_name = "sesion";
              $cookie_value = "token";
              setcookie($cookie_name,$cookie_value,time() + (86400 * 30),"/"); #86400 = 1 day 
              return true;
            }
            else{
            	return false;
            }
         }
     
    }




	public function registro($nombre,$correo,$contraseña){

		$sql = "CALL registro(?,?,?)";
		$statement = $this->conn->prepare($sql);
		$statement->bindParam(1,$nombre);
		$statement->bindParam(2,$correo);
		$statement->bindParam(3,$contraseña);

		if($statement->execute()){
			return "Registrado Satisfactoriamente";
		}
		else{
			return "El usuario NO fue registrado";
		}

    }
}

$obj = new connection();
