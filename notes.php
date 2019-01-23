<?php
	if ( isset( $_REQUEST['text'] ) ) {
		$name = uniqid(time().'_', true);
		copy('notes.txt', 'history/'.$name);
		file_put_contents('notes.txt', $_REQUEST['text']);
		echo '{"result": true}';
	} else {
		echo '{"result": false}';
	}
?>
