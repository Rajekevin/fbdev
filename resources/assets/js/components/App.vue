<template>
<div class="image_container" data-id="image-2">
    <a data-lightbox="image-2" href="img/2.jpg" style="color:#fff;" target="_blank">
        <img src="img/2.jpg" alt=""/>
    </a>
    <div>
        <img src="img/heart.png" alt="heart" class="btn-like">
        <img src="img/share.png" alt="share" class="btn-share">
        <p>1 vote</p>
    </div>
</div>
</template>

<script>
export default {
	mounted: function () {
		this.$parent.fb_helper.init()
	},
	props: ['fb_helper, caca']
}
</script>