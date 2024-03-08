<template>
  <v-app id="inspire">
    <v-app-bar>
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

      <v-app-bar-title>Library Management System</v-app-bar-title>
    </v-app-bar>

    <v-navigation-drawer
      v-model="drawer"
      temporary
    >


    <v-btn
    color="primary" 
    block
    variant="text"
    class="mt-3 pt-2 pb-2"
    :to="{ name: 'addBook' }"
    > 
    <v-icon>mdi-plus</v-icon>
      Add Book
    </v-btn>

    </v-navigation-drawer>

    <v-main class="">
      <router-view></router-view>

    </v-main>
  </v-app>
</template>

<script>

export default {
  name: 'App',

  data: () => ({
    drawer: null,
  }),
}
</script>

<style>
.router-link{
  text-decoration: none;
}
</style>