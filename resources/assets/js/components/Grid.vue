<template>
	<div class="images_container">
		{{ state }}
		<div v-if="images.length <= maxNumberOfImageByChunk">
			<item v-for="(item, index) in images" :item="item"></item>
		</div>
		<div v-else>
			<p>CurrentChunk - {{ currentChunk }}</p>
			<item v-for="(item, index) in chunkImages" :item="item"></item>
			<p v-if="images.length > indexOfActualChunk">
				<button @click="loadMore()">Load more</button>
			</p>
		</div>
		
	</div>
</template>

<script>
import Item from "./Item.vue"
export default {
	data: function () {
		return {
			maxNumberOfImageByChunk: 12,
			currentChunk: 1,
			numberOfTotalImage: 9
		}
	},
	computed: {
		images: function () {
			return this.$store.state.images
		},
	    indexOfActualChunk: function () {
	    	return this.currentChunk * this.maxNumberOfImageByChunk
	    },
	    chunkImages: function () {
			return this.images.slice(0, this.indexOfActualChunk)
		},
		state: function () {
			return this.$store.state.filterState
		}
	},
	components: {
		Item
	},
	methods: {
		loadMore: function () {
			this.currentChunk++
		}
	}
}

</script>