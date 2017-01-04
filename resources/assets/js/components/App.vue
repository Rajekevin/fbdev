<template>
<div class="app">
	<div class="content">
		<header-component></header-component>
		<div id="container">
			<modal-upload-photo v-if="modalUploadPhoto"></modal-upload-photo>
			<contest-preview></contest-preview>
			<catchphrase></catchphrase>
			<filter-component></filter-component>
			<grid></grid>
		</div>
		<footer-component></footer-component>
	</div>
</div>
</template>

<script>
import HeaderComponent from './Header.vue'
import FooterComponent from './Footer.vue'
import ContestPreview from './ContestPreview.vue'
import Catchphrase from './Catchphrase.vue'
import FilterComponent from './Filter.vue'
import Grid from './Grid.vue'
import ModalUploadPhoto from './ModalUploadPhoto.vue'

export default {
	components: {
		HeaderComponent,
		FooterComponent,
		ContestPreview,
		Catchphrase,
		FilterComponent,
		Grid,
		ModalUploadPhoto
	},
	computed: {
		modalUploadPhoto: function () {
			return this.$store.state.modalUploadPhoto
		}
	},
	methods: {
		formatDate: date => {
			const formatedDate = [
				date.getFullYear(),
				(uniqueChar(date.getMonth())) ? date.getMonth() + 1 : date.getMonth() + 1,
				date.getDate()  	
			].join('/') + ' ' + [
				date.getHours(),
				date.getMinutes(),
				date.getSeconds()
			].join(':')
		}
	}
}
</script>