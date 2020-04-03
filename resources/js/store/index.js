import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

import AppMessage from '@store/app/AppMessage';
import user       from '@store/auth/user';
import AppFilter  from '@store/filters/AppFilter';
import AppLayout  from '@store/app/AppLayout';
import Categorias  from '@store/data/Categorias';


const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
    modules: {
        AppMessage,
        user,
        AppFilter,
        AppLayout,
        Categorias,
    },
    strict: debug
})
