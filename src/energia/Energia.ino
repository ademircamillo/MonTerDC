#include <MonTerDC.h>
#include "EmonLib.h"

MonTerDC dispositivo("46347894fr562hfkplp32400", 3);
EnergyMonitor emon1;

//Tensao da rede eletrica
int rede = 220;

//Pino do sensor SCT
int pino_sct = A0; 



void setup()
{
  Serial.begin(9600);     // Inicializa comunicação serial
  emon1.current(pino_sct, 60);
  Serial.println("Inicializando");
  dispositivo.inicializa();
  
}

void loop()
{
    double Irms = emon1.calcIrms(1480);
  //Mostra o valor da corrente no serial monitor e display
  Serial.print("Corrente : ");
  Serial.println(Irms); // Irms

  dispositivo.sendGET("/mestrado/get.php?tokenDispositivo="+dispositivo.token()+"&consumo="+Irms);
  
  digitalWrite(13,HIGH);
  delay(100);
  digitalWrite(13,LOW);
  delay(2000); // Aguarda 5 segundo e reinicia o processo
}
