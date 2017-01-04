import Vuex from 'vuex'

const FILTER_STATES = ['moreRecent', 'lessRecent', 'moreLiked', 'lessLiked', 'lessRecent', 'random']

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

const filterLikes = (array, comparaison) => {
	switch(comparaison) {
		case 'more':
			return array.sort((a, b) => {
				return a.likes + b.likes
			})
			break
		case 'less': 
			return array.sort((a, b) => {
				return a.likes - b.likes
			})
			break
	}
}

const mutations = {
	setFilterState: (state, newState) => {
  		state.filterState = newState
  		switch (newState) {
  			case 'moreLiked':
  				state.images = filterLikes(state.images, 'more')
  				break
  			case 'lessLiked':
  				state.images = filterLikes(state.images, 'less')
  				break
  		}
    },
    setModalUploadPhoto: (state, boolean) => {
        state.modalUploadPhoto = boolean
    }
}

const getters = {
	images: state => {
		return state.images
	}
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
