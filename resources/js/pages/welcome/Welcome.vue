<template>
<div>

    <!-- Contenido -->
    <v-container fluid>

        <!-- Title Despachos Barrio -->
        <v-row no-gutters class="title-banner despacho-barrio" v-if="!small  "></v-row>
        <div class="title-banner-m despacho-barrio-m ma-0 pa-0" v-else ></div>

        <v-row no-gutters class="my-2" >
            
            <!-- Logo -->
            <v-col md="3" class="d-none d-xs-none d-sm-none d-md-flex d-lg-flex">  
                <v-img :src="logo" aspect-ratio="2" height="320"></v-img>
            </v-col>

            <!-- Publicidad-->
            <v-col md="9" sm="12" xs="12" class="">  
                <list-publicidad></list-publicidad>
            </v-col>

        </v-row>

        <!-- Title Despachos Cali -->
        <v-row no-gutters class="title-banner despacho-cali" v-if="!small"></v-row>
        <div class="title-banner-m despacho-cali-m" v-else></div>
        

        <!-- Categorias | Comercios -->
        <v-row>
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

export default {
    mixins: [AppData],
    components: 
    { 
        'list-categoria': ListCategoria,
        'list-publicidad': ListPublicidad,
    },
    created()
    {
        this.apiCategorias();
        this.apiZonas();
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
            logo: require('@images/logo.jpg'),
        }
    },
    methods: {
        ...mapActions(['apiCategorias', 'apiZonas'])
    }
}
</script>

<style>

.title-banner {
    background-repeat: no-repeat;
    background-color: white;
    background-size: 100% 100%; 
    min-height: 10vh;
}

.title-banner-m {
    background-repeat: no-repeat;
    background-color: white;
    background-size: 100% 100%; 
    min-height: 2.9rem;
}

.despacho-barrio {
    background-image: url('/images/despacho-barrio.png'); 
    
}

.despacho-cali {
    background-image: url('/images/despacho-cali.png'); 
}

.despacho-barrio-m {
    background-image: url('/images/despacho-barrio-m.jpg'); 
}

.despacho-cali-m {
    background-image: url('/images/despacho-barrio-m.jpg'); 
}

</style>
