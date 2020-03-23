<template>
    <div>
    <!--Contenido-->
    <!-- <v-content >
        <v-container fluid>
            
            <v-row no-gutters> 
                    <v-col lg="3" md="4" sm="6" xs="12" v-for="(item, i) in categorias" :key="i">
                    
                        <v-card class="ma-3">
                            <v-img class="white--text align-end" height="200px" :src="item.src">
                                
                            </v-img>
                            <v-card-title> <v-icon>mdi-storefront</v-icon> {{ item.title }}  </v-card-title>
                            
                            <v-card-text>
                                <p class="caption"> 
                                     <v-icon>mdi-map-marker</v-icon>  CL 11 N° 7 - 54 LOCAL 2, Cucuta
                                </p>

                                <p> 
                                    <v-icon>mdi-clock</v-icon> 
                                    <v-chip color="green" text-color="white" small>7:30</v-chip>
                                    <v-chip color="red" text-color="white" small>20:00</v-chip>
                                </p>

                                <p> 
                                     <v-icon>mdi-phone</v-icon> 
                                     
                                     <v-btn link  href="tel:+129-344-7777-888" target="_blank"  flat text>
                                         129-344-7777-888
                                     </v-btn>

                                     <v-btn link  href="https://wa.me/+058-(412)9098862" target="_blank"  flat icon >
                                         <v-icon color="green">mdi-whatsapp</v-icon>
                                     </v-btn>
         
                                </p>


                                
                            </v-card-text>
                            
                            <v-card-actions>

                                <v-badge
                                    bordered
                                    color="info"
                                    overlap
                                    content="6"
                                >
                                    <v-btn flat icon color="primary">
                                        <v-icon>mdi-message-plus-outline</v-icon>
                                    </v-btn>
                                </v-badge>

                               
                                <v-spacer></v-spacer>
                                <span>({{  rating  }}-5)</span>
                                <v-rating
                                    v-model="rating"
                                    color="amber"
                                    background-color="amber"
                                    dense
                                    hover
                                    ripple
                                ></v-rating>
                                 <v-badge
                                    bordered
                                    color="info"
                                    overlap
                                    content="6"
                                >
                                    <v-btn icon>
                                        <v-icon color="green">mdi-thumb-up</v-icon>
                                    </v-btn>
                                </v-badge>
                                <v-badge
                                    bordered
                                    color="info"
                                    overlap
                                    content="1"
                                >
                                    <v-btn icon>
                                        <v-icon color="red">mdi-thumb-down</v-icon>
                                    </v-btn>
                                </v-badge> 
                                
                                                             
                            </v-card-actions>
                        </v-card>
                </v-col>

            </v-row>
        </v-container>
    </v-content>
 -->
    <list-comercio></list-comercio>

 
    </div>

</template>
<script>

import ListComercio from '~/components/comercio/ListComercio';

export default 
{
    components: { 
        'list-comercio': ListComercio, 
    },
    data () 
	{
        return {
            rating: 1,
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
            categorias: [
                { title: 'El Bodegon', src: require('~/assets/img/comer1.jpg') },
                { title: 'La Taguara', src: require('~/assets/img/comer2.jpg') },
                { title: 'Cafe El Negrito', src: require('~/assets/img/comer3.jpg') },
                { title: 'Botiqueria', src: require('~/assets/img/comer4.jpg') },
                { title: 'Mi Tiendita', src: require('~/assets/img/comer5.jpg') },
                { title: 'Mis Verduras', src: require('~/assets/img/comer6.jpg') },
            ],
            

        }
    },
}
</script>
