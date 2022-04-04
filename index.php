<!DOCTYPE html>
<html lang="en">
<head>
  <title>El clima</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
body{
  background-image:url("../img/nubes.jpg");
}
.p1 {
  font-family: "Copperplate" ;
}
.centered {
  text-align: center;
 
}

</style>
<body>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v13.0&appId=517905186267506&autoLogAppEvents=1" nonce="rGH5wgfv"></script>
<div class="container text-center"  style=" width: 600px; margin-top:115px;  " >
  <h2>INICIO DE SESION</h2>
  <br>
  <div class="card text-center">
    <div class="card-body" style="background-color: gainsboro;" >
      <h2 > El Clima</h2>
        <p>Inicia sesión o registrate</p>
      <br>
      <form action="/action_page.php" >
        <div class="form-group">
          <input type="text" class="form-control" id="emaiil" placeholder="Correo electrónico" name="email">
        </div>
        <br>
        <div class="form-group">
          <input type="password" class="form-control" id="pwdd" placeholder="Contraseña" name="contraseña">
        </div>
        <button type="button" id="button" class="btn btn-dark"  >Iniciar sesión</button>
        <br><br> 
        <p>o</p>
        <br>
        <div class="fb-login-button" data-width="" data-size="large" data-button-type="continue_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false"scope="public_profile,email" onlogin="checkLoginState();"></div>
<div id="status">
</div>

<!-- Load the JS SDK asynchronously -->
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
</div>
<div class="container text-center" style="margin-top: 70px";>
  <button type="button" class="btn btn-light" data-toggle="modal" data-target="#myModal" >¿Aún no tienes cuenta?, ¡registrate ahora!</button>
</div>
                              <!--MODAL-->
<div class="modal" id="myModal" >
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Registro de usuario</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body" >
          	<div class="form-group">
				<input type="name" class="form-control" id="name" placeholder="Nombre completo" name="name">
			</div>
			<div class="form-group">
				<input type="email" class="form-control" id="email" placeholder="Ingresa tu correo" name="email">
			</div>
			<div class="form-group">
				<input type="pwd" class="form-control" id="pwd" placeholder="Ingresa una contraseña" name="pwd">
			</div>
		
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer text-center">
        
         <button type="button" id="buttonr" class="btn btn-primary" data-dismiss="modal">Registrarse</button>
        </div>       
      </div>
    </div>
  </div>



<!--  libreria JQUERY -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!--  //libreria JQUERY -->
<script>

    $("#button").click(function(){
        var correo = document.getElementById('emaiil').value;
        var contraseña = document.getElementById('pwdd').value;


        $.post("../controller/login.php",
        {
            email: correo,
            pass: contraseña
        },
        function(data,status){
            console.log(status)
            console.log(data)
            var obj =JSON.parse(data);
            if(obj.estado == true)
            {
                window.location.replace("dashboard.php");
            
            }
            else if (obj.estado == false){
                $("#error").text("error al iniciar sesion");
                $("#error").css("color","red")
            }
        });
    });
</script>



<script>

    $("#buttonr").click(function(){
        var nombre = document.getElementById('name').value;
        var correo = document.getElementById('email').value;
        var contraseña = document.getElementById('pwd').value;


        $.post("../controller/insert.php",
        {
            name: nombre,
            email: correo,
            pass: contraseña
        },
        function(data, status){
            console.log(status);
            console.log(data);
        });
    });
</script>

<script>

  function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
    console.log('statusChangeCallback');
    console.log(response);                   // The current login status of the person.
    if (response.status === 'connected') {   // Logged into your webpage and Facebook.
      testAPI();  
    } else {                                 // Not logged into your webpage or we are unable to tell.
      document.getElementById('status').innerHTML = '' +
        '';
    }
  }


  function checkLoginState() {               // Called when a person is finished with the Login Button.
    FB.getLoginStatus(function(response) { 
      window.location.replace("../views/dashboard.php");  // See the onlogin handler
      statusChangeCallback(response);
    });
  }


  window.fbAsyncInit = function() {
    FB.init({
      appId      : '517905186267506',
      cookie     : true,                     // Enable cookies to allow the server to access the session.
      xfbml      : true,                     // Parse social plugins on this webpage.
      version    : 'v13.0'           // Use this Graph API version for this call.
    });


    FB.getLoginStatus(function(response) {   // Called after the JS SDK has been initialized.
      statusChangeCallback(response);        // Returns the login status.
    });
  };
 
  function testAPI() {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
  }

</script>
</body>
</html>
