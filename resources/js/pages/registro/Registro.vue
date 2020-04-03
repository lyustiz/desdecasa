<template>

    <div  class="grey lighten-4 holder">

    <v-row class="fill-height" >
    
    <v-col md="12">
        
        <v-card class="mx-auto elevation-8 mt-5" max-width="320" :loading="loading">
            
            <v-card-title primary-title class="cyan darken-3 white--text">
               <h4>Registro</h4><v-icon class="mx-2" color="white">mdi-account-plus</v-icon>
            </v-card-title>

            <v-divider></v-divider>
        
            <v-card-text class="px-6">

                
                <v-flex xs12 class="mt-4">
                    <v-text-field
                        color="cyan darken-3"
                        prepend-inner-icon="mdi-account"
                        label="Nombre"
                        type="text"
                        v-model="data"
                        dense
                        rounded
                        filled >
                    </v-text-field>
                </v-flex>

                <v-flex xs12>
                    <v-text-field
                        color="cyan darken-3"
                        prepend-inner-icon="mdi-email"
                        label="Correo"
                        hint="Indique cuenta de correo para activar la cuenta"
                        type="text"
                        v-model="data"
                        dense
                        rounded
                        filled  >
                    </v-text-field>
                </v-flex>

                <v-flex xs12>
                    <v-text-field
                        color="cyan darken-3"
                        prepend-inner-icon="mdi-lock"
                        :append-icon="show ? 'visibility_off' : 'visibility'"
                        @click:append="show = !show"
                        label="Password"
                        hint="Debe contener letras y numeros y una longitud minima de 8 caracteres"
                        :type="show ? 'text' : 'password'"
                        v-model="data"
                        dense
                        rounded
                        filled  >
                    </v-text-field>
                </v-flex>

                <v-flex xs12>
                    <v-text-field
                        color="cyan darken-3"
                        prepend-inner-icon="mdi-lock"
                        label="Reescribir password"
                        type="text"
                        v-model="data"
                        disabled
                        dense
                        rounded
                        filled  >
                    </v-text-field>
                </v-flex>

                <v-flex xl-12 class="mx-2">
                    <v-btn text block x-small color="cyan darken-3" @click="$router.push('login')">
                        Ingresar<v-icon>mdi-login-variant</v-icon>
                    </v-btn>
                </v-flex>

            </v-card-text>

            <v-card-actions class="white px-6 pb-4">
                    <v-btn dark color="cyan darken-3" :loading="loading" @click="loading = !loading">Registro</v-btn>
                    <v-spacer></v-spacer>
              
                     <v-tooltip top >
                        <template v-slot:activator="{ on }">
                            <v-btn fab dark x-small color="red" v-on="on" class="mx-1" :loading="loading"><v-icon>mdi-google</v-icon></v-btn>
                        </template>
                        <span>Registrarse con Google</span>
                     </v-tooltip>
                    <v-tooltip top>
                        <template v-slot:activator="{ on }">
                            <v-btn fab dark x-small color="primary" v-on="on" class="mx-1" :loading="loading"><v-icon>mdi-facebook</v-icon></v-btn>
                        </template>
                        <span>Registrarse con Facebook</span>
                     </v-tooltip>
                    <v-tooltip top>
                        <template v-slot:activator="{ on }"> 
                            <v-btn fab dark x-small color="info" v-on="on" class="mx-1" :loading="loading"><v-icon>mdi-twitter</v-icon></v-btn>
                        </template>
                        <span>Registrarse con Twitter</span>
                     </v-tooltip>                
            </v-card-actions>
           

        </v-card>

    </v-col>
    

</v-row>
</div>

</template>

<script>
export default {

    data () 
	{
        return {
            data: '',
            show: false,
            loading: false,
            logo: require('~/assets/img/servicios.jpg'),
        }
    },

}
</script>

<style>
#full-container{
    height: 92.8vh;
}

</style>