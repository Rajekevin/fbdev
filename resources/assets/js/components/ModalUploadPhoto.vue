<template>
	<div class="modal modal_upload_photo">
		<h1>Test</h1>
		<button @click="closeModal()">Close Modal</button>
	</div>
</template>

<script>
export default {
	methods: {
		closeModal: function () {
			this.$store.commit('setModalUploadPhoto', false)
		}
	}
}
</script>