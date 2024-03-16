<?php
//Настройка
$servername = "localhost";
//Название БД
$dbname = "esp_data";
//Имя пользователя
$username = "root";
//Пароль
$password = "";

// Создаем соединение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение
if ($conn->connect_error) {

  die ("Connection failed: " . $conn->connect_error);

}

$sql = "SELECT id, temperature, humidity, illumination, pressure, reading_time FROM Sensor order by reading_time desc limit 40";

$result = $conn->query($sql);

while ($data = $result->fetch_assoc()) {
  $sensor_data[] = $data;
}

$readings_time = array_column($sensor_data, 'reading_time');

$temperature = json_encode(array_reverse(array_column($sensor_data, 'temperature')), JSON_NUMERIC_CHECK);

$humidity = json_encode(array_reverse(array_column($sensor_data, 'humidity')), JSON_NUMERIC_CHECK);

$illumination = json_encode(array_reverse(array_column($sensor_data, 'illumination')), JSON_NUMERIC_CHECK);

$pressure = json_encode(array_reverse(array_column($sensor_data, 'pressure')), JSON_NUMERIC_CHECK);

$reading_time = json_encode(array_reverse($readings_time), JSON_NUMERIC_CHECK);


$result->free();

$conn->close();

?>

<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">

<head>
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<title>Метеостанция</title>
<style>
  body {
    min-width: 100px;
    max-width: 1280px;
    height: 500px;
    margin: 0 auto;
  }

  h2 {
    font-family: Arial;
    font-size: 2.5rem;
    text-align: center;
  }

  .container {
    margin-bottom: 20px;
    border: solid;
    border-width: 1px;
    border-color: #d7e0da;
    box-shadow: 1px 1px 10px #e0d8d7;
  }
</style>

