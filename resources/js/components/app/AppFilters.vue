<template>

    <v-container fluid class="mt-0">

        <v-form>
        
        <v-row no-gutters justify="end" >
                <v-spacer></v-spacer>
                <v-btn icon x-small  color="red" dark @click="toggleFilter()" v-if="resize" ><v-icon>mdi-close-circle</v-icon></v-btn> 
        </v-row>
            
        <v-row >

            <v-col>

                <v-card color="info" dark>
                    
                    <v-card-title primary-title>
                        <v-icon class="mr-1">mdi-storefront</v-icon> Comercios
                    </v-card-title>

                    <v-card-text>

                        <v-flex md12>
                            <v-text-field   
                                dense
                                outlined
                                append-icon="mdi-home-search-outline"
                                label="Buscar Comercios"
                                v-model="buscar"
                                hint="Indique Nombre del Comercio"
                                color="purple darken-1"
                                >
                            </v-text-field>
                        </v-flex>

                        <v-flex md12>
                            <v-select
                                dense
                                outlined
                                clearable
                                label="Zona"
                                v-model="zona" 
                                :items="selects.zona"
                                item-value="id"
                                item-text="nb_zona"
                                append-icon="mdi-map-search"
                            ></v-select>
                        </v-flex>

                        <v-flex md12>
                            <v-select
                                dense
                                outlined
                                clearable
                                label="Barrio"
                                v-model="barrio" 
                                :items="selects.barrio"
                                item-value="id"
                                item-text="nb_barrio"
                                append-icon="mdi-home-city"
                            ></v-select>
                        </v-flex>

                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>

        <v-row >

            <v-col>

                <v-card color="purple" dark>

                    <v-card-title primary-title>
                        <v-icon class="mr-1">mdi-truck-delivery</v-icon> Despachos en Cali
                    </v-card-title>

                    <v-card-text>

                        <v-flex md12 class="mt-5">
                            <v-text-field 
                                dense
                                outlined
                                append-icon="mdi-home-search-outline"
                                label="Buscar Comercio"
                                v-model="nombre"
                                hint="Indique Comercio">
                            </v-text-field>
                        </v-flex>

                        <v-flex md12>
                            <v-select
                                dense
                                outlined
                                clearable
                                label="Categorias"
                                v-model="categoria"    
                                :items="selects.categorias"
                                item-value="id"
                                item-text="nb_categoria"
                                append-icon="category"
                            ></v-select>
                        </v-flex>
                        
                    </v-card-text>

                </v-card>

            </v-col>
            
        </v-row>

        </v-form>

    </v-container>
  
</template>

<script>

import AppRules from "~/mixins/AppRules";
import { mapGetters, mapMutations } from 'vuex';
import { zonas as zonasJSON } from '~/assets/data/zonas.json';
import { barrios as barriosJSON } from '~/assets/data/barrios.json'

export default {
    mixins: [ AppRules ],

    computed:
    {
        resize()
        {
            return this.$store.getters['getResize']
        },
        nombre:
        {
            get() {
                return this.$store.getters['getNombre']
            },
            set(nombre) {
                this.$store.commit('setNombre', nombre)
            }
        },
        zona:
        {
            get() {
                return this.$store.getters['getZona']
            },
            set(zona) {
                this.$store.commit('setZona', zona)
                this.getBarrios(zona);
            }
        },
        barrio:
        {
            get() {
                return this.$store.getters['getBarrio']
            },
            set(barrio) {
                this.$store.commit('setBarrio', barrio)
            }
        },
        categoria:
        {
            get() {
                return this.$store.getters['getCategoria']
            },
            set(categoria) {
                this.$store.commit('setCategoria', categoria)
            }
        },
    },
    data()
    {
        return {
                buscar: null,
                selects: {

                    zona: zonasJSON,

                    barrio: [], 
                    categorias: [
                        { id: 1 , nb_categoria: 'Ropa', icon: 'mdi-tshirt-crew' , src: 'ropa.jpg' },
                        { id: 2 , nb_categoria: 'Calzado', icon: 'mdi-shoe-formal' , src: 'calzado.jpg' },
                        { id: 3 , nb_categoria: 'Comida', icon: 'mdi-food' , src: 'comida.jpg' },
                        { id: 4 , nb_categoria: 'Belleza', icon: 'mdi-hair-dryer' , src: 'belleza.jpg' },
                        { id: 5 , nb_categoria: 'Mercado', icon: 'mdi-cart' , src: 'aseo-personal.jpg' },
                        { id: 6 , nb_categoria: 'Mensajeria', icon: 'mdi-motorbike' , src: 'ferreteria.jpg' },
                        { id: 7 , nb_categoria: 'Medicinas', icon: 'mdi-needle' , src: 'mercado.jpg' },
                        { id: 8 , nb_categoria: 'Ferreteria', icon: 'mdi-hammer-screwdriver' , src: 'mensajeria.jpg' }
                    ],
                }
        }
    }, 
    methods: 
    {
        ...mapMutations(['toggleFilter']),
        filterNombre()
        {
            if( this.form.nombre.length > 3 )
            {
                this.$store.commit('setNombre', this.form.nombre);
            }
            
        },
        getBarrios(zona){

            this.barrio = null;

            if(this.zona)
            {
                for (const barrio of barriosJSON) 
                {
                   
                   if(barrio.id_zona == zona)
                    {
                        this.selects.barrio.push(barrio);
                    }
                }
            }
        }
    }
}
</script>

<style>

</style>