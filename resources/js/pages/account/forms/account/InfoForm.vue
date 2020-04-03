<template>
    <v-row no-gutters>
    <v-col  md="6" sm="12" xs="12">
    <v-card class="ml-auto" max-width="400">
        <v-card-title >
            Datos Personales
        </v-card-title>
        <v-card-text>
            <v-flex xs12 >
                <v-text-field
                    color="cyan darken-3"
                    prepend-inner-icon="mdi-account"
                    label="Nombre"
                    type="text"
                    v-model="data"
                    dense
                    outlined
                    filled >
                </v-text-field>
            </v-flex>

            <v-flex md12 xs12>
                <v-text-field
                    color="cyan darken-3"
                    prepend-inner-icon="mdi-calendar"
                    label="Fecha Cumpleaños"
                    type="text"
                    v-model="data"
                    dense
                    outlined
                    filled  >
                </v-text-field>
            </v-flex>

            <v-flex md12 xs12>
                <v-radio-group v-model="row" row dense>
                    <v-radio label="Hombre" value="radio-1"></v-radio>
                    <v-radio label="Mujer" value="radio-2"></v-radio>
                </v-radio-group>
            </v-flex>

            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn small fab color="amber" dark> <v-icon>mdi-restore</v-icon></v-btn>
                <v-btn small fab color="primary" dark> <v-icon>mdi-content-save</v-icon></v-btn>
          </v-card-actions>
        </v-card>
        </v-col>
        <v-col md="6" sm="12" xs="12">

        <v-card class="mx-rigth ma-2" max-width="400">
            <v-card-title >
                Avatar
            </v-card-title>
            
            <v-img class="mx-auto" width="200" height="200px" :src="`images/account.png`"></v-img>
            
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn small fab color="primary" dark> <v-icon>mdi-upload</v-icon></v-btn>
          </v-card-actions>
        </v-card>

        </v-col>
    
    </v-row>
</template>

<script>
export default {

}
</script>

<style>

</style>