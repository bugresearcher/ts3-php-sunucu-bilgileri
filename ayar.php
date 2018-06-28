<?php
 	/*
			Author: Bugresearcher ^
	*/ 
	$server = array();

	$server['address']  	= '127.0.0.1'; // 
	$server['login'] 		= 'serveradmin'; 
	$server['password'] 	= 'querysifreniz'; //
	$server['udp']			= 9987; // 
	$server['tcp']			= 10011; // 
	$server['bot_channel']	= 1; // 
	$server['interval']		= 1; // 
	$server['bot_name']		= 'Bugresearcher'; // 
	
	$c = array();
	$c['channels'] = array(
	
		/*
			# 'clientsOnline' => array(true, 'aktif: [online] / [slots]', 591883),
			Örnek sondaki 591883), bu yerlere kanal idlerini yazıyorsunuz.
		*/
	
	
		'clientsOnline' => array(true, '[cspacer]► Kullanıcı: [online] / [slots]', 2016),
		'onlineRecord' => array(true, '[cspacer]► Rekor Kişiler: [record] / [slots]', 2017, 'cache/record'),
		'totalPacketlossTotal' => array(true, '[cspacer]► Paket Kaybi: [packet] %', 2018),
		'ping' => array(true, '[cspacer]► Ping: [ping] ms', 2019),
		'uptime' => array(true, '[cspacer]► Uptime: [uptime]', 2020),
		'upload' => array(true, '[cspacer]► Upload: [upload]', 2021),
		'download' => array(true, '[cspacer]► Download: [download]', 2022)
	);
	
?>
