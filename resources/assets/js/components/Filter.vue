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

<script>
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