<template>
  <div class="album_item" :id="photo.id">
    <img :src="photo.picture" :alt="photo.name">
  </div>
</template>

<script>
export default {
  props: ['photo']
}
</script>