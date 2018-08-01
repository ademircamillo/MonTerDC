#include <LiquidCrystal.h>
#include <DHT.h>
 
//DHT11
#define DHTTYPE DHT11
DHT dhtAr(8, DHTTYPE);
DHT dhtExt(7, DHTTYPE);

LiquidCrystal lcd(12, 11, 5, 4, 3, 2);

float coefRefrigeracao = 0;


//Botões Servidores
int botaoServidor1 = 36;
int botaoServidor2 = 37;
int botaoServidor3 = 38;
int botaoServidor4 = 39;
int botaoServidor5 = 40;
int botaoServidor6 = 41;
int botaoServidor7 = 42;
int botaoServidor8 = 43;
int botaoServidor9 = 44;


//Led Servidores
int portaServidor1 = 22;
int portaServidor2 = 23;
int portaServidor3 = 24;
int portaServidor4 = 25;
int portaServidor5 = 26;
int portaServidor6 = 27;
int portaServidor7 = 28;
int portaServidor8 = 29;
int portaServidor9 = 30;

//Potenciometros
int portaVelocidadeCooler = A14;
int portaPotenciaCooler = A15;

int servidor1 = HIGH;
int servidor2 = HIGH;
int servidor3 = HIGH;
int servidor4 = HIGH;
int servidor5 = HIGH;
int servidor6 = HIGH;
int servidor7 = HIGH;
int servidor8 = HIGH;
int servidor9 = HIGH;

int portaSensorT1 = A1;
int portaSensorT2 = A2;
int portaSensorT3 = A3;
int portaSensorT4 = A4;
int portaSensorT5 = A5;
int portaSensorT6 = A6;
int portaSensorT7 = A7;
int portaSensorT8 = A8;
int portaSensorT9 = A9;

int velocidadeCooler = 0;
int potenciaCooler = 0;

float sensorT1 = 0;
float sensorT2 = 0;
float sensorT3 = 0;
float sensorT4 = 0;
float sensorT5 = 0;
float sensorT6 = 0;
float sensorT7 = 0;
float sensorT8 = 0;
float sensorT9 = 0;
float sensorT10 = 0;
float sensorT11 = 0;

int contadorTempo = 0;
int contadorRolagem = 0;
int contadorPotencia = 0;
int contadorVelocidade = 0;

