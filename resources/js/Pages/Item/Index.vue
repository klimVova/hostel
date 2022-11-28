<template>
<div class="container" style="margin: 50px">
  <div class="w-25 mb-3">
    <input v-model="title" type="text" class=" mb-3 form-control" placeholder="title">
    <input v-model="content" type="text" class=" mb-3 form-control" placeholder="content">
    <div ref="dropzone" class="btn d-block p-5 bg-dark text-light text-center mb-3 ">
      Upload
    </div>
    <input @click.prevent="store" type="submit" class="btn btn-primary" value="Add">
  </div>
  <div class="mt-5">
    <div v-if="items">
      <div v-for="item in items">
        <h4>{{item.title}}</h4>
        <p>{{item.content}}</p>
        <div v-for="image in item.images">
          <img :src="image.url">
        </div>
      </div>
    </div>
  </div>
</div>

</template>

<script>
import Dropzone from 'dropzone';

export default {
  name: "Index",
  data(){
    return{
      dropzone:null,
      title:null,
      content:null,
      items:null,
    }
  },
  mounted() {
    this.dropzone = new Dropzone(this.$refs.dropzone, {
      url:'/api/items',
      autoProcessQueue:false,
      addRemoveLinks: true,
    })
    this.getItem()
  },
  methods:{
    store(){
      const data = new FormData()
      const files = this.dropzone.getAcceptedFiles()

      files.forEach(file =>{
        data.append('images[]', file)
        this.dropzone.removeFile(file)
      })
      data.append('title', this.title)
      this.title = ''
      data.append('content',this.content)
      this.content = ''
      axios.post('/api/items', data)
    },
    getItem(){
      axios.get('/api/items')
       .then(res => {
         this.items = res.data.data
         console.log(res.data.data);
       })
    },
  },
}
</script>

<style scoped>

</style>
