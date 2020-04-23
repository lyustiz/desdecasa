<template>

<div  class="grey lighten-4 holder d-flex align-content-center align-center" >

    <v-container>


        <v-row no-gutters>

            <v-col cols="3">
                <v-img class="white--text align-end" height="400px" src="images/authenticate.jpg"></v-img>
            </v-col>

            <v-col cols="3">

                <v-tabs dark vertical grow height="400" background-color="#00ad45" icons-and-text v-model="tabs">
                    <v-tab>
                        Login
                        <v-icon size="32">mdi-account</v-icon>
                        
                    </v-tab>
                    <v-tab>
                        Register
                        <v-icon size="32">mdi-account-edit</v-icon>
                        
                    </v-tab>
                    <v-tab>
                         Recuperar Password
                        <v-icon size="32">mdi-lock-open</v-icon>
                       
                    </v-tab>

 
     
                </v-tabs>

            </v-col>

            <v-col cols="6">
                
                <v-card height="400" v-if="tabs==0" >
                    <v-card-title class="text-center">
                        <h4>Ingreso</h4><v-icon class="mx-2" color="white">mdi-login-variant</v-icon>
                    </v-card-title>

                    <v-card-text class="pa-6">
                        <v-flex xs12 class="mt-4">
                    <v-text-field
                        color="cyan darken-3"
                        prepend-inner-icon="mdi-account"
                        label="Usuario"
                        hint="Indique el usuario Registrado"
                        type="text"
                        dense
                        filled  >
                    </v-text-field>
                </v-flex>

                <v-flex xs12>
                    <v-text-field
                        color="cyan darken-3"
                        prepend-inner-icon="mdi-lock"
                        append-icon="visibility"
                        label="Password"
                        hint="Debe contener letras y numeros y una longitud minima de 8 caracteres"
                        type="password"
                        dense
                        filled  >
                    </v-text-field>
                </v-flex>

                    </v-card-text>
                    <v-card-actions class="white px-6 pb-4">
                        <v-col cols="12">
                            <v-btn block dark large color="#00ad45">Ingresar</v-btn>
                        </v-col>
                    </v-card-actions>

                </v-card>

                <v-card height="400" v-if="tabs==1">
                    registro
                </v-card>

                <v-card height="400" v-if="tabs==2">
                    recuperar
                    
                </v-card>

       
            </v-col>



        </v-row>
        {{$data}}
    </v-container>

</div>

</template>

<script>
import AppRules from '@mixins/AppRules'

export default {
    data()
    {
        return {
            tabs: 0
        }
    }
}
</script>

<style>
#register-container{
    height: 92.8vh;
}

</style>