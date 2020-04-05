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
                                v-model="filterZona" 
                                :items="getZonas"
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
                                v-model="filterBarrio" 
                                :items="selects.barrios"
                                :loading="barriosLoad"
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
                                v-model="filterNombre"
                                hint="Indique Comercio">
                            </v-text-field>
                        </v-flex>

                        <v-flex md12>
                            <v-select
                                dense
                                outlined
                                clearable
                                label="Categorias"
                                v-model="filterCategoria"    
                                :items="getCategorias"
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

import AppRules from "@mixins/AppRules";
import { mapGetters, mapMutations } from 'vuex';

export default {
    mixins: [ AppRules ],

    computed:
    {
        ...mapGetters(['getCategorias','getZonas']),
        resize()
        {
            return this.$store.getters['getResize']
        },
        filterNombre:
        {
            get() {
                return this.$store.getters['getNombre']
            },
            set(nombre) {
                this.$store.commit('setNombre', nombre)
            }
        },
        filterZona:
        {
            get() {
                return this.$store.getters['getZona']
            },
            set(zona) {
                this.$store.commit('setZona', zona)
                this.getBarrios(zona);
            }
        },
        filterBarrio:
        {
            get() {
                return this.$store.getters['getBarrio']
            },
            set(barrio) {
                this.$store.commit('setBarrio', barrio)
            }
        },
        filterCategoria:
        {
            get() {
                return this.$store.getters['getCategoria']
            },
            set(categoria) {
                this.$store.commit('setCategoria', categoria)
                this.getComerciosCategoria(categoria);
            }
        },

    },
    data()
    {
        return {
                buscar: null,
                barriosLoad: false,
                selects: {

                    barrios: [], 

                }
        }
    }, 
    methods: 
    {
        ...mapMutations(['toggleFilter']),

        getBarrios(zona){

            this.selects.barrios = [];
            this.barriosLoad = true;

            axios.get('/api/v1/' + 'barrio/zona/' + zona)
			.then( response =>
			{
                this.selects.barrios = response.data;
                this.barriosLoad = false;
			})
            .catch( error =>
            {
              console.log(error)
            })
        },

        getComerciosCategoria(categoria)
        {
            this.$store.dispatch('apiComerciosCategoria',  categoria )
        }
    }
}
</script>

<style>

</style>