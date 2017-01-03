<template>
	<div class="images_container">
		<div v-if="images.length <= maxNumberOfImageByChunk">
			<item v-for="(item, index) in images" :index="item.index"></item>
		</div>
		<div v-else>
			<p>CurrentChunk - {{ currentChunk }}</p>
			<item v-for="(item, index) in chunkImages" :index="item.index"></item>
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
			repeat: '3',
			maxNumberOfImageByChunk: 12,
			currentChunk: 1,
			numberOfTotalImage: 9,
			images: [
				{ index: 1 },
				{ index: 2 },
				{ index: 3 },
				{ index: 1 },
				{ index: 2 },
				{ index: 3 },
				{ index: 1 },
				{ index: 2 },
				{ index: 3 },
				{ index: 1 },
				{ index: 2 },
				{ index: 3 },
				{ index: 1 },
				{ index: 2 },
				{ index: 3 },
				{ index: 1 },
				{ index: 2 },
				{ index: 3 }
			]
		}
	},
	computed: {
	    indexOfActualChunk: function () {
	    	return this.currentChunk * this.maxNumberOfImageByChunk
	    },
	    chunkImages: function () {
			return this.images.slice(0, this.indexOfActualChunk)
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