void setup() 
{
  Serial.begin(9600);
  //Definição das portas dos botões
  pinMode(portaServidor1, OUTPUT);
  pinMode(portaServidor2, OUTPUT);
  pinMode(portaServidor3, OUTPUT);
  pinMode(portaServidor4, OUTPUT);
  pinMode(portaServidor5, OUTPUT);
  pinMode(portaServidor6, OUTPUT);
  pinMode(portaServidor7, OUTPUT);
  pinMode(portaServidor8, OUTPUT);
  pinMode(portaServidor9, OUTPUT);
  
  //Definição das portas dos sensores
  pinMode(portaSensorT1, INPUT);
  pinMode(portaSensorT2, INPUT);
  pinMode(portaSensorT3, INPUT);
  pinMode(portaSensorT4, INPUT);
  pinMode(portaSensorT5, INPUT);
  pinMode(portaSensorT6, INPUT);
  pinMode(portaSensorT7, INPUT);
  pinMode(portaSensorT8, INPUT);
  pinMode(portaSensorT9, INPUT);
  
  //Definição dos botões dos Servidores
  pinMode(botaoServidor1, INPUT);
  pinMode(botaoServidor2, INPUT);
  pinMode(botaoServidor3, INPUT);
  pinMode(botaoServidor4, INPUT);
  pinMode(botaoServidor5, INPUT);
  pinMode(botaoServidor6, INPUT);
  pinMode(botaoServidor7, INPUT);
  pinMode(botaoServidor8, INPUT);
  pinMode(botaoServidor9, INPUT);

  //Definição das portas dos potenciometros
  pinMode(portaVelocidadeCooler, INPUT);
  pinMode(portaPotenciaCooler, INPUT);

  lcd.begin(16, 2);
  lcd.setCursor(4, 0);
  lcd.print("BEM VINDO!");
  delay(2000);
  lcd.clear();
  lcd.setCursor(3, 0);
  lcd.print("AGUARDE...");
  lcd.setCursor(3, 1);
  lcd.print("CALIBRANDO");
  delay(2000);
  digitalWrite(portaServidor1, HIGH);
  delay(500);
  digitalWrite(portaServidor2, HIGH);
  delay(500);
  digitalWrite(portaServidor3, HIGH);
  delay(500);
  digitalWrite(portaServidor4, HIGH);
  delay(500);
  digitalWrite(portaServidor5, HIGH);
  delay(500);
  digitalWrite(portaServidor6, HIGH);
  delay(500);
  digitalWrite(portaServidor7, HIGH);
  delay(500);
  digitalWrite(portaServidor8, HIGH);
  delay(500);
  digitalWrite(portaServidor9, HIGH);
  delay(4000);
  
  lcd.clear();
  lcd.setCursor(4, 0);
  lcd.print("CALIBRAGEM");
  lcd.setCursor(5, 1);
  lcd.print("COMPLETA");
  digitalWrite(portaServidor1, LOW);
  digitalWrite(portaServidor2, LOW);
  digitalWrite(portaServidor3, LOW);
  digitalWrite(portaServidor4, LOW);
  digitalWrite(portaServidor5, LOW);
  digitalWrite(portaServidor6, LOW);
  digitalWrite(portaServidor7, LOW);
  digitalWrite(portaServidor8, LOW);
  digitalWrite(portaServidor9, LOW);
  delay(2000);

  potenciaCooler = analogRead(portaPotenciaCooler);
  velocidadeCooler = analogRead(portaVelocidadeCooler);
  sensorT1 = leSensor(portaSensorT1);
  sensorT2 = leSensor(portaSensorT2);
  sensorT3 = leSensor(portaSensorT3);
  sensorT4 = leSensor(portaSensorT4);
  sensorT5 = leSensor(portaSensorT5);
  sensorT6 = leSensor(portaSensorT6);
  sensorT7 = leSensor(portaSensorT7);
  sensorT8 = leSensor(portaSensorT8);
  sensorT9 = leSensor(portaSensorT9);
  potenciaCooler = map(analogRead(portaPotenciaCooler), 1024, 0, 0, 100);
  velocidadeCooler = map(analogRead(portaVelocidadeCooler), 1024, 0, 0, 100);
  mostraTemperaturaServidores(sensorT1,sensorT2,sensorT3,sensorT4,sensorT5,sensorT6,sensorT7,sensorT8,sensorT9);
  
}

