<template>
  <div>
    <button
      class="btn-sm shadow-none border border-primary p-2"
      :class="buttonColor"
      @click="clickFollow"
    >
      <i
        class="mr-1"
        :class="buttonIcon"
      ></i>
      {{ buttonText }}
    </button>
    <div>
      <a v-bind:href="userFollowing" class="ml-1">
        {{countFollowings}}&ensp;フォロー&ensp;
      </a>
      <a v-bind:href="userFollower">
        {{countFollowers}}&ensp;フォロワー
      </a>
    </div>
  </div>
</template>

<script>
  export default {
  props: {
      initialIsFollowedBy: {
        type: Boolean,
        default: false,
      },
      initialCountFollowings: {
        type: Number,
        default: 0,
      },
      initialCountFollowers: {
        type: Number,
        default: 0,
      },
      authorized: {
      type: Boolean,
      default: false
      },
      UserFollow: {
        type: String,
      },
      UserFollower: {
        type: String,
      },
      UserFollowing: {
        type: String,
      },
    },
    data() {
      return {
        isFollowedBy: this.initialIsFollowedBy,
        countFollowings: this.initialCountFollowings,
        countFollowers: this.initialCountFollowers,
        userFollower: this.UserFollower,
        userFollowing: this.UserFollowing,
      }
    },
    computed: {
      buttonColor() {
        return this.isFollowedBy
          ? 'bg-primary text-white'
          : 'bg-primary text-white'
      },
      buttonIcon() {
        return this.isFollowedBy
          ? 'fas fa-user-check'
          : 'fas fa-user-plus'
      },
      buttonText() {
        return this.isFollowedBy
          ? 'フォロー中'
          : 'フォローする'
      },
    },
    methods: {
      clickFollow() {
        if (!this.authorized) {
          alert('フォロー機能はログイン中のみ使用できます')
          return
        }

        this.isFollowedBy
          ? this.unfollow()
          : this.follow()
      },
      async follow() {
        const response = await axios.put(this.UserFollow)

        this.isFollowedBy = true
        this.countFollowings = response.data.countFollowings
        this.countFollowers = response.data.countFollowers
      },
      async unfollow() {
        const response = await axios.delete(this.UserFollow)

        this.isFollowedBy = false
        this.countFollowings = response.data.countFollowings
        this.countFollowers = response.data.countFollowers
      },
    },
  }
</script>
