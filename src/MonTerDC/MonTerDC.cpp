#include "MonTerDC.h"

MonTerDC::MonTerDC(String tokenDispositivo, int idDispositivo)
{
	_tokenDispositivo = tokenDispositivo;
	_idDispositivo = idDispositivo;
}

void MonTerDC::inicializa()
{
	uint8_t mac[6] = {0x10,0x01,0x02,0x03,0x04,_idDispositivo};
	Ethernet.begin(mac);
	Serial.println(Ethernet.localIP());
}

void MonTerDC::inicializa(IPAddress ip, IPAddress gateway, IPAddress dnsname, IPAddress mask)
{
	uint8_t mac[6] = {0x10,0x01,0x02,0x03,0x04,_idDispositivo};
	Ethernet.begin(mac, ip, dnsname, gateway, mask);
	Serial.println(Ethernet.localIP());
}

int MonTerDC::id()
{
	return _idDispositivo;
}
String MonTerDC::token()
{
	return _tokenDispositivo;
}

boolean MonTerDC::sendGET(String dados)
{
	EthernetClient _clientGet;
	if (_clientGet.connect("ademircamillo.com.br", 80))
	{
		_clientGet.println("GET "+dados+" HTTP/1.1");
		_clientGet.println(F("Host: ademircamillo.com.br"));
		_clientGet.println(F("Connection: close"));
		_clientGet.println();  
		_clientGet.stop();
		_clientGet.flush();
		return true;
	}else
	{
		_clientGet.stop();
		_clientGet.flush();
		return false;
	}
}