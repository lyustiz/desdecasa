<template>
    <v-card class="mx-auto" max-width="400">
         <v-card-title >
            Actualizar Password 
         </v-card-title>
          <v-card-text>
            <v-flex md12 >
                    <v-text-field
                        color="cyan darken-3"
                        prepend-inner-icon="mdi-lock"
                        :append-icon="show ? 'visibility_off' : 'visibility'"
                        @click:append="show = !show"
                        label="Password Actual"
                        :type="show ? 'text' : 'password'"
                        v-model="data"
                        dense
                        outlined 
                        filled >
                    </v-text-field>
                </v-flex>

                <v-flex md12 xs12>
                    <v-text-field
                        color="cyan darken-3"
                        prepend-inner-icon="mdi-lock"
                        label="Nuevo password"
                        type="text"
                        hint="Debe contener letras y numeros y una longitud minima de 8 caracteres"
                        v-model="data"
                        disabled
                        dense
                        outlined
                        filled  >
                    </v-text-field>
                </v-flex>

                <v-flex md12 xs12>
                    <v-text-field
                        color="cyan darken-3"
                        prepend-inner-icon="mdi-lock"
                        label="Reescribir password"
                        type="text"
                        v-model="data"
                        disabled
                        dense
                        outlined 
                        filled >
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
            show: false,
            data: ''
        }
    }
}
</script>

<style>

</style>