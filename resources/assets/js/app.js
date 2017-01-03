require('./bootstrap');

Vue.component('app', require('./components/App.vue'));

window.onload = function () {
	const app = new Vue({
		el: '#app'
	});
}