export default class {
	
	static to(str) {
		let nums = '';
		for ( let i = 0; i < str.length; ++i ) {
			nums += str.charCodeAt(i) + '!';
		}
		return nums;
	}
	
	static from(nums) {
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
	
}
