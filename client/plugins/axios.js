/*
 * axiosで前処理や後処理など決まってるロジックはここに記載し、実行するように定義する
 */

export  default function ({ $axios, store, app }) {
  // エラー時の処理をここに記載する
  $axios.onError(error => {
    if(error.response.status === 422) {
      // ストアのアクションを呼び出す
      store.dispatch('validation/setErrors', error.response.data.errors);
    }

    /*
    if(error.response.status === 401 || error.response.status === 403){
      app.$auth.logout();
    }
    */


    return Promise.reject(error);
  });

  //リクエスト投げる前にエラー情報を初期化する
  $axios.onRequest(() => {
    store.dispatch('validation/clearErrors');
  });
}
