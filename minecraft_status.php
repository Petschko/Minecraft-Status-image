<?php

error_reporting( 0 );

/* Created by Petschko
*
* Autors E-Mail: peter-91@hotmail.de
* Autors Website: http://www.eona.in/
*/

require( "config.php" );

header( "Pragma: no-cache" );
header( "Cache-Control: no-store, no-cache, max-age=0, must-revalidate" );
header( "Content-Type: image/png" );
mb_internal_encoding("UTF-8");

if($use_get) {
	// todo not implement yet
}

/*@param:
* image = the image.
* image_width = the width of the image.
* string = the text you want to add.
* font_size = font size, between 1 and 5.
* y = vertical position of the text.
* color = the color of the text
* 
* @return void
*/

function CenterImageString( $image, $image_width, $string, $font_size, $y, $color ) {
	$text_width = imagefontwidth( $font_size ) * mb_strlen( $string );
	$center = ceil( $image_width / 2 );
	$x = $center - ( ceil( $text_width / 2 ) );
	ImageString( $image, $font_size, $x, $y, $string, $color );
}


/*@param:
* image = the image.
* font_wd = font size, between 1 and 5.
* color = the color of the text 
* message = the output error_message
* 
* @return void
*/

function error_output( $image, $font_wd, $color, $message ) {
	ImageString( $image, $font_wd, 2, 12, $message, $color );
	imagepng( $image );
}

function get_info($data) {
	$motd = substr($data, 0, strpos($data, chr(167)));
	$text_after_msg = substr($data, strpos($data, chr(167)));
	$max_player = str_replace(chr(167), "", substr($data, strrpos($data, chr(167))));
	$online_player = str_replace(chr(167), "", substr($text_after_msg, strpos($text_after_msg, chr(167)), strrpos($text_after_msg, chr(167))));

	return array($motd, get_number($online_player), get_number($max_player));
}

function get_number($str) {
	$array = str_split($str, 1);
	$number = "";
	foreach($array as $char) {
		switch($char) {
			case "0":
				$number .= "0";
				break;
			case "1":
				$number .= "1";
				break;
			case "2":
				$number .= "2";
				break;
			case "3":
				$number .= "3";
				break;
			case "4":
				$number .= "4";
				break;
			case "5":
				$number .= "5";
				break;
			case "6":
				$number .= "6";
				break;
			case "7":
				$number .= "7";
				break;
			case "8":
				$number .= "8";
				break;
			case "9":
				$number .= "9";
				break;
		}
	}

	return (int) $number;
}


// Init image (width, height)
$breite = 230;
$height = 85;
if( ! $show_who_create_script )
	$height = 70;

$bild = imagecreatetruecolor( $breite, $height );

// Transparenten hintergrund erstellen (deaktiviert)
/*imagesavealpha( $bild, true );
$trans_color = imagecolorallocatealpha( $bild, 255, 255, 255, 127 );
imagefill( $bild, 0, 0, $trans_color );*/

// Farben einstellen
$rot = imagecolorallocate( $bild, 255, 0, 0 );
$gruen = imagecolorallocate( $bild, 0, 255, 0 );
$weis = imagecolorallocate( $bild, 255, 255, 255 );
$schwarz = imagecolorallocate( $bild, 0, 0, 0 );
$hell_grau = imagecolorallocate( $bild, 100, 100, 100 );
$grau = imagecolorallocate( $bild, 50, 50, 50 );
$hell_blau = imagecolorallocate( $bild, 90, 90, 255 );

//Hintergrund erstellen
imagefill( $bild, 0, 0, $schwarz );

// --------------- Texte erstellen
$textgroesse = 2;
$x = 20;
$text_1 = "Adress:";
$text_2 = "State:";
$ping_text = "";
$text_uhrzeit = "Checked at:";
$text_spieleronline = "Player:";
$uhrzeit = date( "G:i", time( "now" ) ) . " " . date( "d.m.Y", time( "now" ) );

// Länge vom Text nach den 1 Texten ermitteln
if( mb_strlen( $text_1 ) > mb_strlen( $text_2 ) )
	$text_laenge = imagefontwidth( $textgroesse ) * mb_strlen( $text_1 );
