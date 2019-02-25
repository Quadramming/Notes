import SaveButton from './SaveButton.js';
import Text from './Text.js';
import Status from './Status.js';
import c from './c.js';
import Num from './Num.js';
import {antiCache} from './common.js';

export default class {
	
	constructor() {
		this.saveBt = new SaveButton(this);
		this.text = new Text();
		this.status = new Status();
		addEventListener('keydown', this.onKeyDown.bind(this));
		addEventListener('beforeunload', this.onBeforeUnload.bind(this));
		window.doReload = this.doReload.bind(this);
		this.doLoad();
		this.tick();
	}
	
	doSave() {
		this.saveBt.lock('save');
		this.status.set('saving...', 'red');
		$.post('notes.php', { text: Num.to(this.text.get()) }, (data) => {
			if ( data.result === true ) {
				this.doLoad();
			} else {
				alert('Some error occurred');
			}
			this.saveBt.unlock('save');
		}, 'json');
	}
	
	doLoad() {
		this.status.set('loading...', 'orange');
		this.saveBt.lock('load');
		jQuery.get('notes.txt?antiCache='+antiCache(), (text) => {
			this.text.actualize(Num.from(text));
			this.saveBt.lock('nomodify');
			this.status.set('ready', 'green', true);
			this.saveBt.unlock('load');
		});
	}
	
	doReload() {
		if ( ! this.text.isChanged() || window.confirm('Are you sure?') ) {
			this.doLoad();
		}
	}
	
	tick() {
		if ( this.text.isChanged() ) {
			this.saveBt.unlock('nomodify');
			this.status.modified(true);
		} else {
			this.saveBt.lock('nomodify');
			this.status.modified(false);
		}
		this.text.tick();
		window.setTimeout( () => requestAnimationFrame(this.tick.bind(this)), 100 );
	}
	
	onKeyDown(event) {
		if ( event.ctrlKey || event.metaKey ) {
			if ( String.fromCharCode(event.which).toLowerCase() === 's' ) {
				event.preventDefault();
				doSave();
			}
		}
	}
	
	onBeforeUnload(event) {
		if ( this.text.isChanged() ) {
			event.returnValue = 'You should save file!';
		}
	}
	
}
