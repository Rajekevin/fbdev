<template>
	<div class="lightbox">
		<div class="lb_image" :style="path"></div>
		<div class="lb_image_information">
			<img @click="close" class="lb_close" src="img/close.png">
			<h3>{{ item.title }}</h3>
			{{ index }}
			<p class="bold">{{ item.description }}</p>
			<div class="lb_optional_information">
				<p>Nom du photographe : Champs optionnel</p>
				<p>Ville où la photo a été prise : Optionnel</p>
			</div>
			<p class="bold">Bloc de commentaire</p>
			<div class="lb_bottom">
				<img src="img/heart.png" alt="heart" class="btn-like">
				<img src="img/share.png" alt="share" class="btn-share">
				<p>Ajouter un commentaire</p>
			</div>
		</div>
		<div class="lb-nav">
			<a class="lb-prev" @click="prev()"></a>
			<a class="lb-next" @click="next()"></a>
		</div>
	</div>
</template>

<script>
    export default {
        computed: {
            path: function() {
                return `background-image: url(img/${this.item.index}.jpg)`
            },
            item: function() {
                const result = this.$store.getters.image
                return result.element
            },
            index: function() {
                const result = this.$store.getters.image
                return result.index
            }
        },
        methods: {
            next: function() {
                this.$store.commit('nextLightboxItem', this.index)
            },
            prev: function() {
                this.$store.commit('prevLightboxItem', this.index)
            },
            close: function() {
                this.$store.commit('setLightbox', false)
            }
        }
    }
</script>