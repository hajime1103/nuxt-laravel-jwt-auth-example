//ログインしているかチェックを行い、ログインしてる場合はリダイレクトする
export default function({ store, redirect }) {
  if(store.getters['auth/authenticated']) {
    return redirect('/');
  }
}
