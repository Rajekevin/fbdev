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
			repeat: '3',
			maxNumberOfImageByChunk: 12,
			currentChunk: 1,
			numberOfTotalImage: 9,
			images: [
				{ 
					index: 1,
					likes: 10,
					created_at: '2017-01-03 16:05:43'
				},
				{ 
					index: 2,
					likes: 0,
					created_at: '2016-01-03 16:05:43'
				},
				{ 
					index: 3,
					likes: 22,
					created_at: '2017-02-03 16:05:43'
				},
				{ 
					index: 1,
					likes: 342,
					created_at: '2017-01-04 16:05:43'
				}
			]
		}
	},
	computed: {
	    indexOfActualChunk: function () {
	    	return this.currentChunk * this.maxNumberOfImageByChunk
	    },
	    chunkImages: function () {
			return this.images.slice(0, this.indexOfActualChunk)
		},
		state: function () {
			return store.state
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