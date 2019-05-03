<template>
  <div class="container">
    <div class="col-md-6 offset-md-3">
      <div class="card mt-4">
        <div class="card-header">
          <p class="mb-0">During Verification Your Email Address</p>
        </div>
        <div class="card-body">
          <label>Validating your email address.</label>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    middleware: 'auth', //未ログイン状態であればリダイレクトする
    data() {
      return {
        queryURL: ''
      }
    },

    async mounted() {
      const queryURL = this.$route.query.queryURL || '';
      if (queryURL != '') {
        await this.$axios.$get(queryURL)
          .then(data => {
            this.$auth.fetchUser();             // メール認証が完了したため、ユーザ情報を再取得する
            this.$router.push({name: 'index'});
          })
          .catch(err => {
            alert('メール認証が失敗しました。再度メール認証を行ってください。');
            this.$router.push('/auth/resendverify');
          });
      }
    },
  }
</script>
