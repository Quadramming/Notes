export default class {
	
	constructor() {
		this.status = $('#status');
		this.edited = false;
	}
	
	modified(value) {
		if ( value && !this.edited ) {
			this.edited = true;
			this.status.append(' (+)');
		}
		if ( !value && this.edited ) {
			this.edited = false;
			this.status.html(
				this.status.html().replace(/ \(\+\)$/g, '')
			);
		}
	}
	
	get() {
		return this.status.html();
	}
	
	set(text, color='red') {
		this.status.html(text);
		this.status.prop('color', color);
	}
	
}
