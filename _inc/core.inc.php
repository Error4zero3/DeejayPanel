<?php

class core {
	
	function radioStats($url) {
		
		$opts = array(
					
				'http' => array(
		
						'method' => 'GET',
						'header' => 'User-Agent: SHOUTcast Song Status (Mozilla Compatible)\r\n'
		
				)
					
		);
		
		$context = stream_context_create( $opts );
		
		$data    = @file_get_contents( $url, false, $context );
		
		if( preg_match( "/Server is currently up and public./", $data ) ) {
				
			$return['online'] = true;
		
			$return['listeners'] = explode("kbps with <B>", $data);
			$return['listeners'] = explode(" of", $return['listeners'][1]);
			$return['listeners'] = $return['listeners'][0];
		
			$return['ulisteners'] = explode("listeners (", $data);
			$return['ulisteners'] = explode(" unique", $return['ulisteners'][1]);
			$return['ulisteners'] = $return['ulisteners'][0];
		
			$return['listenerpeak'] = explode("Listener Peak: </font></td><td><font class=default><b>", $data);
			$return['listenerpeak'] = explode("</b>", $return['listenerpeak'][1]);
			$return['listenerpeak'] = $return['listenerpeak'][0];
		
			$return['streamtitle'] = explode("Stream Title: </font></td><td><font class=default><b>", $data);
			$return['streamtitle'] = explode("</b>", $return['streamtitle'][1]);
			$return['streamtitle'] = $return['streamtitle'][0];
		
			$return['currentsong'] = explode("Current Song: </font></td><td><font class=default><b>", $data);
			$return['currentsong'] = explode("</b>", $return['currentsong'][1]);
			$return['currentsong'] = $return['currentsong'][0];
				
		}
		else {
				
			$return['online'] = false;
				
		}
		
		return $return;
		} // END radioStats
	

}

?>