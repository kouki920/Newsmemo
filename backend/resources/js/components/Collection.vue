<template>
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
        :add-on-key="[13, 32]"
        @tags-changed="newCollections => collections = newCollections"
      />
      <div class="d-flex justify-content-end">
      <button class="btn btn-info d-flex justify-content-end mt-2 p-2" type="submit"
      >
      登録する
      </button>
      <transition>
      <div v-show="show" class="store">
      登録完了
      </div>
      </transition>
      </div>
    </form>
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
  },
  data() {
    return {
      collection: '',
      collections: this.initialCollections,
      show: false,
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
        this.show = true;
        setTimeout(() => {
                this.show = false;
            }, 1);
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
    font-size: 10px;
  }
</style>
<style>
.store {
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    width: 150px;
    height: 50px;
    background-color: #2d2d2d;
}

.v-leave-active {
    transition: opacity 3s;
}
.v-leave {
    opacity: 1;
}

.v-leave-to {
    opacity: 0;
}
</style>
