<template>
  <div class="row justify-content-center mb-5">
    <div class="col-md-10">
      <div class="card">
        <div class="row justify-content-center">
          <div class="col-2 offset-10 my-3">
            <button type="button" class="btn-close" aria-label="Close" @click="resetForm"></button>
          </div>
          <div class="col-8 ">
            <div class="mb-3">
              <label for="titleInput" class="form-label">Title</label>
              <input type="email" class="form-control" id="titleInput" v-model="news.title">
            </div>
            <div class="mb-3">
              <label for="contentInput" class="form-label">Content</label>
              <vue-editor v-model="news.content" id="contentInput"></vue-editor>

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
      </div>
    </div>
  </div>
</template>

<script>
import { VueEditor } from "vue2-editor";

export default {
  components:{VueEditor},
  name: "NewsFormComponent",
/*
  data(){
    return {
      editor: null,
    }
  },
  mounted() {
    this.editor = new Editor({
      content: '<p>Default Content Here</p>',
      extensions: [
        StarterKit,
      ],
    })
  },
  beforeUnmount() {
    this.editor.destroy()
  },*/
  methods: {
    sendForm: async function () {
      let request
      let dataRequest = {...this.news, is_published: 'is_published' in this.news}
      console.log('news', dataRequest)
      if (this.news.id) {
        request = axios.put(`/news/${this.news.id}`, dataRequest);
      } else {
        request = axios.post(`/news`, dataRequest);
      }
      await request.then(({data}) => {
        this.$emit('submit:form', data)
      }).catch(({response}) => {
        console.error('errorr', response)
      })
    },
    resetForm: function () {
      this.$emit('toggle:form')
    }
  },
  props: ['news'],
}
</script>

<style scoped>

</style>