else
	$text_laenge = imagefontwidth( $textgroesse ) * mb_strlen( $text_2 );
	
$x2 = $x + $text_laenge + 2;

$x_zeit = $x + ( imagefontwidth( $textgroesse ) * ( mb_strlen( $text_uhrzeit ) + 1 ) );
$x_ping = 0;

$color_ping = $weis;

// Serveradresse zusammenbasteln
$text_serverconnectioninfo = $serveradress;
$color_con_info = $hell_blau;

// Wenn der Port nicht der Standartport ist, Port mit hinzufügen
if( $port != 25565 )
	$text_serverconnectioninfo .= ":" . $port;

// Ist der Text zu lang?
if( ( ( imagefontwidth( $textgroesse ) * mb_strlen( $text_serverconnectioninfo ) ) + $x2 ) > $breite ) {
	$text_serverconnectioninfo = "ERROR: Text to long!";
	$color_con_info = $rot;
}

// Serverinfo Array erstellen und Farben zuweisen
$serverinfo = array( 'motd' => "", 'spieler' => "?", 'max_spieler' => "??" );
$color_player_online = $hell_grau;
$color_breakline = $hell_grau;
$color_max_player = $hell_grau;

// Serverstatus prüfen
// Ist die Funktion fsockopen erlaubt/vorhanden?
// Check erlaubt?

if( ! $allow_check ) {
	$status_text = "Check disabled";
	$color_status = imagecolorallocate( $bild, 255, 144, 0 );
	goto end_status_check;
}

if( @function_exists('fsockopen') ) {
	// Prüfen ob alle erforderlichen Angaben gemacht wurden
	if( isset( $port ) && ( ! empty( $serveradress ) ) && ( mb_strripos( $serveradress, '.' ) || mb_strripos( $serveradress, ':' ) ) && isset( $timeout ) ) {
		// MIN/MAX Timeout checken und ggf. korregieren!
		if( $timeout > 10 )
			$timeout = 10;
		if( $timeout < 1 )
			$timeout = 1;
		
		// Prüfen ob der Server antwortet
		if( $use_ip == false ) {
			$ip = @gethostbyname( $serveradress );
			
			if( $ip == $serveradress ) { // detect if host exists
				error_output( $bild, $textgroesse, $rot, "Host didn't exist! ({$serveradress})" );
				exit;
			}
		} else
			$ip = $serveradress;
		
		// Get serverinfo
		$startzeit = microtime( );
		$data = @fsockopen( $serveradress, $port, $errno, $errstr, $timeout );
		$endzeit = microtime( );
		
		if( $data ) {
			// Daten aus dem Server auslesen
			try {
				fwrite( $data, "\xFE" );
				$temp = fread( $data, 256 );
				$temp = substr( $temp, 3 ); // do not use mb function here!
				if($is_mod) {
					$temp = get_info($temp);
					$serverinfo = array('motd' => $temp[0], 'spieler' => (int) $temp[1], 'max_spieler' => (int) $temp[2]);
				} else {
					$temp = explode("\xA7", $temp);
					$serverinfo = array( 'motd' => $temp[0], 'spieler' => ( int )$temp[1], 'max_spieler' => ( int )$temp[2] );
				}

				// Verbindung schließen
				@fclose( $data );
			}
			catch( Exception $e ) {
				error_output( $bild, $textgroesse, $rot, 'Exception: ' . $e->getMessage( ) );
				exit;
			}
			
			// Farben setzen für die Spieleranzeige
			if( $serverinfo['max_spieler'] != "??" ) {
				$color_max_player = $weis;
				$color_breakline = $weis;
				$color_player_online = $weis;
				
				if( $serverinfo['spieler'] == 0 )
					$color_player_online = $rot;
				else if( $serverinfo['spieler'] == $serverinfo['max_spieler'] ) {
					$color_player_online = $rot;
					$color_breakline = imagecolorallocate( $bild, 255, 255, 0 );
					$color_max_player = imagecolorallocate( $bild, 255, 255, 0 );
				} else if( $serverinfo['spieler'] > ( $serverinfo['max_spieler'] - ( $serverinfo['max_spieler'] / 5 ) ) ) {
					$color_breakline = imagecolorallocate( $bild, 255, 255, 0 );
					$color_max_player = imagecolorallocate( $bild, 255, 255, 0 );
				}
			}
			
			$status_text = "ONLINE";
			$color_status = $gruen;
			
			// Ping errechnen und ausgeben
			$ping = $endzeit - $startzeit;
			$ping = $ping * 1000;
			$ping_int = round( $ping, 0 );
			$ping_text = str_replace( '.', ',', round( $ping, 1 ) ) . "ms";
			
			$x_ping = ( $breite - 1 ) - ( imagefontwidth( $textgroesse ) * mb_strlen( $ping_text ) );
			
			// Mod
			$ping_int = $ping * 2;
			// Mod
			
			$rot_farbe = 0;
			$gruen_farbe = 255;
			
			// Farbe errechnen je schlechter der Ping desto roter
			if( $ping_int <= 255 )
				$rot_farbe = $ping_int;
			else if( $ping_int <= 510 ) {
				$rot_farbe = 255;
				$ping_int = $ping_int - 255;
				
				if( $ping_int <= 255 )
					$gruen_farbe = $gruen_farbe - $ping_int;
				else
					$gruen_farbe = 0;
			} else {
				$rot_farbe = 255;
				$gruen_farbe = 0;
			}
			
			$color_ping = imagecolorallocate( $bild, $rot_farbe, $gruen_farbe, 0 );
		} else {
			$status_text = "OFFLINE";
			$color_status = $rot;
			
			// Da der Server Offline ist, sind alle Spieler off
			$serverinfo['spieler'] = 0;
			$color_player_online = $rot;
		}
	} else {
		$status_text = "Check your config!";
		$color_status = $grau;
	}
} else {
	/* Kann den Server nicht Pingen ohne die Funktion...
	*  Wenn da Unbekannt steht, hat dein Serverhoster die fsockopen() Funktion höchstwahrscheinlich deaktiviert oder benutzt eine veraltete PHP-Version. Kontaktiere hierzu am besten deinen Webhoster
	*  Wenn du der Besitzer des Webservers bist musst du die Funktion in der php.ini aktivieren/erlauben oder deine PHP-Version Updaten! Hilfe findest du hier: http://de2.php.net/manual/de/ini.php
	*/
	$status_text = "Unknow (See help)";
	$color_status = $grau;
}

