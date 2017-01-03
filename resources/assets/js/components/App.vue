<template>
<div class="app">
	<div class="content">
		<header-component></header-component>
		<div id="container">
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

export default {
	components: {
		HeaderComponent,
		FooterComponent,
		ContestPreview,
		Catchphrase,
		FilterComponent,
		Grid
	}
}
</script>