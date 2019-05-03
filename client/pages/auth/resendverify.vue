<template>
  <div class="container">
    <div class="col-md-6 offset-md-3">
      <div class="card mt-4">
        <div class="card-header">
          <p class="mb-0">Verify Your Email Address</p>
        </div>
        <div class="card-body">
          <b-alert variant="success" v-model="showSuccessAlert">I have sent a password reissue email</b-alert>
          <label>Email verification has not been completed yet.
            Please press the button below to complete e-mail authentication</label>
          <div>
            <b-button block variant="primary" @click="ReSendVerifyEmail">Verify Email</b-button>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
  export default {
    middleware: 'auth', //ログインしてなければリダイレクトする
    data() {
      return {
        form: {
          email: '',
        },
        showSuccessAlert: false,
      }
    },

    methods: {
      async ReSendVerifyEmail(){

        // 現在ログインしているユーザのメールを取得する
        this.form.email = this.$auth.user.email;

        await this.$axios.post('/auth/email/resend', this.form)
          .then(data => {
            this.showSuccessAlert = true;
          })
          .catch(err=> {
            console.log(err);
          });
      },

    }

  }
</script>
