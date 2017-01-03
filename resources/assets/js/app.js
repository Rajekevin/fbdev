require('./bootstrap')
import Init from './init'
import store from './store'

Vue.component('app', require('./components/App.vue'))

window.onload = function () {
	const app = new Vue({
		store,
		el: '#app'
	})
}
