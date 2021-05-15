<template>
  <div>
      <a v-bind:href="userFollowing" class="ml-1">
        {{countFollowings}}&ensp;フォロー&ensp;
      </a>
      <a v-bind:href="userFollower">
        {{countFollowers}}&ensp;フォロワー
      </a>
  </div>
</template>

<script>
  export default {
  props: {
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
        countFollowings: this.initialCountFollowings,
        countFollowers: this.initialCountFollowers,
        userFollower: this.UserFollower,
        userFollowing: this.UserFollowing,
      }
    },
    methods: {
      async follow() {
        const response = await axios.put(this.UserFollow)
        this.countFollowings = response.data.countFollowings
        this.countFollowers = response.data.countFollowers
      },
      async unfollow() {
        const response = await axios.delete(this.UserFollow)
        this.countFollowings = response.data.countFollowings
        this.countFollowers = response.data.countFollowers
      },
    },
  }
</script>
