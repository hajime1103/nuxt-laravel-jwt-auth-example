<template>
  <div class="container">
    <div class="col-md-6 offset-md-3">
      <div class="card mt-4">
        <div class="card-header">
          <p class="mb-0">Login</p>
        </div>
        <div class="card-body">
          <form @submit.prevent="Login"> <!-- 標準のsubmitは実行しない -->
            <div class="form-group">
              <label>Email</label>
              <input v-model="form.email" type="email" class="form-control" :class="{ 'is-invalid': errors.email }" placeholder="Email">
              <div class="invalid-feedback" v-if="errors.email">
                {{ errors.email[0] }}
              </div>
            </div>
            <div class="form-group">
              <label>Password</label>
              <input v-model="form.password" type="password" class="form-control" :class="{ 'is-invalid': errors.password }" placeholder="Password">
              <div class="invalid-feedback" v-if="errors.password">
                {{ errors.password[0] }}
              </div>
            </div>
            <div class="form-group">
              <input type="checkbox" id="checkbox" v-model="form.remember">
              <label for="checkbox">remember me</label>
            </div>
            <div class="form-group">
              <input type="submit" value="Login" class="btn btn-default w-100">
              <nuxt-link class="nav-link" to="/auth/forgotpassword">Forgot Your Password</nuxt-link>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
  export default {
    middleware: 'guest', //ログイン状態であればリダイレクトする
    data() {
      return {
        form: {
          email: '',
          password: '',
          remember: false
        }
      }
    },
    methods: {
      async Login(){
        await this.$auth.login({data: this.form})
          .then(data => {
            this.$router.push(this.$router.query.redirect ? this.$router.query.redirect : '/');
          })
          .catch(err =>{
            console.log(err);
          })


      }
    }

  }
</script>
