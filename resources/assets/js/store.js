import Vuex from 'vuex'

const FILTER_STATES = ['moreRecent', 'lessRecent', 'moreLiked', 'lessLiked', 'lessRecent', 'random']

const state = {
    images: [
        {
            index: 1,
            likes: 10,
            title: 'AAAAMon titre',
            description: 'description',
            created_at: '2019-01-03 16:05:43'
        },
        {
            index: 2,
            likes: 0,
            title: 'ZZZZMon titre',
            description: 'description',
            created_at: '2016-01-03 16:05:43'
        },
        {
            index: 3,
            likes: 22,
            title: 'CCCCMon titre',
            description: 'description',
            created_at: '2017-02-03 16:05:43'
        },
        {
            index: 1,
            likes: 342,
            title: 'TTTTMon titre',
            description: 'description',
            created_at: '2017-01-04 16:05:43'
        },
        {
            index: 1,
            likes: 10,
            title: 'aMon titre',
            description: 'description',
            created_at: '2010-01-03 16:05:43'
        },
        {
            index: 2,
            likes: 0,
            title: 'zMon titre',
            description: 'description',
            created_at: '2016-01-03 16:05:43'
        },
        {
            index: 3,
            likes: 22,
            title: 'Mon titre',
            description: 'description',
            created_at: '2017-02-03 16:05:43'
        },
        {
            index: 1,
            likes: 342,
            title: 'Mon titre',
            description: 'description',
            created_at: '2017-01-04 16:05:43'
        },
        {
            index: 1,
            likes: 10,
            title: 'Mon titre',
            description: 'description',
            created_at: '2017-01-03 16:05:43'
        },
        {
            index: 2,
            likes: 0,
            title: 'Mon titre',
            description: 'description',
            created_at: '2016-01-03 16:05:43'
        },
        {
            index: 3,
            likes: 22,
            title: 'Mon titre',
            description: 'description',
            created_at: '2017-02-03 16:05:43'
        },
        {
            index: 1,
            likes: 342,
            title: 'Mon titre',
            description: 'description',
            created_at: '2017-01-04 16:05:43'
        },
        {
            index: 1,
            likes: 10,
            title: 'Mon titre',
            description: 'description',
            created_at: '2017-01-03 16:05:43'
        },
        {
            index: 2,
            likes: 0,
            title: 'Mon titre',
            description: 'description',
            created_at: '2016-01-03 16:05:43'
        },
        {
            index: 3,
            likes: 22,
            title: 'Mon titre',
            description: 'description',
            created_at: '2017-02-03 16:05:43'
        },
        {
            index: 1,
            likes: 342,
            title: 'Mon titre',
            description: 'description',
            created_at: '2017-01-04 16:05:43'
        }
    ],
    modalUploadPhoto: false,
    filterState: 'random'
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