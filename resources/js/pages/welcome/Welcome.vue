<template>
<div v-cloak>

    <!-- Contenido -->
    <v-container fluid>

        <!-- Title Despachos Barrio -->
        <!-- <div class="title-banner-m despacho-barrio-m ma-0 pa-0" veelses ></div> -->

         <v-row no-gutters class="mt-8">
             <v-col cols="12" class="d-flex justify-center">
                 <img :src="cali" alt="" srcset="" class="banner-image align-self-center">
             </v-col>
         </v-row>
        <v-row no-gutters class="mt-6 mb-4" >
            <!-- Logo -->
            <v-col md="2"  class=" d-none d-xs-none d-sm-none d-md-flex d-lg-flex">  
                <img :src="logo" alt="" srcset="" class="logo-ppal">
            </v-col>

            <!-- Publicidad-->
            <v-col md="10" sm="12" xs="12" class="">  
                <list-publicidad></list-publicidad>
            </v-col>

        </v-row>

        <!-- Title Despachos Cali -
        <div class="title-banner-m despacho-cali-m" v-else></div>
         -->
        <v-row no-gutters class="mt-10">
             <v-col cols="12" class="d-flex justify-center">
                 <img :src="barrio" alt="" srcset="" class="banner-image align-self-center">
             </v-col>
         </v-row>
        <!-- Categorias | Comercios -->
        <v-row class="mt-3">
            <v-col>
                <list-categoria></list-categoria>
            </v-col>
        </v-row>

    </v-container>

    <!-- Contenedor de  Filtros -->
    <v-navigation-drawer :value="showFilter" app clipped right class="grey lighten-5">
        <app-filters></app-filters> 
    </v-navigation-drawer>

</div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import ListCategoria from '@components/categoria/ListCategoria';
import ListPublicidad from '@components/publicidad/ListPublicidad';

import AppData from '@mixins/AppData';
import AppMessage from '@mixins/AppMessage';

export default {
    mixins: [AppData, AppMessage],
    components: 
    { 
        'list-categoria': ListCategoria,
        'list-publicidad': ListPublicidad,
    },
    computed: 
    {
        ...mapGetters(['showFilter']),
        small()
        {
            return this.$vuetify.breakpoint.xsOnly
        },
    },
    data () 
	{
        return {
            logo: require('~/assets/img/logo.png'),
            barrio: require('~/assets/img/despacho-barrio.png'), 
            cali: require('~/assets/img/despacho-cali.png'),
        }
    },
    
}
</script>

<style>

.title-banner {
    background-repeat: no-repeat;
    background-size: 26% 100%; 
    height: 5vh;
    width: 75vw;
    z-index: 99;
    position: absolute;
    left: auto;
    right: auto;
}
.banner-image
{
    height: auto;
    width: 15rem;
    z-index: 4;
    position: absolute;

}

.title-banner-m {
    background-repeat: no-repeat;
    background-color: white;
    background-size: 100% 100%; 
    min-height: 2.9rem;
}

.despacho-barrio-m {
    background-image: url('/images/despacho-barrio-m.jpg'); 
}

.despacho-cali-m {
    background-image: url('/images/despacho-barrio-m.jpg'); 
}

.logo-ppal{
   /*  overflow: visible; */
    /* width: 80vw; */
    /* height: auto; */
    position: absolute; 
    z-index: 4;
    width: 29vw;
    height: auto;
}

</style>
