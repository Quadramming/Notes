import c from './c.js';
import {id} from './common.js';

export default class {
	
	constructor() {
		this.actual = '';
		this.textarea = $('#text');
		window.addLine = this.addLine.bind(this);
		window.doSort = this.doSort.bind(this);
		window.doUnique = this.doUnique.bind(this);
		window.doCase = this.doCase.bind(this);
	}
	
	tick() {
		const wantedSize = $(window).height() - this.textarea.position().top - 25;
		if ( this.textarea.height() !== wantedSize ) {
			this.textarea.height(wantedSize);
		}
	}
	
	get() {
		return this._taValue();
	}

	actualize(text) {
		this._taValue(text);
		this.actual = text;
	}
	
	isChanged() {
		return this._taValue() !== this.actual;
	}
	
	addLine() {
		this._taValue( '\n' + this._taValue() );
		this._taFocus();
		this._taScrollTop();
	}
	
	doSort(isDesc = false) {
		const lines = this._taValue().split('\n').sort();
		if ( isDesc ) {
			lines.reverse();
		}
		this._taValue( lines.join('\n') );
	}
	
	doUnique() {
		let lines = this._taValue().split('\n');
		lines = [...new Set(lines)];
		this._taValue(lines.join('\n'));
	}
	
	doCase(big = true) {
		if ( big ) {
			this._taValue( this._taValue().toUpperCase() );
		} else {
			this._taValue( this._taValue().toLowerCase() );
		}
	}
	
	_taValue(str) {
		if ( str ) {
			this.textarea.val(str);
		}
		return this.textarea.val();
	}
	
	_taFocus() {
		this.textarea.focus();
	}
	
	_taScrollTop() {
		this.textarea.prop('selectionStart', 0);
		this.textarea.prop('selectionEnd', 0);
		this.textarea.scrollTop(0);
	}
	
}
