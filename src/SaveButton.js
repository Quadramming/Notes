import c from './c.js';

export default class {
	
	constructor(app) {
		this.app = app;
		this.locks = new Set();
		window.doSave = this.doSave.bind(this);
	}
	
	doSave() {
		if ( this.isEnabled() ) {
			this.app.doSave();
		}
	}

	lock(name) {
		this.locks.add(name);
		this.update();
	}
	
	unlock(name) {
		this.locks.delete(name);
		this.update();
	}
	
	update() {
		if ( this.isEnabled() ) {
			$('#saveIco').show();
			$('#noSaveIco').hide();
		} else {
			$('#saveIco').hide();
			$('#noSaveIco').show();
		}
	}
	
	isEnabled() {
		return this.locks.size === 0;
	}
	
}
