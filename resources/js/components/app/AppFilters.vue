<template>

    <v-container fluid mx-1>

        <v-divider></v-divider>

        <v-subheader>Filtros</v-subheader>

        <v-flex md12>
            <v-text-field   
                dense
                outlined
                append-icon="search"
                label="Buscar"
                v-model="form.buscar"
                hint="Indique Local ">
            </v-text-field>
        </v-flex>

        <v-flex md12>
            <v-select
                dense
                outlined
                clearable
                label="Zona"
                v-model="form.zona" 
                :items="selects.zona"
                item-value="id"
                item-text="nb_zona"
            ></v-select>
        </v-flex>

        <v-flex md12>
            <v-select
                dense
                outlined
                clearable
                label="Barrio"
                v-model="form.barrio" 
                :items="selects.barrio"
                item-value="id"
                item-text="nb_barrio"
            ></v-select>
        </v-flex>

        <v-divider></v-divider>

        <v-subheader>Filtros</v-subheader>

        <v-flex md12>
            <v-text-field 
                dense
                outlined
                append-icon="search"
                label="Buscar2"
                v-model="form.buscar"
                hint="Indique Ubicacion ">
            </v-text-field>
        </v-flex>

        <v-flex md12>
            <v-select
                dense
                outlined
                clearable
                label="Categoria"
                v-model="form.categoria"    
                :items="selects.categoria"
                item-value="id"
                item-text="nb_categoria"
            ></v-select>
        </v-flex>

    </v-container>
  
</template>

<script>

import AppRules from "~/mixins/AppRules";

export default {
    mixins: [ AppRules ],
    data()
    {
        return {
            form: {
                    buscar:     '',
                    zona:       '',
                    barrio:     '',
                    categoria:  '',
                    buscar2:    '',
                },
                selects: {

                    zona: [
                        { id: 1, nb_zona: 'Todas las zonas' },
                        { id: 2, nb_zona: 'Centro' },
                        { id: 3, nb_zona: 'Norte' },
                        { id: 4, nb_zona: 'Oeste' },
                        { id: 5, nb_zona: 'Oriente' },
                        { id: 6, nb_zona: 'Sur' },
                        { id: 7, nb_zona: 'Rural' }
                    ],

                    barrio: [
                        { id: 1, nb_barrio: 'San Fernando Viejo' },
                        { id: 2, nb_barrio: 'El Limonar' },
                        { id: 3, nb_barrio: 'Caney ' },
                        { id: 4, nb_barrio: 'Santa Mónica' },
                        { id: 5, nb_barrio: 'La Flora' },
                        { id: 6, nb_barrio: 'Lili' },
                        { id: 7, nb_barrio: 'Versalles' },
                        { id: 8, nb_barrio: 'Pance' },
                        { id: 9, nb_barrio: 'Urbanización Ciudad Jardín' }
                    ], 

                    categoria: [
                        { id: 1, nb_categoria: 'Ropa' },
                        { id: 2, nb_categoria: 'Zapatos' },
                        { id: 3, nb_categoria: 'Comida' },
                        { id: 4, nb_categoria: 'Belleza' }
                    ], 

                }
        }
    }
}
</script>

<style>

</style>