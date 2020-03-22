<template>
    <div>
    <!-- App Toolbar -->
    <app-toolbar></app-toolbar>

    <!--Contenido-->
    <v-content >
        <v-container fluid>
            <transition name="fade" mode="out-in" >
                <router-view></router-view>

                <v-container  fluid>
                    <v-row no-gutters >
                 <!--        <v-col md="3" sm="12" xs="12">  
                            <v-img :src="logo" aspect-ratio="2" height="280"></v-img>
                        </v-col> -->
                        <v-col md="12" sm="12" xs="12" class="py-1">  
                            <v-carousel
                                cycle
                                height="320"
                                hide-delimiter-background
                                show-arrows-on-hover
                            >
                                <v-carousel-item
                                    v-for="(slide, i) in slides"
                                    :key="i"
                                    :src="slide"
                                    cover
                                >
                                </v-carousel-item>
                            </v-carousel>
                    </v-col>
                    </v-row>

                    <v-row no-gutters >
                        <v-col md="3" sm="12" xs12> 
                            <v-img :src="despacho" height="260"></v-img>  
                        </v-col>
                        <v-col md="9" sm="12" xs12> 
                            <v-img :src="publicidad" height="260"></v-img> 
                        </v-col>
                    </v-row>
                </v-container>

            </transition>

        </v-container>
    </v-content>

    <v-navigation-drawer
      v-model="drawerRight"
      app
      clipped
      right
       class="grey lighten-5"
    >
       <app-filters></app-filters>

    </v-navigation-drawer>


    <!--Footer-->
    <v-footer :fixed="fixed" app>
        <span>&copy; {{ $App.title }}  {{ new Date().getFullYear() }}</span>
        <v-spacer></v-spacer>
        <span></span>
    </v-footer>

    <!--Mensaje Snack Bar-->
    <app-message></app-message>

    </div>

</template>
<script>

import AppMenu from  '~/components/app/AppMenu';
import AppToolbar from '~/layouts/AppToolbar';
import AppFilters from '~/components/app/AppFilters';

export default 
{
    components: { 
        'app-menu': AppMenu,
        'app-toolbar': AppToolbar, 
        'app-filters': AppFilters,
    },
    created()
    {
        
        let auth = localStorage.getItem('auth');
        let user = localStorage.getItem('user');
        
        if(auth)
        {
            this.$store.commit('setAuth', auth)
            this.$store.commit('setUser', JSON.parse(user))
        }
    },
    data () 
	{
        return {
            logo: require('~/assets/img/logo.jpg'),
            despacho: require('~/assets/img/carrito.jpg'),
            publicidad: require('~/assets/img/publicidad2.jpg'),
            clipped:     false,
            drawer:      true,
            drawerRight: true,
            fixed:       false,
            items:       [],
            miniVariant: false,
            right: true,
            colors: [
                    'indigo',
                    'warning',
                    'pink darken-2',
                    'red lighten-1',
                    'deep-purple accent-4',
                    ],
            slides: [
                        { src: require('~/assets/img/bebidas.jpg') },
                        { src: require('~/assets/img/bebidas2.jpg') },
                        { src: require('~/assets/img/plantas.jpg') }
                    ],
            

        }
    },
}
</script>
