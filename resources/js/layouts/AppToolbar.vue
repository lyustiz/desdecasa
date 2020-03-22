<template>

    <v-app-bar
        app
        :color="$App.theme.headApp"
      clipped-right
        dark
        dense
    >
        <!--Titulo-->
        <v-toolbar-title>
            <v-btn 
                text 
                :color="$App.theme.textTitle" 
                v-text="$App.title" 
                @click="$router.push('/')">
            </v-btn>
        </v-toolbar-title>

        <v-btn text>
            Conocenos
        </v-btn>

        <v-btn text>
            Pagina
        </v-btn>

        <v-btn text>
            Servicios
        </v-btn>

       

        <div class="flex-grow-1"></div>

        <!--Usuario-->
        <app-user></app-user>
       
        <!--Ayuda-->
        <v-tooltip bottom>
            <template v-slot:activator="{ on }">
                <v-btn icon v-on="on">
                    <v-icon>help</v-icon>
                </v-btn>
            </template>
            <span>Ayuda</span>
        </v-tooltip>

        <!--Notificaciones--> 
        <v-tooltip bottom>
            <template v-slot:activator="{ on }">
                <v-btn icon v-on="on">
                    <v-icon>notification_important</v-icon>
                </v-btn>
            </template>
            <span>Notificaciones</span>
        </v-tooltip>

    </v-app-bar>

</template>
<script>
    import AppUser    from '~/layouts/AppUser'
    import AppFormat  from '~/mixins/AppFormat'
    import AppMessage from '~/mixins/AppMessage'
    export default {
        components:{ 
            'app-user': AppUser,
        },
        mixins:[AppFormat, AppMessage],
        props: ['drawer','miniVariant'],
        data(){
            return {
                loading : false
            }
        },
        methods:{
            logout()
            {
                this.loading = true;
                axios.post('logout')
                .then(response =>{
                    localStorage.clear()
                    window.location.href = response.request.responseURL;
                })
                .catch(error =>{
                    console.log('error', error)
                })
            }
        }
    }
</script>
<style>

</style>
