#S1 - Esq Perto
#Cenario 1
data=$(date +"%H:%M:%S")
echo "Servidor 1 - Cenario 1" >> s1c1.log
echo $data >> s1c1.log
stress-ng -c 2 -l 100 --timeout 120m	#cenario 1
data=$(date +"%H:%M:%S")
echo "Resfriamento Cenario 1" >> s1c1.log
echo $data >> s1c1.log
stress-ng -c 2 -l 10 --timeout 120m						 	#resfriamento 1

#cenario 2
data=$(date +"%H:%M:%S")
echo "Servidor 1 - Cenario 2" >> s1c2.log
echo $data >> s1c2.log
stress-ng -c 2 -l 100 --timeout 120m	#cenario 2
data=$(date +"%H:%M:%S")
echo "Resfriamento Cenario 2" >> s1c2.log
echo $data >> s1c2.log
stress-ng -c 2 -l 10 --timeout 120m							#resfriamento 2

#cenario 3
data=$(date +"%H:%M:%S")
echo "Servidor 1 - Cenario 3" >> s1c3.log
echo $data >> s1c3.log
stress-ng -c 2 -l 100 --timeout 120m	#cenario 3
data=$(date +"%H:%M:%S")
echo "Resfriamento Cenario 3" >> s1c3.log
echo $data >> s1c3.log
stress-ng -c 2 -l 10 --timeout 120m							#resfriamento 3

#2 Rodada de testes
#Cenario 1
data=$(date +"%H:%M:%S")
echo "Servidor 1 - Cenario 1" >> s1c1.log
echo $data >> s1c1.log
stress-ng -c 2 -l 100 --timeout 120m	#cenario 1
data=$(date +"%H:%M:%S")
echo "Resfriamento Cenario 1" >> s1c1.log
echo $data >> s1c1.log
stress-ng -c 2 -l 10 --timeout 120m						 	#resfriamento 1

#cenario 2
data=$(date +"%H:%M:%S")
echo "Servidor 1 - Cenario 2" >> s1c2.log
echo $data >> s1c2.log
stress-ng -c 2 -l 100 --timeout 120m	#cenario 2
data=$(date +"%H:%M:%S")
echo "Resfriamento Cenario 2" >> s1c2.log
echo $data >> s1c2.log
stress-ng -c 2 -l 10 --timeout 120m							#resfriamento 2

#cenario 3
data=$(date +"%H:%M:%S")
echo "Servidor 1 - Cenario 3" >> s1c3.log
echo $data >> s1c3.log
stress-ng -c 2 -l 100 --timeout 120m	#cenario 3
data=$(date +"%H:%M:%S")
echo "Resfriamento Cenario 3" >> s1c3.log
echo $data >> s1c3.log
stress-ng -c 2 -l 10 --timeout 120m							#resfriamento 3