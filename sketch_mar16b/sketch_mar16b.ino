#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <DHT.h>

#include <Adafruit_BMP085.h>
#include <Wire.h>

#define DHTPIN D4     // Пин, к которому подключен датчик DHT11
#define DHTTYPE DHT11 // Тип датчика

#define LEDPIN A0

const char* ssid = "Datvi";      // Название вашей WiFi сети
const char* password = "11223344";  // Пароль для подключения к WiFi

const char* serverAddress = "http://192.168.43.116/post-data.php"; // Адрес сервера для отправки данных

DHT dht(DHTPIN, DHTTYPE);
Adafruit_BMP085 bmp;

void setup() {
  Serial.begin(115200);
  delay(10);

  dht.begin();
  bmp.begin();

  // Подключение к WiFi сети
  Serial.println();
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);

  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connected");

  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
}

void loop() {
  delay(10000);

  float humidity = dht.readHumidity();
  float temperature = dht.readTemperature();

  float illumination = analogRead(LEDPIN);

  float pressure = bmp.readPressure() * 0.00750063755419211;

  if (isnan(humidity) || isnan(temperature)) {
    Serial.println("Failed to read from DHT sensor!");
    return;
  }

  Serial.print("Humidity: ");
  Serial.print(humidity);
  Serial.print(" %\t");
  Serial.print("Temperature: ");
  Serial.print(temperature);
  Serial.println(" *C");
  Serial.print("Illumination: ");
  Serial.print(illumination);
  Serial.println(" Lm");

  Serial.print("Давление (мм рт. ст.) = ");
  Serial.print(bmp.readPressure() * 0.00750063755419211); // Переводим давление из ПА в мм рт. ст. и выводим в консоль
  Serial.println();
  
  
  // Отправка данных на сервер
  HTTPClient http;
  WiFiClient client;
  String url = String(serverAddress) + "?temperature=" + String(temperature) + "&humidity=" + String(humidity)+ "&illumination=" + String(illumination)+ "&pressure=" + String(pressure);

  Serial.print("Sending data to server: ");
  Serial.println(url);

  http.begin(client,url);
  int httpCode = http.GET();
  
  if (httpCode > 0) {
    Serial.printf("[HTTP] GET... code: %d\n", httpCode);
    if (httpCode == HTTP_CODE_OK || httpCode == HTTP_CODE_MOVED_PERMANENTLY) {
      String payload = http.getString();
      Serial.println("Server response: ");
      Serial.println(payload);
    }
  } else {
    Serial.printf("[HTTP] GET... failed, error: %s\n", http.errorToString(httpCode).c_str());
  }

  http.end();
}
