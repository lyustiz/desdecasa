<template>

    <div  class="grey lighten-4 holder">

    <v-row class="fill-height" >
    
    <v-col md="12">
        
        <v-card class="mx-auto elevation-8 mt-5" max-width="320" :loading="loading">
            
            <v-card-title primary-title class="cyan darken-3 white--text">
               <h4>Ingreso</h4><v-icon class="mx-2" color="white">mdi-login-variant</v-icon>
            </v-card-title>

            <v-divider></v-divider>
        
            <v-card-text class="px-6">

                <v-flex xs12 class="mt-4">
                    <v-text-field
                        color="cyan darken-3"
                        prepend-inner-icon="mdi-email"
                        label="Correo"
                        hint="Indique cuenta de correo afiliada"
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


                <v-flex class="mx-0 d-flex justify-space-between>"> 
                   <v-btn text x-small color="cyan darken-3" @click="$router.push('registro')">
                       Registro<v-icon class="mx-1">mdi-account-plus-outline</v-icon>
                    </v-btn>
                    <v-btn text x-small color="cyan darken-3" @click="$router.push('recuperar-password')">
                            Recuperar Password<v-icon class="mx-1">mdi-email-send-outline</v-icon>
                    </v-btn>
                </v-flex>

            </v-card-text>

            <v-card-actions class="white px-6 pb-4">

                        <v-btn dark small color="cyan darken-3" :loading="loading" @click="loading = !loading">Ingresar</v-btn>
                        <v-spacer></v-spacer>
                        <v-tooltip top >
                            <template v-slot:activator="{ on }">
                                <v-btn fab dark x-small color="red" v-on="on" class="mx-1" :loading="loading"><v-icon>mdi-google</v-icon></v-btn>
                            </template>
                            <span>Ingresar con Google</span>
                        </v-tooltip>

                        <v-tooltip top>
                            <template v-slot:activator="{ on }">
                                <v-btn fab dark x-small color="primary" v-on="on" class="mx-1" :loading="loading"><v-icon>mdi-facebook</v-icon></v-btn>
                            </template>
                            <span>Ingresar con Facebook</span>
                        </v-tooltip>

                        <v-tooltip top>
                            <template v-slot:activator="{ on }"> 
                                <v-btn fab dark x-small color="info" v-on="on" class="mx-1" :loading="loading"><v-icon>mdi-twitter</v-icon></v-btn>
                            </template>
                            <span>Ingresar con Twitter</span>
                        </v-tooltip>     

<!-- 
                    <v-col>ddd</v-col> -->
                    
                <!-- <div class="col-12">
                    <v-flex xl-12 class="mx-2">
                        
                    </v-flex>  
                </div>       -->
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
#register-container{
    height: 92.8vh;
}

</style>