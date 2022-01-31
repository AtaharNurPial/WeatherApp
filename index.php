<?php
session_start();
if(array_key_exists('search', $_GET)){
    if($_GET['city']){
        $apiData = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".
        $_GET['city']."&appid=$_SESSION['API_KEY']");
        $weatherArray = json_decode($apiData,true);
        //C = K - 273.15
        $tempcelsius = $weatherArray['main']['temp'] - 273.15;
        $tempcelsiusfeels = $weatherArray['main']['feels_like'] - 273.15;
        $city = $weatherArray['name'];
        $country = $weatherArray['sys']['country'];
        $weather = "<strong>City: </strong>" .$city;
        $weather .= ", <strong>Country: </strong>" .$country;
        $weather .= "<br><strong>Weather Condition: </strong> " .$weatherArray['weather']['0']['description'];
        $weather .= "<br><strong>Temperature: </strong>" .$tempcelsius."&deg;C";
        $weather .= "<br><strong>Temperature: </strong>" .$tempcelsiusfeels."&deg;C";
        $weather .= "<br><strong>Atmosphereic Pressure: </strong> " .$weatherArray['main']['pressure']." hPa";
        $weather .= "<br><strong>Humidity: </strong> " .$weatherArray['main']['humidity']." %";
        $weather .= "<br><strong>Wind Speed: </strong> " .$weatherArray['wind']['speed']." m/sec";
      
    }
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="style.css" />
    <title>Weather Viewer</title>
  </head>
  <body>
    <div class="container">
      <div class="card">
        <div class="content">
          <h3>Search Global Weather</h3>
          <hr />
          <form action="" method="GET">
            <input
              type="text"
              name="city"
              placeholder="Enter Your City"
              class="form-control mb-2"
              required
            />
            <button class="btn" name="search">Search</button>          
            <div class="output">
                 <?php
                      if ($weather) {
                         echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';
                      }
                 ?>
          </div>
          </form> 
        </div>
      </div>
    </div>
    <!-- Bootstrap Bundle with Popper -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
