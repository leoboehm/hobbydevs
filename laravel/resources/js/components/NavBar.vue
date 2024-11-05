<template>
  <v-app>
    <v-app-bar color="black" dark>
      <v-app-bar-title >HobbyDev</v-app-bar-title>
      <v-toolbar-items>
        <v-btn  color="blue" class="white--text" to="/">Home</v-btn>
        <v-btn  color="blue" to="/project">Project</v-btn>
        <v-btn  color="blue" to="/forum">Forum</v-btn>
        <v-btn  color="blue" to="/about">About</v-btn>
      </v-toolbar-items>
      <v-spacer></v-spacer>

      <v-text-field
        flat
        solo
        hide-details
        color="blue"
        prepend-inner-icon="mdi-magnify"
        placeholder="Search"
        class="search-bar"
      ></v-text-field>

      <v-btn colour="red" class="red--text" icon @click="onLoginClick">
      Login
      </v-btn>
    </v-app-bar>

    <v-main>
      <router-view></router-view>
    </v-main>
  </v-app>
</template>

<script>
export default {
  methods: {
    onLoginClick() {
      this.$router.push("/login");
  },
},
};
</script>

<style scoped>
/* Optional: adjust spacing, colors, or other styles as needed */
.search-bar {
  max-width: 200px;
}
</style>
