<html>
    <head>
        <title>Consulta el Clima</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link
            rel="stylesheet"
            type="text/css"
            href="../css/style.css"/>
    </head>

<div class="weather-app">
  <div class="container">
    <h3 class="brand">Clima</h3>
    <div>
      <h1 class="temp">16&#176;<h1>
        <div class="city-time">
          <h1 class="name">San Luis Rio Colorado.</h1>
          <small>
            <span class="time">07:38</span>
            -
            <span class="date">
              Jueves Marzo 31
            </span>
          </small>
</div>
<div class="weather">
  <img 
  src="./icons/day/116.png"
  class="icon"
  alt="icon"
  width="50"
  height="50"
  />
  <span class="condition">Nublado</span>
</div>
</div>
<div class="panel">
  <form id="locationInput">
    <input
    type="text"
    class="search"
    placeholder="Buscar Ciudad..."
    />
    <button type="submit" class="submit">
      <i class="fas fa-search"></i>
    </button>
 <!--  </form> -->

<ul class="cities">
  <li class="city">CDMX</li>
  <li class="city">Mexicali</li>
  <li class="city">Nuevo Leon</li>
  <li class="city">Monterrey</li>
</ul>

<ul class="details">
  <h4>Detalles de clima</h4>
  <li>
    <span>Nublado</span>
    <span class="cloud">89%</span>
</li>
<li>
  <span>Humedad</span>
  <span class="humidity">64%</span>
</li>
<li>
  <span>Viento</span>
  <span class="wind">8km/h</span>
</li>
</ul>
</div>
</div>


<div class="weather-app">
     <div class="container">
         <h3 class="brand"></h3>
         <div>
              
             <h1 class="temp" id="temp">16&#176;</h1>
               
             <div class="city-time">
                 <h1 class="name" id="name">San Luis Rio Colorado</h1>
                 <small>
                     <span class="time">06:09</span>
                     -
                     <span class="date">
                         monday sep 19 
                     </span>
                </small>
            </div>
            <div class="weather">
                <img 
                src="../icons/day/113.png"
                class="icon"
                alt="icon"
                width="50"
                height="50"
                />
                <span class="condition"> cloudy </span>
            </div>
        </div>
    </div>
    <div class="panel">
        <form id="locationInput">
            <input
            type="text"
            class="search"
            placeholder="Search Location..."
            />
            <button type="submit" class="submit">
                <i class="fas fa-search"></i>
            </button>
        </form>

    <ul class="cities">
        <li class="city"> New York</i>
        <li class="city"> California</i>
        <li class="city"> Paris</i>
        <li class="city"> Tokyo</i>
    </ul>

    <ul class="details">
        <h4>Weather Details</h4>
        <li>
            <span>Cloudy</span>
            <span class="cloud"> 89%</span>
        </li>
        <li>
            <span>humidity</span>
            <span class="humidity">64%</span>
        </li>
        <li>
            <span>wind</span>
            <span class="wind">8km/h</span>
        </li>
      </ul>
    </div>
</div>


</body>

<script>

    const app =document.querySelector('.weather-app');
    const temp=document.getElementById('temp');
    const dateOutput= document.querySelector('.date');
    const timeOutput=document.querySelector('.time');
    const conditionOutput=document.querySelector('.condition');
    const nameOutput= document.getElementById('name');
    const icon=document.querySelector('.icon');
    const cloudOutput= document.getElementById('cloud');
    const humidityOutput=document.getElementById('humidity');
    const windOutput=document.getElementById('wind');
    const form = document.getElementById('locationInput');
    const search = document.querySelector('.search');
    const btn = document.querySelector('.submit');
    const cities= document.querySelectorAll('.city');

    var cityInput= "Ciudad De México";

    cities.forEach((city) =>{
        city.addEventListener('click', (e)=>{
            //cambia de la ciudad por default por la que se selecciono
            cityInput = e.target.innerHTML;
            // aqui se cambia por la informacion seleccionada
            fetchWeatherData();
            //nameOutput.innerHTML = "aaa";
            //animacion sencilla de la trancision de info
            app.style.opacity = "0";
        });
    })


    form.addEventListener('submit', (e)=>{

        if(search.value.length == 0){
            alert('Por favor ingrese una ciudad');
        }
        else{
            cityInput = search.value;
            fetchWeatherData();

            search.value = "";
            app.style.opacity = "0";
        }

        e.preventDefault();
    });


    function fetchWeatherData(){

        fetch(`http://api.weatherapi.com/v1/forecast.json?key=9cc3c6773a8041cab4741910220104&q=${cityInput}`)

        .then(response=> response.json())
        .then(data => {

            console.log(data);

            temp.innerHTML = data.current.temp_c + "&#176;";
            conditionOutput.innerHTML = data.current.condition.text;


            const date= data.location.localtime;
            const y = parseInt(date.substr(0,4));
            const m = parseInt(date.substr(5,2));
            const d = parseInt(date.substr(8,2));
            const time = date.substr(11);

            timeOutput.innerHTML = time;

            nameOutput.innerHTML = data.location.name;

            const iconId = data.current.condition.icon.substr(
                "//cdn.weatherapi.com/weather/64x64/".length);
                icon.src = "../icons/" + iconId;


                cloudOutput.innerHTML = data.current.cloud + "%";
                humidityOutput.innerHTML = data.current.humidity + "%";
                windOutput.innerHTML = data.current.wind_kph + "km/h";

                let timeOfDay = "day";

                const code = data.current.condition.code;

                if(!data.current.is_day){
                    timeOfDay = "night";
                    }
                if(code == 1000){

                    btn.style.background = "#e5ba92";
                    if(timeOfDay == "night"){
                        btn.style.background= "#181e27";
                    }

                }

                else if (

                    code == 1003 ||
                    code == 1006 ||
                    code == 1009 ||
                    code == 1030 ||
                    code == 1069 ||
                    code == 1087 ||
                    code == 1135 ||
                    code == 1273 ||
                    code == 1276 ||
                    code == 1279 ||
                    code == 1282

                ){
                    btn.style.background = "#fa6d1b";
                    if(timeOfDay == "night"){
                        btn.style.background = "#181e27";
                    }
                }

                app.style.opacity = "1";

        })

        .catch(()=>{
            alert('ciudad no encontrada, porfavor ingrese otra ciudad');
            app.style.opacity = "1";

        });
        
    }
    fetchWeatherData();

    app.style.opacity="1";

</script>
</html>

