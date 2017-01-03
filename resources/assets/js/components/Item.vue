<template>
<div class="image_container">
    <a style="color:#fff;">
    	<img :src="path" alt=""/>
    </a>
    <div>
    	<p>{{ item.created_at }}</p>
    	<p>{{ item.likes }}</p>
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
		like: () => {

		}
	},
	computed: {
		path: function () {
			return  `img/${this.item.index}.jpg`
		}
	}
}
</script>
