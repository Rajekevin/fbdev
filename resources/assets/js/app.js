import Vue from 'vue'

document.addEventListener("DOMContentLoaded", function () {
	Vue.component('app', require('./components/App.vue'));
	const FacebookHelper = new FacebookApiExtension()
	FacebookHelper.init()

	const app = new Vue({
		data: {
			fb_helper: FacebookHelper
		},
		el: '#app'
	})
})
