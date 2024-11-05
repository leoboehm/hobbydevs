<template>
  <v-app>
    <v-app-bar color="black" dark>
      <v-app-bar-title >HobbyDev</v-app-bar-title>
      <v-toolbar-items>
        <v-btn  color="blue" class="white--text" to="/">Home</v-btn>

        <v-menu offset-y>
          <template #activator="{ on }">
            <v-btn color="blue" class="white--text" v-on="on">
              Project
            </v-btn>
          </template>
          <v-list>
            <v-list-item @click="goToProjectDetails">
              <v-list-item-title>Project Details</v-list-item-title>
            </v-list-item>
            <v-list-item @click="goToProjectList">
              <v-list-item-title>Project List</v-list-item-title>
            </v-list-item>
          </v-list>
        </v-menu>

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
//
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
    goToProjectDetails() {
      this.$router.push("/project/details"); 
    },
    goToProjectList() {
      this.$router.push("/project/list"); 
    },
},
};
</script>

<style scoped>

.search-bar {
  max-width: 200px;
}
</style>
