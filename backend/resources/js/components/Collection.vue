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
        placeholder="コレクション名を１つ入力してください"
        :autocomplete-items="filteredItems"
        :add-on-key="[13]"
        @tags-changed="newCollections => collections = newCollections"
      />
      <div class="submit-btn-wrapper">
      <button class="btn submit-btn" type="submit"
      >
      登録
      </button>
      <transition>
      <div v-show="show" class="submit-btn-store">
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
.submit-btn-store {
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    width: 150px;
    height: 40px;
    margin: 10px;
    border-radius: 5px;
    background-color: #2d2d2d;
}

.v-leave-active {
    transition: opacity 20s;
}
.v-leave {
    opacity: 1;
}

.v-leave-to {
    opacity: 0;
}

.submit-btn-wrapper {
    display: flex;
    justify-content: center;
}

.submit-btn {
    margin-top: 10px;
    background-color: #6E85B2;
    color: #fff;
    border: 1px solid #000;
    box-shadow: none;
}
</style>
