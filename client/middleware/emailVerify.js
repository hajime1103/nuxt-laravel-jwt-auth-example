//メールアドレスが認証されていなければ、メール認証の送信画面に遷移する
export default function({ store, redirect, app }) {
  if(app.$auth.user['email_verified_at'] == null) {
    return redirect('/auth/resendverify');
  }
}
