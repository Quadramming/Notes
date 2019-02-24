export function id(name) {
	return document.getElementById(name);
}

export function antiCache() {
	return Math.random()+':'+(new Date().valueOf());
}
