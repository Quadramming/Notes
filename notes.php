<?php
	if ( isset( $_REQUEST['text'] ) ) {
		$name = uniqid(time().'_', true);
		if ( @copy('notes.txt', 'history/'.$name) ) {
			if ( @file_put_contents('notes.txt', $_REQUEST['text']) ) {
				exit('{"result": true}');
			}
		}
	}
	exit('{"result": false}');
?>
