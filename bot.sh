#!/bin/bash

if [[ $1 == 'kapat' ]]; then 
        screen -S bugresearcher -X quit
		sleep 1
		echo -e "kapandi"
elif [[ $1 == 'ac' ]]; then
	sleep 1
        screen -dmS bugresearcher php bilgi.php
		ps ax | grep -v grep | grep -v -i SCREEN
		echo -e "Baslatildi"
else
	echo -e "kullanicim: ${0} ac/kapat "
 fi


