<template>
  <div class="container">
    <div class="col-md-6 offset-md-3">
      <div class="card mt-4">
        <div class="card-header">
          <p class="mb-0">Register</p>
        </div>
        <div class="card-body">
          <form @submit.prevent="ResetPassword"> <!-- 標準のsubmitは実行しない -->
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
              <label>Password Confirmation</label>
              <input v-model="form.password_confirmation" type="password" class="form-control" :class="{ 'is-invalid': errors.password }" placeholder="Password">
              <div class="invalid-feedback" v-if="errors.password">
                {{ errors.password[0] }}
              </div>
            </div>
            <div class="form-group">
              <input type="submit" value="Register" class="btn btn-default w-100">
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
          password_confirmation: '',
          token: ''
        },
        requestUrl: ''
      }
    },

    created() {
      this.setQuery()
    },

    methods: {
      async ResetPassword(){ // パスワードリセットリクエストを投げる関数
        await this.$axios.$post(this.requestUrl, this.form)
          .then(data => {
            this.$router.push('/auth/login');
          })
          .catch(err=> {
            console.log(err);
          });
      },
      setQuery() { // getリクエストのパラメータを取得する関数
        this.requestUrl = this.$route.query.queryURL || '';
        this.form.token = this.$route.query.token || '';
      },
    }

  }
</script>
