<template>
  <div class="container">
    <div class="col-md-6 offset-md-3">
      <div class="card mt-4">
        <div class="card-header">
          <p class="mb-0">ForgotPassword</p>
        </div>
        <div class="card-body">
          <b-alert variant="success"　v-model="showSuccessAlert" dismissible>I have sent a password reissue email</b-alert>
          <form @submit.prevent="ReSendVerifyEmail"> <!-- 標準のsubmitは実行しない -->
            <div class="form-group">
              <label>Email</label>
              <input v-model="form.email" type="email" class="form-control" :class="{ 'is-invalid': errors.email }" placeholder="Email">
            </div>
            <div class="form-group">
              <input type="submit" value="SendResetLinkEmail" class="btn btn-default w-100">
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
        },
        showSuccessAlert: false

      }
    },
    methods: {
      async ReSendVerifyEmail(){
        await this.$axios.post('/auth/password/email', this.form)
          .then(data => {
            this.showSuccessAlert = true;

          })
          .catch(err=> {

            console.log(err);
          });


      }
    }

  }
</script>
