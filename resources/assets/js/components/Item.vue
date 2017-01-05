<template>
<div class="image_container">
    <a @click="open()" style="color:#fff;">
    	<img :src="path" alt=""/>
    </a>
    <div>
    	<p>{{ item.created_at }}</p>
    	<p>{{ item.likes }}</p>
    	<p>{{ item.title }}</p>
    </div>
    <div>
    	
      	<img src="img/heart.png" alt="heart"> 
      	<img src="img/share.png" alt="share">
      	<!-- // TODO: i18n  -->
      	<p>{{ item.likes }} votes</p>
    </div>
</div>
</template>

<script>
    export default {
        props: ['item'],
        methods: {
            open: function() {
                this.$store.commit('setLightbox', {
                    boolean: true,
                    id: this.item.id
                })
            }
        },
        computed: {
            path: function() {
                return `img/${this.item.index}.jpg`
            }
        }
    }
</script>