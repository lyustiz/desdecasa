<template>
    <v-card class="mx-auto" max-width="400">
        <v-card-title >
            Ubicacion del Comercio
        </v-card-title>
        <v-card-text>

            <v-flex xs12 d-flex>
                <v-select
                    label="Departamento*"
                    prepend-inner-icon="mdi-map-search"
                    :rules="rules.required"
                    v-model="select" 
                    :items="[{ id: 76, nb_departamento: 'Valle del Cauca'}]"
                    item-value="id"
                    item-text="nb_departamento"
                    dense
                    outlined
                    filled
                ></v-select>
            </v-flex>

            <v-flex xs12 d-flex>
                <v-select
                    label="Ciudad (*)"
                    prepend-inner-icon="mdi-city-variant" 
                    :rules="rules.required"
                    v-model="select" 
                    :items="[{ id: 76, nb_municipio: 'Cali'}]"
                    item-value="id"
                    item-text="nb_municipio"
                    dense
                    outlined
                    filled
                ></v-select>
            </v-flex>

            <v-flex xs12 d-flex>
                <v-select
                    label="Zona*"
                    prepend-inner-icon="mdi-select-marker" 
                    :rules="rules.required"
                    v-model="zona" 
                    :items="selects.zonas"
                    item-value="id"
                    item-text="nb_zona"
                    dense
                    outlined
                    filled
                ></v-select>
            </v-flex>

            <v-flex xs12 d-flex>
                <v-select
                    prepend-inner-icon="mdi-map-marker-radius" 
                    label="Comuna*"
                    :rules="rules.required"
                    v-model="comuna" 
                    :items="[{ id: 1, nb_comuna: 'Comuna 1'}, { id: 2, nb_comuna: 'Comuna 2'}, { id: 3, nb_comuna: 'Comuna 3'}]"
                    item-value="id"
                    item-text="nb_comuna"
                    dense
                    outlined
                    filled
                ></v-select>
            </v-flex>

            <v-flex xs12 d-flex>
                <v-select
                    label="Barrio*"
                    prepend-inner-icon="mdi-home-modern" 
                    :rules="rules.required"
                    v-model="barrio" 
                    :items="selects.barrios"
                    item-value="id"
                    item-text="nb_barrio"
                    dense
                    outlined
                    filled
                ></v-select>
            </v-flex>

            <v-flex xs12 >
                <v-text-field
                    color="cyan darken-3"
                    prepend-inner-icon="mdi-sign-direction"
                    label="Direccion"
                    type="text"
                    :rules="rules.required"
                    v-model="data"
                    dense
                    outlined
                    filled >
                </v-text-field>
            </v-flex>
            
            </v-card-text>
            <v-card-actions class="mx-2">
                <v-btn color="success" dark> <v-icon>mdi-map</v-icon>Mapa</v-btn>
                <v-spacer></v-spacer>
                <v-btn small fab color="amber" dark> <v-icon>mdi-restore</v-icon></v-btn>
                <v-btn small fab color="primary" dark> <v-icon>mdi-content-save</v-icon></v-btn>
          </v-card-actions>
        </v-card>

</template>

<script>

import AppRules from "~/mixins/AppRules"; 
import { zonas as zonasJSON } from '~/assets/data/zonas.json';
import { barrios as barriosJSON } from '~/assets/data/barrios.json'

export default {
     mixins:[AppRules],
    data(){
        return{
            data: null,
            select: null,
            zona: null,
            comuna: null,
            barrio: null,
            selects: {
                zonas: zonasJSON,
                barrios: barriosJSON
            },
            
        }
    }
}
</script>

<style>

</style>