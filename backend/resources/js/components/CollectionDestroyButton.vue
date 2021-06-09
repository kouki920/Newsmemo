<template>
  <div>
    <button
      class="btn-sm border border-primary mt-2 p-2"
      type="submit"
      @click="clickDestroy"
    >削除
    </button>
  </div>
</template>

<script>
export default {
    props: {
      initialCollections: {
      type: Array,
      default: [],
      },
      authorized: {
        type: Boolean,
        default: false,
      },
      endpoint: {
        type: String,
      },
    },
    data() {
    return {
      collections: this.initialCollections,
    };
  },
  computed: {
    collectionsJson() {
      return JSON.stringify(this.collections)
    },
  },
    methods: {
      clickDestroy() {
        axios.delete(this.endpoint,{collections: this.collectionsJson})
      }
    },
  }
</script>
