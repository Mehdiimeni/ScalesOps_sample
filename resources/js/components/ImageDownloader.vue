<template>
  <div>
    <input v-model="searchQuery" placeholder="Enter search query" />
    <button @click="downloadAndSaveImages">Download and Save Images</button>

    <div v-if="images.length">
      <h2>Downloaded Images:</h2>
      <ul>
        <li v-for="(image, index) in images" :key="index">
          <img :src="image" alt="Downloaded Image" />
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      searchQuery: "",
      images: [],
    };
  },
  methods: {
    async downloadAndSaveImages() {
      try {
        const { data } = await this.$axios.get(`/download-and-save-images`, {
          params: { searchQuery: this.searchQuery },
        });
        this.images = data;
      } catch (error) {
        console.error("Error downloading and saving images:", error);
      }
    },
  },
};
</script>
