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
            <img :src="logo" :alt="$App.title" @click="navegateTo('/')" >
        </v-avatar>
        
        <v-toolbar-title v-else>
            <v-btn
                text 
                :color="$App.theme.textTitle" 
                v-text="$App.title" 
                @click="navegateTo('/')">
            </v-btn>
        </v-toolbar-title>


        <!--Menu -->
        <!--Menu Responsive -->
        <template v-if="resize">
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
        </template>
        
        <!--Menu Desktop -->
        <template v-else>
            <v-btn text v-for="(menu, i) in menus" :key="i" @click="navegateTo(menu.route)">
                {{ menu.name }}
            </v-btn>
        </template>

        <div class="flex-grow-1"></div>

        <!-- Logged -->
        <template v-if="auth">
            
        
            <!-- Ayuda -->
            <v-tooltip bottom>
                <template v-slot:activator="{ on }">
                    <v-btn small icon v-on="on">
                        <v-icon>help</v-icon>
                    </v-btn>
                </template>
                <span>Ayuda</span>
            </v-tooltip>

            <!-- Notificaciones -->
            <v-tooltip bottom>
                <template v-slot:activator="{ on }">
                    <v-btn small icon v-on="on">
                        <v-icon>notification_important</v-icon>
                    </v-btn>
                </template>
                <span>Notificaciones</span>
            </v-tooltip>

            <!-- User -->
            <app-user></app-user>
        </template>

        <!-- UnLogged -->
        <template v-else>
            <v-tooltip bottom>
                <template v-slot:activator="{ on }">
                    <v-btn small text v-on="on" @click="navegateTo('/tipocuenta')">
                        <v-icon>mdi-account-edit</v-icon> Registro
                    </v-btn>
                </template>
                <span>Registro</span>
            </v-tooltip>

            <v-tooltip bottom>
                <template v-slot:activator="{ on }">
                    <v-btn small text v-on="on" @click="navegateTo('/login')">
                        <v-icon>mdi-login-variant</v-icon> Ingresar
                    </v-btn>
                </template>
                <span>Ingresar</span>
            </v-tooltip>
        </template>

         <v-app-bar-nav-icon @click="toggleFilter()" v-show="resize && isWelcome" ></v-app-bar-nav-icon>

    </v-app-bar>

</template>
<script>
    import { mapMutations } from 'vuex';
    export default {
        props: ['drawer','miniVariant'],
        computed: {
            auth()
            {
                return this.$store.getters['getAuth']
            },
            
            resize()
            {
                return this.$store.getters['getResize']
            },

            isWelcome()
            {
                return this.$route.name  == 'welcome'
            },
            menus()
            {
                let menus = [
                    { name: 'Conocenos', route: '/conocenos'},
                    { name: 'Servicios', route: '/servicios'},
                ];
                
                if (this.$store.getters['getAuth'])
                {
                    menus.push({ name: 'Cuenta', route: '/cuenta'})
                    // administrator menus.push({ name: 'Admin', route: '/home'})
                }
                return menus;
            }
        },
        created(){

            
        },
        data(){
            return {
                loading : false,
                logo: require('~/assets/img/logo.jpg'),
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
                    navegateTo('/');
                })
                .catch(error =>{
                    console.log('error', error)
                })
            },

            navegateTo(route)
            {
                this.$router.push(route).catch(err => {})
            }
        }
    }
</script>
<style>

</style>
