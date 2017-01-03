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
      	<p>1 vote</p>
    </div>
</div>
</template>

<script>
export default {
	props: ['item'],
	data: function () {
		return {
			path: `img/${this.item.index}.jpg`
		}
	},
	methods: {
		like: () => {

		}
	}
}
</script>
