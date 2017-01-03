import Vuex from 'vuex'

const state = {
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
	],
	filterState: 'random'
}

const mutations = {
	setFilterState: (state, newState) => {
  		state.filterState = newState
  	}
}

const getters = {
  
}

const actions = {
  
}

let store = new Vuex.Store({
  state,
  mutations,
  getters,
  actions
})

global.store = store

export default store
