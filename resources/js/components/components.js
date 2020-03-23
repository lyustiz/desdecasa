import Vue from 'vue';


import Welcome 		  from '~/pages/welcome/Welcome.vue'
import Page 		  from '~/pages/page/Page.vue'
import Comercios      from '~/pages/comercios/Comercios.vue'

import Login 		  from '~/components/app/AppLogin'
import ListButtons    from '~/components/list/ListButton.vue'
import AddButton      from '~/components/list/AddButton.vue'
import ListContainer  from '~/components/list/ListContainer.vue'
import AppForm        from '~/components/form/AppForm.vue'
import FormButtons    from '~/components/form/FormButton.vue'
import FormDelete     from '~/components/form/FormDelete.vue'
import AppMensaje     from '~/components/app/AppMensaje.vue'
import AppModal       from '~/components/app/AppModal.vue'
import AppDialog      from '~/components/app/AppDialog.vue'
import AppIconButtom  from '~/components/app/AppIconButtom'

//Vue.component('app-welcome',       Welcome);

Vue.component('app-welcome',    Welcome);
Vue.component('app-page',       Page);
Vue.component('app-comercios',  Comercios);

Vue.component('app-login',       Login);
Vue.component('list-buttons',    ListButtons);
Vue.component('add-button',      AddButton);
Vue.component('list-container',  ListContainer);
Vue.component('app-form',        AppForm);
Vue.component('form-buttons',    FormButtons);
Vue.component('form-delete',     FormDelete);
Vue.component('app-message',     AppMensaje);
Vue.component('app-modal',       AppModal);
Vue.component('app-dialog',      AppDialog);
Vue.component('app-icon-buttom', AppIconButtom);
