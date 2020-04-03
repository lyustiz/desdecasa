<template>
    <v-card class="mx-auto" max-width="400">
        <v-card-title >
            Actualizar Email
        </v-card-title>
        <v-card-text>
            <v-flex xs12 >
                <v-text-field
                    color="cyan darken-3"
                    prepend-inner-icon="mdi-email-edit"
                    label="Nuevo Correo"
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
                    prepend-inner-icon="mdi-email-edit"
                    label="Reescribir Correo"
                    type="text"
                    v-model="data"
                    dense
                    outlined
                    filled  >
                </v-text-field>
            </v-flex>
            
        </v-card-text>
        <v-card-actions>
              <v-spacer></v-spacer>
              
              <v-btn small fab color="amber" dark> <v-icon>mdi-restore</v-icon></v-btn>
              <v-btn small fab color="primary" dark> <v-icon>mdi-content-save</v-icon></v-btn>
          </v-card-actions>
        </v-card>
</template>

<script>
export default {
    data(){
        return{
            show: false
        }
    }
}
</script>

<style>

</style>