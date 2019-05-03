<template>
  <div class="container">
    <div class="col-md-6 offset-md-3">
      <div class="card mt-4">
        <div class="card-header">
          <p class="mb-0">ForgotPassword</p>
        </div>
        <div class="card-body">
          <b-alert variant="success"　v-model="showSuccessAlert">I have sent a password reissue email</b-alert>　<!-- パスワードリセットメールを送れたことをメッセージで表示する -->
          <form @submit.prevent="ReSendVerifyEmail">
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
    middleware: 'guest', //ログインであればリダイレクトする
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
        // パスワードリセットのメール送信APIを実行する
        await this.$axios.post('/auth/password/email', this.form)
          .then(data => {
            // 送信完了メッセージ表示
            this.showSuccessAlert = true;

          })
          .catch(err=> {

            console.log(err);
          });


      }
    }

  }
</script>
