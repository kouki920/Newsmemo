<template>
  <div v-if="text">
  <form @submit.prevent="clickStore">
      <input
        type="hidden"
        name="collections"
        :value="collectionsJson"
      >
      <vue-tags-input
        v-model="collection"
        :collections="collections"
        placeholder="コレクション名を入力してください"
        :autocomplete-items="filteredItems"
        @tags-changed="newCollections => collections = newCollections"
      />
      <div class="d-flex justify-content-end">
      <button class="btn btn-info d-flex justify-content-end mt-2 p-2" type="submit"
      v-on:click="clickStore"
      >
      登録する
      </button>
      </div>
    </form>
  </div>
</template>

<script>
import VueTagsInput from '@johmun/vue-tags-input';

export default {
  components: {
    VueTagsInput,
  },
  props: {
    initialCollections: {
      type: Array,
      default: [],
    },
    autocompleteItems: {
      type: Array,
      default: [],
    },
    endpoint: {
        type: String,
      },
    text: {
        type: Boolean,
        default: true,
      },
    buttonText: {
      type: String,
      default: ''
    },
  },
  data() {
    return {
      collection: '',
      collections: this.initialCollections,
    };
  },
  computed: {
    filteredItems() {
      return this.autocompleteItems.filter(i => {
        return i.text.toLowerCase().indexOf(this.collection.toLowerCase()) !== -1;
      });
    },
    collectionsJson() {
      return JSON.stringify(this.collections)
    },
  },
  methods: {
      clickStore() {
        axios.post(this.endpoint,{collections: this.collectionsJson});
        this.text = !this.text;
      },
    },
};
</script>

<style lang="css" scoped>
  .vue-tags-input {
    max-width: inherit;
  }
</style>
<style lang="css">
  .vue-tags-input .ti-tag {
    background: transparent;
    border: 1px solid #747373;
    color: #747373;
    margin-right: 4px;
    border-radius: 0px;
    font-size: 13px;
  }
</style>
