import Vuex from 'vuex'

const FILTER_STATES = ['moreRecent', 'lessRecent', 'moreLiked', 'lessLiked', 'lessRecent', 'random']

const state = {
    images: [{
            id: '1',
            index: 1,
            likes: 10,
            title: 'Premier Item',
            description: 'description',
            created_at: '2019-01-03 16:05:43'
        },
        {
            id: '2',
            index: 2,
            likes: 10,
            title: 'Second item',
            description: 'description',
            created_at: '2019-01-03 16:05:43'
        },
        {
            id: '3',
            index: 3,
            likes: 10,
            title: 'Troisième item',
            description: 'description',
            created_at: '2019-01-03 16:05:43'
        }
    ],
    modalUploadPhoto: false,
    filterState: 'random',
    lightbox: true,
    lightboxId: '1'
}

const filterLikes = (array, comparaison) => {
    switch (comparaison) {
        case 'more':
            return array.sort((a, b) => {
                return b.likes - a.likes
            })
            break
        case 'less':
            return array.sort((a, b) => {
                return a.likes - b.likes
            })
            break
    }
}

const filterRandom = array => {
    return array.sort(() => {
        return 0.5 - Math.random()
    })
}

const filterDate = (array, comparaison) => {
    switch (comparaison) {
        case 'more':
            return array.sort((a, b) => {
                return new Date(b.created_at).getTime() - new Date(a.created_at).getTime()
            })
            break
        case 'less':
            return array.sort((a, b) => {
                return new Date(a.created_at).getTime() - new Date(b.created_at).getTime()
            })
            break
    }
}

const filterTitle = (array, comparaison) => {
    switch (comparaison) {
        case 'asc':
            return array.sort((a, b) => {
                return b.title.localeCompare(a.title)
            })
            break
        case 'desc':
            return array.sort((a, b) => {
                return a.title.localeCompare(b.title)
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
            case 'random':
                state.images = filterRandom(state.images)
                break
            case 'moreRecent':
                state.images = filterDate(state.images, 'more')
                break
            case 'lessRecent':
                state.images = filterDate(state.images, 'less')
                break
            case 'titleAscendant':
                state.images = filterTitle(state.images, 'asc')
                break
            case 'titleDescendant':
                state.images = filterTitle(state.images, 'desc')
                break
        }
    },
    setModalUploadPhoto: (state, boolean) => {
        state.modalUploadPhoto = boolean
    },
    setLightbox: (state, { boolean, id }) => {
        state.lightbox = boolean
        state.lightboxId = id
    },
    nextLightboxItem: (state, index) => {
        if (typeof state.images[index + 1] === 'undefined') {
            state.lightboxId = state.images[0].id
        } else {
            state.lightboxId = state.images[index + 1].id
        }
    },
    prevLightboxItem: (state, index) => {
        if (typeof state.images[index - 1] === 'undefined') {
            state.lightboxId = state.images[state.images.length - 1].id
        } else {
            state.lightboxId = state.images[index - 1].id
        }
    }
}

const getters = {
    images: state => {
        return state.images
    },
    image: (state) => {
        return state.images.reduce((memo, el, index) => {
            if (el.id === state.lightboxId) {
                memo.index = index
                memo.element = el
            }
            return memo
        }, { 
            index: '-1',
            element: {}
        })
    }
}

const actions = {

}

// state.images = filterRandom(state.images)

let store = new Vuex.Store({
    state,
    mutations,
    getters,
    actions
})

global.store = store

export default store