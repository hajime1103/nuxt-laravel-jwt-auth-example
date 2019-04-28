export const state = () => ({
  //エラー情報を保持する
  errors: {}
});

export const getters =  {
  //エラー情報をステートから取得する
  errors(state){
    return state.errors;
  }

}

export const mutations =  {
  //エラー情報をステートに保存する
  SET_VALIDATION_ERRORS(state, errors){
    state.errors = errors;
  }
}

export const actions =  {
  //エラー情報を設定するミューテーションを呼び出す
  setErrors({ commit }, errors){
    commit('SET_VALIDATION_ERRORS', errors);
  },
  //エラー情報を初期化するするミューテーションを呼び出す
  clearErrors({ commit }, errors){
    commit('SET_VALIDATION_ERRORS', {});
  }

}
