<template>
	<div class="filter">
		{{ state }}
	  	<div @click="filterMoreLike()">Plus aimé</div>
	  	<div @click="filterLessLike()">Moins aimé</div>
	  	<div @click="filterRandom()">Random</div>
	  	<div @click="filterMoreRecent()">Plus récent</div>
	  	<div @click="filterLessRecent()">Moin récent</div>
	  	<div>A - Z</div>
	</div>
</template>

<!-- v-if="!state === 'moreLiked'" 
v-if="state === 'moreLiked'" @
v-if="!state === 'random'" @cl
v-if="!state === 'moreRecent'"
v-if="state === 'moreRecent'"  -->

<script>

const STATES = ['moreRecent', 'lessRecent', 'moreLiked', 'lessLiked', 'lessRecent', 'random']
export default {
	methods: {
		filterMoreLike: function () {
			this.$store.commit('setFilterState', 'moreLiked')
		},
		filterLessLike: function () {
			this.$store.commit('setFilterState', 'lessLiked')
		},
		filterRandom: function () {
			this.$store.commit('setFilterState', 'random')
		},
		filterMoreRecent: function () {
			this.$store.commit('setFilterState', 'moreRecent')
		},
		filterLessRecent: function () {
			this.$store.commit('setFilterState', 'lessRecent')
		}
	},
	computed: {
		state: function () {
			return this.$store.state.filterState
		}
	}
}
</script>