end_status_check:
// Zuweisen der Serverinfo
$text_spieler_now_online = $serverinfo['spieler'];
$x3 = $x_zeit + ( imagefontwidth( $textgroesse ) * mb_strlen( $text_spieler_now_online ) );
$x4 = $x3 + ( imagefontwidth( $textgroesse ) * mb_strlen( "/" ) );
$text_maxspieler = $serverinfo['max_spieler'];

// Texte zusammenfassen

CenterImageString( $bild, $breite, "Minecraft-Serverstate:", $textgroesse, 0, $weis );
ImageString( $bild, $textgroesse, $x, 20, $text_1, $weis );
ImageString( $bild, $textgroesse, $x2, 20, $text_serverconnectioninfo, $color_con_info );
ImageString( $bild, $textgroesse, $x, 32, $text_2, $weis );
ImageString( $bild, $textgroesse, $x2, 32, $status_text, $color_status );
ImageString( $bild, $textgroesse, $x_ping, 32, $ping_text, $color_ping );
ImageString( $bild, $textgroesse, $x, 44, $text_spieleronline, $weis );
ImageString( $bild, $textgroesse, $x_zeit, 44, $text_spieler_now_online, $color_player_online );
ImageString( $bild, $textgroesse, $x3, 44, "/", $color_breakline );
ImageString( $bild, $textgroesse, $x4, 44, $text_maxspieler, $color_max_player );
ImageString( $bild, $textgroesse, $x, 56, $text_uhrzeit, $weis );
ImageString( $bild, $textgroesse, $x_zeit, 56, $uhrzeit, $color_con_info );

if( $show_who_create_script )
	CenterImageString( $bild, $breite, "PHP-Script created by Petschko", $textgroesse, 68, $grau );

// --------------- Ende der Textarea

// Bild ausgeben:
imagepng( $bild );
