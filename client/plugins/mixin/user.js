import Vue from 'vue';

import { mapGetters } from 'vuex';


const Validation = {
  install(Vue, options){
    Vue.mixin({
      computed: {
        //ストアのゲッターを監視する
        ...mapGetters({
          user: 'auth/user',
          authenticated: 'auth/authenticated'
        })
      }
    })
  }
}

Vue.use(Validation);