void loop() 
{
  int leituraTemp = 0;
  
  //Controle dos Botões
  if(digitalRead(botaoServidor1) == LOW)
  {
    Serial.print("Servidor 1 - Botao: ");
    servidor1 = digitalRead(portaServidor1);
    digitalWrite(portaServidor1, !servidor1);
    servidor1 != servidor1;
    Serial.println(servidor1);
    mostraBotaoPressionado(1,servidor1);
    delay(200);    
  }
  if(digitalRead(botaoServidor2) == LOW)
  {
    Serial.println("Servidor 2 - Botao");
    servidor2 = digitalRead(portaServidor2);
    digitalWrite(portaServidor2, !servidor2);
    servidor2 != servidor2;
    mostraBotaoPressionado(2,servidor2);
    delay(200);    
  }
  if(digitalRead(botaoServidor3) == LOW)
  {
    Serial.println("Servidor 3 - Botao");
    servidor3 = digitalRead(portaServidor3);
    digitalWrite(portaServidor3, !servidor3);
    servidor3 != servidor3;
    mostraBotaoPressionado(3,servidor3);
    delay(200);    
  }
  if(digitalRead(botaoServidor4) == LOW)
  {
    Serial.println("Servidor 4 - Botao");
    servidor4 = digitalRead(portaServidor4);
    digitalWrite(portaServidor4, !servidor4);
    servidor4 != servidor4;
    mostraBotaoPressionado(4,servidor4);
    delay(200);    
  }
  if(digitalRead(botaoServidor5) == LOW)
  {
    Serial.println("Servidor 5 - Botao");
    servidor5 = digitalRead(portaServidor5);
    digitalWrite(portaServidor5, !servidor5);
    servidor5 != servidor5;
    mostraBotaoPressionado(5,servidor5);
    delay(200);    
  }
  if(digitalRead(botaoServidor6) == LOW)
  {
    Serial.println("Servidor 6 - Botao");
    servidor6 = digitalRead(portaServidor6);
    digitalWrite(portaServidor6, !servidor6);
    servidor6 != servidor6;
    mostraBotaoPressionado(6,servidor6);
    delay(200);    
  }
  if(digitalRead(botaoServidor7) == LOW)
  {
    Serial.println("Servidor 7 - Botao");
    servidor7 = digitalRead(portaServidor7);
    digitalWrite(portaServidor7, !servidor7);
    servidor7 != servidor7;
    mostraBotaoPressionado(7,servidor7);
    delay(200);    
  }
  if(digitalRead(botaoServidor8) == LOW)
  {
    Serial.println("Servidor 8 - Botao");
    servidor8 = digitalRead(portaServidor8);
    digitalWrite(portaServidor8, !servidor8);
    servidor8 != servidor8;
    mostraBotaoPressionado(8,servidor8);
    delay(200);    
  }
  if(digitalRead(botaoServidor9) == LOW)
  {
    Serial.println("Servidor 9 - Botao");
    servidor9 = digitalRead(portaServidor9);
    digitalWrite(portaServidor9, !servidor9);
    servidor9 != servidor9;
    mostraBotaoPressionado(9,servidor9);
    delay(200);    
  }

  if(contadorRolagem<300)
  {
    contadorTempo++;
    if(contadorTempo>40)
    {
      //Serial.println("Exibe informaoes dos sensores!");
      //Leitura dos Sensores
      sensorT1 = leSensor(portaSensorT1);
      sensorT2 = leSensor(portaSensorT2);
      sensorT3 = leSensor(portaSensorT3);
      sensorT4 = leSensor(portaSensorT4);
      sensorT5 = leSensor(portaSensorT5);
      sensorT6 = leSensor(portaSensorT6);
      sensorT7 = leSensor(portaSensorT7);
      sensorT8 = leSensor(portaSensorT8);
      sensorT9 = leSensor(portaSensorT9);
      
      contadorTempo = 0;
      mostraTemperaturaServidores(sensorT1,sensorT2,sensorT3,sensorT4,sensorT5,sensorT6,sensorT7,sensorT8,sensorT9);
    }
    contadorRolagem++;
  }else
  {
    contadorTempo++;
    if(contadorTempo>20)
    {
      //int humidade = dht.readHumidity(); //Le o valor da umidade
      sensorT10 = dhtAr.readTemperature(); //Le o valor da temperatura
      sensorT11 = dhtExt.readTemperature(); //Le o valor da temperatura
      //Serial.println(t);
      //Serial.println("Exibe informaoes refrigeracao!");
      mostraRefrigeracao(sensorT10, sensorT11, velocidadeCooler, potenciaCooler);
      contadorTempo = 0;
    }
    contadorRolagem++;
    if(contadorRolagem>600)
    {
      contadorRolagem = 0;
    }
  }
  
  
 if(contadorVelocidade > 20)
  {
    leituraTemp = map(analogRead(portaVelocidadeCooler), 1024, 0, 0, 100);
    if(leituraTemp > velocidadeCooler+2 || leituraTemp < velocidadeCooler-2)
    {
       //Potenciometro alterado
      delay(400);
      leituraTemp = map(analogRead(portaVelocidadeCooler), 1024, 0, 0, 100);
      Serial.print("Velocidade Cooler Alterada: ");
      Serial.println(leituraTemp);
      mostraVelocidadeCooler(leituraTemp);
      velocidadeCooler=leituraTemp;
    }
    contadorVelocidade = 0;
  }
  contadorVelocidade++;

  if(contadorPotencia > 20)
  {
    leituraTemp = map(analogRead(portaPotenciaCooler), 1024, 0, 0, 100);
    if(leituraTemp > potenciaCooler+2 || leituraTemp < potenciaCooler-2)
    {
       //Potenciometro alterado
      delay(400);
      leituraTemp = map(analogRead(portaPotenciaCooler), 1024, 0, 0, 100);
      Serial.print("Potencia Cooler Alterada: ");
      Serial.println(leituraTemp);
      mostraPotenciaCooler(leituraTemp);
      potenciaCooler=leituraTemp;
    }
    contadorPotencia = 0;
  }
  contadorPotencia++;

  delay(10);
  

}

