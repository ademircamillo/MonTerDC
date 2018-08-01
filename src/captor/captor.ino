#include <MonTerDC.h>

MonTerDC dispositivo("46347894fr562hfkplp32400", 2);
 



void setup()
{
  
  Serial.begin(9600);     // Inicializa comunicação serial
  pinMode(13,OUTPUT);
  digitalWrite(13,LOW);
  
  dispositivo.inicializa();
  
}

void loop()
{
    float tempc[14]; 
      
    for(int porta=0;porta<=13;porta++)
    {
      float samples, temp = 0;
      int i;
      int leitura;
    
      for(i = 0;i<25;i++){ // Loop que faz a leitura da temperatura 8 vezes
        leitura = analogRead(porta);
        while(leitura==0)
          leitura = analogRead(porta);
        samples = ( 5.0 * leitura * 100.0) / 1024.0;
        //Serial.print(" Sample: ");
        //Serial.println(samples);
        temp = temp + samples;
        //Serial.print("Porta: ");
        //Serial.print(porta+1);
        //Serial.print(" Valor: ");
        //Serial.println(temp);
        
        delay(1);
      }
      tempc[porta] = temp; 
             
    }
    // Divide a variavel tempc por 25, para obter precisão na medição
      for(int porta=0;porta<=13;porta++)
      {
        tempc[porta] = tempc[porta]/25.0;
        Serial.print("Sensor: ");
        Serial.print(porta+1);
        Serial.print(" ");
        Serial.print(tempc[porta]);
        Serial.println(" Cels "); 
      }
      dispositivo.sendGET("/mestrado/get.php?tokenDispositivo="+dispositivo.token()+"&s1="+tempc[0]+"&s2="+tempc[1]+"&s3="+tempc[2]+"&s4="+tempc[3]+"&s5="+tempc[4]+"&s6="+tempc[5]+"&s7="+tempc[6]+"&s8="+tempc[7]+"&s9="+tempc[8]+"&s10="+tempc[9]+"&s11="+tempc[10]+"&s12="+tempc[11]+"&s13="+tempc[12]+"&s14="+tempc[13]);
  
digitalWrite(13,HIGH);
delay(100);
digitalWrite(13,LOW);
delay(5000); // Aguarda 5 segundo e reinicia o processo
}
