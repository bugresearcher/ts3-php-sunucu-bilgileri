<?php

     
		
		error_reporting(E_ALL);
        echo "● bitti\n";
		require_once 'ayar.php';
        if (ayarlariyenile())
        {			
			echo "bitti.\n";
        }
        else
        {
            echo "nieudane.\n";
        }
        echo "● bitti: ";
		
        $tsAdmin = new ts3admin($server['address'], $server['tcp']);

        if($tsAdmin->getElement('success', $tsAdmin->connect()))
        {
				echo " bitti.\n";
                $tsAdmin->login($server['login'],$server['password']);
                $tsAdmin->selectServer($server['udp']);
                $tsAdmin->setName(' '.$server['bot_name']);
				echo "● bitti ".$server['bot_name']."\n";
                $core = $tsAdmin->getElement('data',$tsAdmin->whoAmI());
                $tsAdmin->clientMove($core['client_id'],$server['bot_channel']."\n");
				echo "● bitti ".$server['bot_channel']."\n";
				
                while(true)
                {
					$serverInfo = $tsAdmin->getElement('data', $tsAdmin->serverInfo());
					if($c['channels']['clientsOnline'][0]){
						$clientsOnline = ($serverInfo['virtualserver_clientsonline'] - $serverInfo['virtualserver_queryclientsonline']);
						$tsAdmin->channelEdit($c['channels']['clientsOnline'][2], array('channel_name' => str_replace(array("[online]", "[slots]"), array($clientsOnline, $serverInfo['virtualserver_maxclients']), $c['channels']['clientsOnline'][1])));
					}
					if($c['channels']['onlineRecord'][0]){
						if (file_exists($c['channels']['onlineRecord'][3]))
						{
							$record = file_get_contents($c['channels']['onlineRecord'][3]); 
							$tmp = explode(':', $record);
							if ($tmp[0] < ($serverInfo['virtualserver_clientsonline'] - $serverInfo['virtualserver_queryclientsonline']))
							{
								$record = ($serverInfo['virtualserver_clientsonline'] - $serverInfo['virtualserver_queryclientsonline']) . ':' . time();
								file_put_contents($c['channels']['onlineRecord'][3], $record);
							}
						}
						else
						{
							$record = ($serverInfo['virtualserver_clientsonline'] - $serverInfo['virtualserver_queryclientsonline']) . ':' . time();
							file_put_contents($c['channels']['onlineRecord'][3], $record);
						}
						list($record, $recordTime) = explode(':', $record);
						
						$clientsOnline = ($serverInfo['virtualserver_clientsonline'] - $serverInfo['virtualserver_client_connections']);
						$tsAdmin->channelEdit($c['channels']['onlineRecord'][2], array('channel_name' => str_replace(array("[record]", "[slots]"), array($record, $serverInfo['virtualserver_maxclients']), $c['channels']['onlineRecord'][1])));
					}
					if($c['channels']['totalPacketlossTotal'][0]){
						$packetLost = round($serverInfo['virtualserver_total_packetloss_total'], 2);
						$tsAdmin->channelEdit($c['channels']['totalPacketlossTotal'][2], array('channel_name' => str_replace("[packet]", $packetLost, $c['channels']['totalPacketlossTotal'][1])));
					}
					if($c['channels']['ping'][0]){
						$ping = round($serverInfo['virtualserver_total_ping']);
						$tsAdmin->channelEdit($c['channels']['ping'][2], array('channel_name' => str_replace("[ping]", $ping, $c['channels']['ping'][1])));
					}
					if($c['channels']['uptime'][0]){
						$uptime = secondsToTime($serverInfo['virtualserver_uptime']);
						$tsAdmin->channelEdit($c['channels']['uptime'][2], array('channel_name' => str_replace("[uptime]", $uptime, $c['channels']['uptime'][1])));
					}
					if($c['channels']['upload'][0]){
						$upload = formatBytes($serverInfo['connection_bandwidth_sent_last_minute_total'], 2);
						$tsAdmin->channelEdit($c['channels']['upload'][2], array('channel_name' => str_replace("[upload]", $upload, $c['channels']['upload'][1])));
					}
					if($c['channels']['download'][0]){
						$download = formatBytes($serverInfo['connection_bandwidth_received_last_minute_total'], 2);
						$tsAdmin->channelEdit($c['channels']['download'][2], array('channel_name' => str_replace("[download]", $download, $c['channels']['download'][1])));
					}
                    if($server['interval'] > 0)
                    {
						sleep($server['interval']);
                    }
                }
        }
        else
        {
                echo " bitti.\n";
        }

?>