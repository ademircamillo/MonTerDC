#ifndef MONTERDC_H
#define MONTERDC_H

#include <Arduino.h>
#include <Ethernet.h>
class MonTerDC
{
	public:
		MonTerDC(String tokenDispositivo, int idDispositivo);
		void inicializa();
		void inicializa(IPAddress ip, IPAddress gateway, IPAddress dnsname, IPAddress mask);
		int id();
		String token();
		boolean sendGET(String dados);
		
	private:
		String _tokenDispositivo;
		int _idDispositivo;
};
#endif