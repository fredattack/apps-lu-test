<template>
  <font-awesome-icon :icon="icon" :class="{'active' : isActive, 'inactive': !isActive }" @click="sortList"/>
</template>
<script>
export default {
  name: 'sort-icon-component',
  data() {
    return {
      color: '#bfbdbd',
      icon: 'sort-alpha-down',
      direction:'',
      columnName:this.type,
      isActive: false
    }
  },

  props: ['type'],
  methods:{
    sortList:function (){
      this.isActive = true
      if(this.direction === '' || this.direction === 'desc'){
        this.direction = 'asc';
        this.icon = 'sort-alpha-down'
      }else{
        this.direction = 'desc';
        this.icon = 'sort-alpha-up'
      }

      this.$emit('sort:list',[this.columnName,this.direction])
    }
  }
}
</script>

<style scoped>
.active{
  color: #000000
}
.inactive{
  color: #bfbdbd
}
</style>
