<template>
  <div class="row justify-content-center">
    <div class="col-10">


      <div class="mb-3">
        <label for="titleInput" class="form-label">Title</label>
        <input type="email" class="form-control" id="titleInput" v-model="news.title">
      </div>
      <div class="mb-3">
        <label for="contentInput" class="form-label">Content</label>
        <textarea class="form-control" id="contentInput" v-model="news.content" rows="3"></textarea>
      </div>
      <div class="mb-3 px-5">
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" id="SwitchIsPublished" v-model="news.is_published">
          <label class="form-check-label" for="SwitchIsPublished">publish</label>
        </div>
      </div>
      <div class="col-2 offset-10 mb-3">
        <button type="button" class="btn btn-secondary " @click="sendForm()">Send</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "NewsFormComponent",
  // data(){
  //   return{
  //   news:this.news
  //   }
  // },
  methods: {
    sendForm: async function () {
      let request
      if (this.news.id) {
        request = axios.put(`/news/${this.news.id}`);
      } else {
        request = axios.post(`/news`, this.news);
      }
      await request.then(({data}) => {
        this.newsList = data
      }).catch(({response}) => {
        console.error(response)
      })
    }
  },
  props: ['news'],
}
</script>

<style scoped>

</style>
