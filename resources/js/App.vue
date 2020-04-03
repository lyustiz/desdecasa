<template>
<div>
    <component :is="layout"></component>
    <div :size="size" :resize="resize"></div>
</div>
</template>

<script>

export default {
    created()
    {
        this.$store.commit('setIsMobile', this.$App.isMobile)
      
        let auth = localStorage.getItem('auth');
        let user = localStorage.getItem('user');
        
        if(auth)
        {
            this.$store.commit('setAuth', auth)
            this.$store.commit('setUser', JSON.parse(user))
        }
    },
    computed: {
        size()
        {
            console.log(this.$vuetify.breakpoint)
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
    data () 
	{
        return {
             // layout: 'principal-layout',
        }
    },
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
