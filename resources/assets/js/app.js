require('./bootstrap')
import Init from './init'
import store from './store'

document.addEventListener("DOMContentLoaded", function () {
	Vue.component('choose', require('./components/Choose.vue'))
  Vue.use(require('vue-resource'))
	const FacebookHelper = new FacebookApiExtension()
	FacebookHelper.init()
Vue.component('app', require('./components/App.vue'))

window.onload = function () {
	const app = new Vue({
		store,
		el: '#app'
	})
}
