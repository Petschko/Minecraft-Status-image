<?php

// Important: Make sure, that you add a hostname, that realy exists otherwise the image will in some cases NOT load!
$use_get = false;					// Set get vars for server enabled, if this is true you can ignore many config items (not done now)
$serveradress = "";					// Minecraftserveradress | Example: mc.eona.in ( (!) without http:// (!) )
$servername_display = "";			// Show Servername if set
$use_ip = false;					// turn to true if the serveradress is an IP | true = is ip (skip hostcheck), false = is hostname (check existing host)
$port = 25565;						// Minecraftserver Port | Default: 25565
$timeout = 1;						// Timeout to check if it is online | Max-Value: 10 Min-Value: 1
$allow_check = true;				// Enable/Disable check | true = enabled, false = disabled

$show_who_create_script = false;	// If you want to support me set this to true (will show: PHP-Script created by Petschko)
$is_mod = false; // set this to true, if you use an mod server
