<template>
  <div>
    <b-navbar toggleable="lg" type="light" variant="light">
      <div class="container">
        <nuxt-link class="navbar-brand" to="/">Jwt-Auth</nuxt-link>
        <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
        <b-collapse id="nav-collapse" is-nav>
          <b-navbar-nav>
            <li v-if="authenticated" class="nav-item">
              <nuxt-link class="nav-link" to="/dashboard">Dashboard</nuxt-link>
            </li>
          </b-navbar-nav>
          <b-navbar-nav class="ml-auto">
            <template v-if="authenticated"> <!-- ログインしてない場合に表示 -->
              <b-nav-dropdown>
                <template slot="button-content">
                  {{ user.name }}
                </template>
                <b-dropdown-item @click.prevent="signOut">signOut</b-dropdown-item>
              </b-nav-dropdown>
            </template>
            <template v-else> <!-- ログインした場合に表示 -->
              <li class="nav-item">
                <nuxt-link class="nav-link" to="/auth/login">Login</nuxt-link>
              </li>
              <li class="nav-item">
                <nuxt-link class="nav-link" to="/auth/register">Register</nuxt-link>
              </li>
            </template>

          </b-navbar-nav>
        </b-collapse>
      </div>


    </b-navbar>
  </div>
</template>

<script>
  export default {
    methods: {
      signOut() {
        this.$auth.logout();
      }
    }
  }
</script>
