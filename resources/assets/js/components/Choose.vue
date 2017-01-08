<template>
    <div class="participate_content">
        <div class="participate_block_left">
            <p>Télécharger une photo depuis mon ordinateur</p>
            <input type="file" name="image_upload" />
            <p class="bold">ou</p>
            <p>depuis mes albums Facebook</p>
            <ul>
                <li @click="showAll">Montrer toutes les photos</button>
                <li v-for="album in json" @click="filterByAlbum(album.id)">{{ album.name }}</li>
            </ul>
        </div>
        <div class="participate_block_right">
            <span v-if="displayData.photos !== undefined" v-for="photo in displayData.photos">
               <item :photo="photo"></item>
            </span>
            <span v-if="displayData.photos === undefined" v-for="albums in json">
                <item v-for="photo in albums.photos" :photo="photo"></item>
            </span>
        </div>
    </div>
</template>

<script>
import Item from './ChooseItem.vue'

export default {
	mounted: function () {
		this.$parent.fb_helper.init()
        this.fetchData()
	},
    components: {
        Item
    },
    data: function () {
        return {
            json: {},
            displayData: {}
        }
    },
    methods: {
        fetchData () {
            this.$http.get('/xhr/albums/all').then((data) => {
                this.json = JSON.parse(data.body)
                this.displayData = this.json
            }, (response) => {
                console.log(response)
            })
        },
        showAll () {
            this.displayData = this.json
        },
        filterByAlbum (id) {
            this.displayData = this.json.find(album => {
                return album.id === id
            })
        }
    }
}
</script>

