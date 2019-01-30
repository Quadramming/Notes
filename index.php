<!DOCTYPE html>
<html>
	<head>
		<title>Notes</title>
		<meta charset='utf-8'>
		<link rel='icon' type='image/gif' sizes='16x16' href='data:image/gif;base64,R0lGODlhEAAQAIABAAAAAP///yH5BAEKAAEALAAAAAAQABAAAAIjhI8WG+m6EJsNxEMVllM/yjziSHJgh50opF5sa8JpW5X2WAAAOw=='>
		<style type='text/css'>
			textarea { width: 90%; font-family: Courier; font-weight: bold; font-size: 15px }
			body { text-align: center }
		</style>
		<script type='text/javascript' src='jquery-3.3.1.min.js'></script>
		<script type='text/javascript'>
			
			console.log('Version: 1.1');
			let actualText = '';
			
			function isChanged() {
				return id('text').value !== actualText;
			}
			
			function toNum(str) {
				let nums = '';
				for ( let i = 0; i < str.length; ++i ) {
					nums += str.charCodeAt(i) + '!';
				}
				return nums;
			}
			
			function fromNum(nums) {
				let str = '';
				let current = '';
				for ( let i = 0; i < nums.length; ++i ) {
					if ( nums[i] !== '!' ) {
						current += nums[i];
					} else {
						str += String.fromCharCode(current);
						current = '';
					}
				}
				return str;
			}
			
			function id(name) {
				return document.getElementById(name);
			}
			
			function addLine() {
				id('text').value = '\n' + id('text').value;
				id('text').focus();
				id('text').selectionStart = 0;
				id('text').selectionEnd = 0;
				$('#text').scrollTop(0);
			}
			
			function setText(text) {
				id('text').value = text;
				actualText = text;
			}
			
			function doSort(isDesc = false) {
				const text = id('text').value;
				const lines = text.split('\n');
				lines.sort();
				if ( isDesc ) {
					lines.reverse();
				}
				id('text').value = lines.join('\n');
			}
			
			function doSave() {
				if ( ! isChanged() ) {
					return;
				}
				const textToSave = toNum( id('text').value );
				$.post( 'notes.php', { text: textToSave }, function( data ) {
					if ( data.result === true ) {
						doLoad();
					} else {
						alert('Some error occurred');
					}
				}, 'json');
			}
			
			function doLoad() {
				const antiCache = new Date().valueOf()+''+Math.random();
				jQuery.get('notes.txt?antiCache='+antiCache, function(text) {
					setText(fromNum(text));
				});
			}
			
			function doReload() {
				if ( ! isChanged() || window.confirm('Are you sure?') ) {
					doLoad();
				}
			}
			
			function onKeyDown(event) {
				if ( event.ctrlKey || event.metaKey ) {
					if ( String.fromCharCode(event.which).toLowerCase() == 's' ) {
						event.preventDefault();
						doSave();
					}
				}
			}
			
			function tick() {
				window.setTimeout( () => requestAnimationFrame(tick), 100 );
				if ( isChanged() ) {
					$('#saveIco').attr('src', 'imgs/save.png');
				} else {
					$('#saveIco').attr('src', 'imgs/noSave.png');
				}
				const textArea = $('#text');
				const textAreaSize = $(window).height() - $('#text').position().top - 25;
				if ( textArea.height() !== textAreaSize ) {
					textArea.height(textAreaSize);
				}
			}
			
			window.addEventListener('beforeunload', function (event) {
				if ( isChanged() ) {
					event.returnValue = 'You should save file!';
				}
			});
			
			window.addEventListener('load', function(event) {
				addEventListener('keydown', onKeyDown);
				tick();
				doLoad();
			});
			
		</script>
	</head>
	<body>
		<a href='#' onclick='addLine()'><img src='imgs/plus.png'></a>
		<a href='#' onclick='doSave()'><img src='imgs/noSave.png' id='saveIco'></a>
		<a href='#' onclick='doReload()'><img src='imgs/reload.png'></a>
		<a href='#' onclick='doSort()'><img src='imgs/sortAZ.png'></a>
		<a href='#' onclick='doSort(true)'><img src='imgs/sortZA.png'></a>
		<br>
		<textarea id='text'></textarea>
	</body>
</html>
