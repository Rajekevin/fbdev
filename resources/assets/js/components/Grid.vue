<template>
	<div class="images_container">
		<item index="1"></item>
	</div>
</template>

<script>
import Item from "./Item.vue"
export default {
	data: function () {
		return {
			repeat: '3'
		}
	},
	components: {
		Item
	}
}
</script>