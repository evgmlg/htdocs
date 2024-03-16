<?php
$servername = "localhost";
$dbname = "esp_data";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die ("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, temperature, humidity, illumination, pressure, reading_time FROM Sensor ORDER BY reading_time DESC LIMIT 40";
$result = $conn->query($sql);

$sensor_data = array();

while ($data = $result->fetch_assoc()) {
  $sensor_data[] = $data;
}

$readings_time = array_column($sensor_data, 'reading_time');
$temperature = array_reverse(array_column($sensor_data, 'temperature'));
$humidity = array_reverse(array_column($sensor_data, 'humidity'));
$illumination = array_reverse(array_column($sensor_data, 'illumination'));
$pressure = array_reverse(array_column($sensor_data, 'pressure'));

$response = array(
  'temperature' => $temperature,
  'humidity' => $humidity,
  'illumination' => $illumination,
  'pressure' => $pressure,
  'reading_time' => array_reverse($readings_time)
);

header('Content-Type: application/json');
echo json_encode($response, JSON_NUMERIC_CHECK);

$result->free();
$conn->close();
?>