void mostraTemperaturaServidores(int s1, int s2, int s3, int s4, int s5, int s6, int s7, int s8, int s9)
{
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print(s9);  
  lcd.setCursor(0, 1);
  lcd.print(s1);
  lcd.setCursor(4, 0);
  lcd.print(s8);  
  lcd.setCursor(4, 1);
  lcd.print(s2); 
  lcd.setCursor(8, 0);
  lcd.print(s7);  
  lcd.setCursor(8, 1);
  lcd.print(s3); 
  lcd.setCursor(12, 0);
  lcd.print(s6);  
  lcd.setCursor(12, 1);
  lcd.print(s4);

  //Quebra a String e pegar o primeiro e segundo do S5
  String ss5 = String(s5);
  lcd.setCursor(15, 0);
  lcd.print(ss5.substring(0,1));
  lcd.setCursor(15, 1);
  lcd.print(ss5.substring(1,2));
}

void mostraRefrigeracao(int s10, int s11, int potVel, int potPot)
{
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("VEL");  
  lcd.setCursor(4, 0);
  lcd.print(potVel);
  lcd.setCursor(7, 0);
  lcd.print("%");  
  lcd.setCursor(9, 0);
  lcd.print("  AR"); 
  lcd.setCursor(14, 0);
  lcd.print(s10);  
  
  lcd.setCursor(0, 1);
  lcd.print("POT");  
  lcd.setCursor(4, 1);
  lcd.print(potPot);
  lcd.setCursor(7, 1);
  lcd.print("%");  
  lcd.setCursor(10, 1);
  lcd.print("EXT"); 
  lcd.setCursor(14, 1);
  lcd.print(s11);
}

void mostraBotaoPressionado(int servidor, boolean statusServidor)
{
  lcd.clear();
  lcd.setCursor(3, 0);
  lcd.print("SERVIDOR");  
  lcd.setCursor(12, 0);
  lcd.print(servidor); 
  
  if(!statusServidor)
  {
    lcd.setCursor(5, 1); 
    lcd.print("ATIVADO");
  }
   else
   {
    lcd.setCursor(3, 1); 
    lcd.print("DESATIVADO");
   }
   contadorTempo = 0;
   contadorRolagem = 0;
   delay(2000);
}

void mostraVelocidadeCooler(int velocidade)
{
  lcd.clear();
  lcd.setCursor(3, 0);
  lcd.print("VELOCIDADE");  
  lcd.setCursor(6, 1);
  lcd.print(velocidade); 
  lcd.setCursor(9, 1); 
  lcd.print("%");
  contadorTempo = 0;
   contadorRolagem = 0;
  delay(2000);
}

void mostraPotenciaCooler(int potencia)
{
  lcd.clear();
  lcd.setCursor(3, 0);
  lcd.print("POTENCIA");  
  lcd.setCursor(6, 1);
  lcd.print(potencia); 
  lcd.setCursor(9, 1); 
  lcd.print("%");
  contadorTempo = 0;
  contadorRolagem = 0;
  delay(2000);
}

float leSensor(int sensor)
{
  float tempc; 
  int qtdeLeituras = 20;
  float samples[20]; // Array para precisão na medição
  int i;
  for(i = 0;i<qtdeLeituras;i++)
  {
    samples[i] = ( 5.0 * analogRead(sensor) * 100.0) / 1023.0;
    tempc = tempc + samples[i]; 
    delay(20);
  }
  Serial.print("Sensor: ");
  Serial.print(sensor-54);
  Serial.print(" Temp: ");
  Serial.println(tempc/qtdeLeituras);
  
  return tempc/qtdeLeituras;
}
