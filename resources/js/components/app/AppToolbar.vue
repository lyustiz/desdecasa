<template>

    <v-app-bar
        app
        :color="$App.theme.headApp"
        clipped-right
        dark
        dense
    >
        <!--Titulo-->

        <v-avatar size="36" v-if="resize">
            <img :src="logo" :alt="$App.title" @click="$router.push('/')" >
        </v-avatar>
        
        <v-toolbar-title v-else>
            <v-btn
                text 
                :color="$App.theme.textTitle" 
                v-text="$App.title" 
                @click="$router.push('/')">
            </v-btn>
        </v-toolbar-title>


        <!--Menu -->
        <!--Menu Responsive -->
        <div v-if="resize">
            <v-menu bottom left>

                <template v-slot:activator="{ on }">
                    <v-btn dark icon v-on="on">
                        <v-icon>mdi-dots-vertical</v-icon>
                    </v-btn>
                </template>

                <v-list>
                    <v-list-item v-for="(menu, i) in menus" :key="i" @click="navegateTo(menu.route)">
                        <v-list-item-title>{{ menu.name }}</v-list-item-title>
                    </v-list-item>
                </v-list>

            </v-menu>
        </div>
        
        <!--Menu Desktop -->
        <div v-else>
            <v-btn text v-for="(menu, i) in menus" :key="i" @click="navegateTo(menu.route)">
                {{ menu.name }}
            </v-btn>
        </div>

        <div class="flex-grow-1"></div>

        <!--Usuario
        <app-user></app-user>
       
        Ayuda
        <v-tooltip bottom>
            <template v-slot:activator="{ on }">
                <v-btn icon v-on="on">
                    <v-icon>help</v-icon>
                </v-btn>
            </template>
            <span>Ayuda</span>
        </v-tooltip>

        -Notificaciones 
        <v-tooltip bottom>
            <template v-slot:activator="{ on }">
                <v-btn icon v-on="on">
                    <v-icon>notification_important</v-icon>
                </v-btn>
            </template>
            <span>Notificaciones</span>
        </v-tooltip>-->

        <v-tooltip bottom>
            <template v-slot:activator="{ on }">
                <v-btn icon v-on="on" @click="$router.push('/registro')">
                    <v-icon>mdi-account-plus</v-icon>
                </v-btn>
            </template>
            <span>Registro</span>
        </v-tooltip>

        <v-tooltip bottom>
            <template v-slot:activator="{ on }">
                <v-btn icon v-on="on" @click="$router.push('/login')">
                    <v-icon>mdi-login-variant</v-icon>
                </v-btn>
            </template>
            <span>Ingresar</span>
        </v-tooltip>

         <v-app-bar-nav-icon @click="toggleFilter()" v-show="resize && isWelcome" ></v-app-bar-nav-icon>

    </v-app-bar>

</template>
<script>
    import { mapMutations } from 'vuex';
    export default {
        props: ['drawer','miniVariant'],
        computed: {
            resize()
            {
                return this.$store.getters['getResize']
            },
            isWelcome()
            {
                return this.$route.name  == 'welcome'
            }
        },
        data(){
            return {
                loading : false,
                logo: require('~/assets/img/logo.jpg'),
                menus: [
                    { name: 'Conocenos', route: '/conocenos'},
                    { name: 'Pagina', route: '/page'},
                    { name: 'Servicios', route: '/servicios'},
                    { name: 'Cuenta', route: '/cuenta'},
                    { name: 'Admin', route: '/home'},
                ]
            }
        },
        methods:{
            
            ...mapMutations(['toggleFilter']),

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
            },

            navegateTo(route)
            {
                this.$router.push(route)
            }
        }
    }
</script>
<style>

</style>