<body>

  <h2>ГРАФИКИ ДАТЧИКОВ</h2>
  <div id="chart-light" class="container"></div>
  <div id="chart-humidity" class="container"></div>
  <div id="chart-temperature" class="container"></div>
  <div id="chart-pressure" class="container"></div>
  <div id="chart-all" class="container"></div>

  <script>
    Highcharts.setOptions({
      accessibility: {
        enabled: false
      }
    });

    var chartL, chartH, chartT, chartP, chartAll;

    function requestData() {
      $.ajax({
        url: 'update_data.php',
        success: function (data) {
          updateCharts(data);
          setTimeout(requestData, 1000);
        },
        error: function (xhr, status, error) {
          console.error("Ошибка при получении данных:", error);
          setTimeout(requestData, 5000);
        },
        cache: false
      });
    }

    function updateCharts(data) {
      var temperature = data.temperature;
      var humidity = data.humidity;
      var illumination = data.illumination;
      var pressure = data.pressure;
      var reading_time = data.reading_time;

      chartL.series[0].setData(illumination);
      chartH.series[0].setData(humidity);
      chartT.series[0].setData(temperature);
      chartP.series[0].setData(pressure);
      chartL.xAxis[0].setCategories(reading_time);
      chartH.xAxis[0].setCategories(reading_time);
      chartT.xAxis[0].setCategories(reading_time);
      chartP.xAxis[0].setCategories(reading_time);

      chartAll.series[0].setData(illumination);
      chartAll.series[1].setData(humidity);
      chartAll.series[2].setData(temperature);
      chartAll.series[3].setData(pressure);
      chartAll.xAxis[0].setCategories(reading_time)

    }

    $(document).ready(function () {

      chartAll = new Highcharts.Chart({
        chart: {
          renderTo: 'chart-all'
        },
        title: {
          text: 'Общий график'
        },
        series: [{
          name: 'Свет',
          showInLegend: true,
          color: '#d7e0da',
          data: [],
          zones: [{
            value: 10,
            color: '#59615b'
          }, {
            value: 50,
            color: '#e0f299'
          }, {
            color: '#f6ff00'
          }]
        }, {
          name: 'Влажность',
          showInLegend: true,
          data: [],
          color: '#d7e0da',
          zones: [{
            value: 10,
            color: '#db9e04'
          }, {
            value: 60,
            color: '#03fc4e'
          }, {
            color: '#03a5fc'
          }]
        }, {
          name: 'Температура',
          showInLegend: true,
          data: [],
          color: '#d7e0da',
          zones: [{
            value: 3,
            color: '#0004ff'
          }, {
            value: 30,
            color: '#00fff2'
          }, {
            color: '#ff0000'
          }]
        }],
        plotOptions: {
          line: {
            animation: false,
            dataLabels: {
              enabled: true
            }
          }
        },
        xAxis: {
          crosshair: true,
          type: 'datetime'
        },
        yAxis: {
          crosshair: true,
          title: {
            text: 'Значения'
          }
        },
        credits: {
          enabled: false
        },
      });

      chartL = new Highcharts.Chart({
        chart: {
          renderTo: 'chart-light'
        },
        title: {
          text: 'Показания с датчика света'
        },
        series: [{
          showInLegend: false,
          data: [],
          zones: [{
            value: 10,
            color: '#59615b'
          }, {
            value: 50,
            color: '#e0f299'
          }, {
            color: '#f6ff00'
          }],
          turboThreshold: 1,
        }],
        plotOptions: {
          line: {
            animation: false,
            dataLabels: {
              enabled: true
            }
          },
          series: {
            name: 'Свет',
            color: '#deeb34'
          }
        },
        xAxis: {
          crosshair: true,
          type: 'datetime'
        },
        yAxis: {
          crosshair: true,
          title: {
            text: 'Освещенность в люменах (лм)'
          },
          labels: {
            format: '{value}лм'
          }
        },
        credits: {
          enabled: false
        }
      });

      chartH = new Highcharts.Chart({
        chart: {
          renderTo: 'chart-humidity'
        },
        title: {
          text: 'Показания с датчика влажности DHT11'
        },
        series: [{
          name: 'Влажность',
          showInLegend: false,
          data: [],
          zones: [{
            value: 10,
            color: '#db9e04'
          }, {
            value: 60,
            color: '#03fc4e'
          }, {
            color: '#03a5fc'
          }]
        }],
        plotOptions: {
          line: {
            animation: false,
            dataLabels: {
              enabled: true
            }
          }
        },
        xAxis: {
          crosshair: true,
          type: 'datetime'
        },
        yAxis: {
          crosshair: true,
          title: {
            text: 'Влажность в процентах (%)'
          },
          labels: {
            format: '{value}%'
          }
        },
        credits: {
          enabled: false
        }
      });

      chartT = new Highcharts.Chart({
        chart: {
          renderTo: 'chart-temperature'
        },
        title: {
          text: 'Показания с датчика температуры DHT11'
        },
        series: [{
          name: 'Температура',
          format: '{value}°',
          showInLegend: false,
          data: [],
          color: '#eb3d34',
          zones: [{
            value: 3,
            color: '#0004ff'
          }, {
            value: 30,
            color: '#00fff2'
          }, {
            color: '#ff0000'
          }]
        }],
        plotOptions: {
          line: {
            animation: false,
            dataLabels: {
              enabled: true
            }
          }
        },
        xAxis: {
          crosshair: true,
          type: 'datetime'
        },
        yAxis: {
          crosshair: true,
          title: {
            text: 'Температура в цельсиях (°C)'
          },
          labels: {
            format: '{value}°'
          }
        },
        credits: {
          enabled: false
        }
      });

      chartP = new Highcharts.Chart({
        chart: {
          renderTo: 'chart-pressure'
        },
        title: {
          text: "Показания с датчика давления HW-596"
        },
        series: [{
          name: 'Давление',
          format: '{value}inHg',
          showInLegend: false,
          data: [],
          color: '#eb3d34',
          zones: [{
            value: 3,
            color: '#0004ff'
          }, {
            value: 30,
            color: '#00fff2'
          }, {
            color: '#ff0000'
          }]
        }],
        plotOptions: {
          line: {
            animation: false,
            dataLabels: {
              enabled: true
            }
          }
        },
        xAxis: {
          crosshair: true,
          type: 'datetime'
        },
        yAxis: {
          crosshair: true,
          title: {
            text: 'Давление в мм рт. ст. (inHg)'
          },
          labels: {
            format: '{value}inHg'
          }
        },
        credits: {
          enabled: false
        }
      });

      // Начальное получение данных
      requestData();
    });
  </script>

</body>

</html>