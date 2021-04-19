<template>
<div>
<ul>
        <li v-for="post in posts">
            <p>{{ post }}</p>
        </li>
    </ul>
    <div ref="observe_element">この要素を監視します
  </div>
    </div>
</template>

<script>
  export default {
  props: {
  endpoint: {
        type: String,
      },
  },
  data() {
  return {
  observer: null,
    posts: [],
    page: 1,
  }
  },
  mounted() {
  this.getPosts()
    this.observer = new IntersectionObserver(entries => {
      const entry = entries[0]
      if(entry && entry.isIntersecting) {
        console.log('画面に入ったよ')
        this.getPosts()
          }
          })
    const observe_element = this.$refs.observe_element
    this.observer.observe(observe_element)
    },
    methods: {
   async getPosts() {
        await axios.get(this.endpoint,).then(response => this.posts = response.data);
    }
},
  }
</script>
