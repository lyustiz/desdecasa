<template>
    <div>
    <!-- App Toolbar -->
    <app-toolbar></app-toolbar>

    <!--Contenido-->
    <v-content >
        <v-container fluid>
            <!-- <transition name="fade" mode="out-in" > -->
                <router-view></router-view>

                    <v-row no-gutters >
                        <v-col md="3" sm="12" xs="12">  
                            <v-img :src="logo" aspect-ratio="2" height="320"></v-img>
                        </v-col>
                        <v-col md="9" sm="12" xs="12" class="">  
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

                    <v-row no-gutters>
                        <v-col md="12" sm="12" xs="12" class="purple darken-3 pa-3 mt-3">
                             
                            <h3 class="white--text"><v-icon color="white">mdi-truck-delivery</v-icon> Comercios con Despachos en Todo Cali</h3>
                        </v-col>
    

                  <!--   <v-col md="3" sm="2" xs="1" v-for="(item, i) in categorias" :key="i">
                    
                        <v-card class="ma-3">
                                <v-img class="white--text align-end" height="200px" :src="item.src">
                                    <v-card-title>{{ item.title }}</v-card-title>
                                </v-img>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn icon> <v-icon color="red">mdi-heart</v-icon>         </v-btn>
                                    <v-btn icon> <v-icon color="purple darken-3">mdi-bookmark</v-icon>      </v-btn>
                                    <v-btn icon> <v-icon color="blue">mdi-share-variant</v-icon> </v-btn>
                                    
                                </v-card-actions>
                        </v-card>
                </v-col> -->

                    </v-row>

                    <v-row>

                        <v-col>
    
    <v-sheet elevation="4">

    <v-slide-group v-model="model" class="pa-4" show-arrows center-active>
      
      <v-slide-item v-for="(item, i) in categorias" :key="i"  v-slot:default="{ active, toggle }">
        
        <v-card
          :color="active ? 'primary' : 'grey lighten-1'"
          class="ma-3"
          height="200"
          width="200"
          @click="toggle"
        >
        <v-img class="white--text align-end" height="200px" :src="item.src">
            <v-card-title>{{ item.title }}</v-card-title>
        </v-img>

          <v-row class="fill-height" align="center" justify="center">
            <v-scale-transition>
              <v-icon v-if="active" color="white" size="48">mdi-close-circle-outline</v-icon>
            </v-scale-transition>
          </v-row>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn icon> <v-icon color="red">mdi-heart</v-icon>         </v-btn>
            <v-btn icon> <v-icon color="purple darken-3">mdi-bookmark</v-icon>      </v-btn>
            <v-btn icon> <v-icon color="blue">mdi-share-variant</v-icon> </v-btn>
            
            </v-card-actions>

        </v-card>

      </v-slide-item>

    </v-slide-group>

    <v-expand-transition>
      
      <v-sheet v-if="model != null" color="grey lighten-4" min-height="400" tile>
       
          <h3 class="title purple--text">Categoria {{ categorias[model].title }}</h3>
        
        <list-comercio :filtros="{ nombre: null, categoria: model + 1 }"></list-comercio>

      </v-sheet>

    </v-expand-transition>
  </v-sheet>
                        </v-col>

                    </v-row>

<!--             </transition>
 -->
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

    </v-navigation-drawer>-->


    <!--Mensaje Snack Bar-->
    <app-message></app-message>

    </div>

</template>
<script>

import AppMenu from  '~/components/app/AppMenu';
import AppToolbar from '~/layouts/AppToolbar';
import AppFilters from '~/components/app/AppFilters';
import ListComercio from '~/components/comercio/ListComercio';

export default 
{
    components: { 
        'app-menu': AppMenu,
        'app-toolbar': AppToolbar, 
        'app-filters': AppFilters,
        'list-comercio': ListComercio,
    },
    data () 
	{
        return {
            model: null,
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
            slides: [
                        { src: require('~/assets/img/bebidas.jpg') },
                        { src: require('~/assets/img/bebidas2.jpg') },
                        { src: require('~/assets/img/plantas.jpg') }
                    ],
            categorias: [
                { title: 'Ropa', src: require('~/assets/img/ropa.jpg') },
                { title: 'Zapatos', src: require('~/assets/img/zapatos.jpg') },
                { title: 'Comida', src: require('~/assets/img/comida.jpg') },
                { title: 'Belleza', src: require('~/assets/img/belleza.jpg') },
                { title: 'Ropa', src: require('~/assets/img/ropa.jpg') },
                { title: 'Zapatos', src: require('~/assets/img/zapatos.jpg') }
            ],
            

        }
    },
}
</script>
