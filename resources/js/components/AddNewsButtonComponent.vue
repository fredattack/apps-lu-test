<template>
  <div class="row justify-content-center">

    <div class="col-2 offset-10 mb-3">
      <button type="button" class="btn btn-secondary " @click="showForm()">{{ btnText }}</button>
    </div>

  </div>

</template>

<script>
export default {
  name: "NewsFormComponent",
  data(){
    return {
      btnText : 'Add News',
      showButton : this.active
    }
  },
  props :['active'],
  methods:{
    showForm: function (){
     this.showButton = !this.showButton
      this.$emit('show:form',this.showButton);
    }
  }
}
</script>

