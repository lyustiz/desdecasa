<template>
<div>
    <component :is="layout"></component>
    <div :size="size" :resize="resize"></div>
</div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
    created()
    {
        this.$store.commit('setIsMobile', this.$App.isMobile)
        this.apiCategorias();
        this.apiZonas();
      
        let auth  = localStorage.getItem('auth');
        let token = localStorage.getItem('token');
        let user  = localStorage.getItem('user');
        
        if(auth) //check expire
        {
            this.$store.commit('setAuth',  auth)
            this.$store.commit('setToken', token)
            this.$store.commit('setUser',  JSON.parse(user))
        }
        else{
            localStorage.removeItem("token")
            localStorage.removeItem("user")
            localStorage.removeItem("expire")
            localStorage.removeItem("auth")
        }
    
    },
    computed: 
    {
        size()
        {
            this.$store.commit('setSize', this.$vuetify.breakpoint.name)
            return this.$vuetify.breakpoint.name
        },
        resize()
        {
            this.$store.commit('setResize', this.$vuetify.breakpoint.mdAndDown )
            return this.$vuetify.breakpoint.mdAndDown
        },
        layout()
        {
            return this.$store.getters['getLayout']
        }
    },

    methods: 
    {
        ...mapActions(['apiCategorias', 'apiZonas'])
    }
  }

</script>
<style>

    /* Item Activo del Menu */
    .v-list__tile--active{
        color:#f44336 !important;
    }

    /* Transicion Contenido */
    .fade-enter-active, .fade-leave-active {
        transition:  opacity 0.4s ease;
    }

    .fade-enter, .fade-leave-active {
        opacity: 0
    }
	
    .v-btn--floating {
        padding: 10px !important;
    }
    .v-btn--floating .v-btn__content {
        flex: 1 0 auto;
    }
    .v-application {
        background-color: var(--v-background-base) !important;
    }

</style>
