int LED = 13;
unsigned long tempoI;
unsigned long tempoF;
void setup()
{
  Serial.begin(9600);
  pinMode(LED, OUTPUT);
  digitalWrite(LED, LOW);
  
}
 
void loop()
{
  randomSeed(analogRead(0));
  int tam = 133; 
  int a[tam];
  tempoI = micros();
  for (int ix = 0; ix < tam; ix++)
  {
    a[ix] = random(0, 1000);
  }
  digitalWrite(LED, HIGH);
  long t = 0;
  for(int i=0; i<(tam-1); i++) 
  {
    for(int o=0; o<(tam-(i+1)); o++) 
    {
      if(a[o] > a[o+1]) 
      {
        t = a[o];
        a[o] = a[o+1];
        a[o+1] = t;
      }
    }
  }
  digitalWrite(LED, LOW);
  tempoF = micros();
  Serial.println(tempoF-tempoI);
  delay(5000);
}
