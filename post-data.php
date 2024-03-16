<?php
$servername = "localhost"; // Адрес вашего сервера MySQL
$username = "root"; // Ваше имя пользователя MySQL
$password = ""; // Ваш пароль MySQL
$dbname = "esp_data"; // Имя вашей базы данных MySQL

// Создаем подключение
$conn = new mysqli($servername, $username, $password, $dbname);
// Проверяем подключение
if ($conn->connect_error) {
  die ("Ошибка подключения: " . $conn->connect_error);
}

$temperature = $_GET['temperature'];
$humidity = $_GET['humidity'];
$illumination = $_GET["illumination"];
$pressure = $_GET["pressure"];
$sql = "INSERT INTO sensor (temperature, humidity, illumination, pressure) VALUES ('$temperature', '$humidity','$illumination', '$pressure')";

if ($conn->query($sql) === TRUE) {
  echo "Данные успешно добавлены";
} else {
  echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>