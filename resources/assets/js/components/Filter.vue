<template>
	<div class="filter no-select">
		<div @click="filterRandom()">Random</div>
		<div v-if="state == 'lessLiked'" @click="filterMoreLike()">Plus aimé</div>
		<div v-else @click="filterLessLike()">Moins aimé</div>
		<div v-if="state == 'lessRecent'" @click="filterMoreRecent()">Plus récent</div>
		<div v-else @click="filterLessRecent()">Moins récent</div>
		<div v-if="state == 'titleAscendant'" @click="filterDescTitle()">A - Z</div>
		<div v-else @click="filterAscTitle()">Z - A</div>
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
			},
			filterAscTitle: function () {
				this.$store.commit('setFilterState', 'titleAscendant')
			},
			filterDescTitle: function () {
				this.$store.commit('setFilterState', 'titleDescendant')
			}
		},
		computed: {
			state: function () {
				return this.$store.state.filterState
			}
		}
	}
</script>