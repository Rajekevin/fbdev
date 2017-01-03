<template>
<div class="image_container">
    <a style="color:#fff;" target="_blank">
    	<img :src="path" alt=""/>
    </a>
    <div>
      <img src="img/heart.png" alt="heart">
      <img src="img/share.png" alt="share">
      <p>1 vote</p>
    </div>
</div>
</template>

<script>
export default {
	props: ['index'],
	data: function () {
		return {
			path: `img/${this.index}.jpg`
		}
	}
}
</script>
