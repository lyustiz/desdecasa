<template>

    <div  class="grey lighten-4 holder">

    <v-row class="fill-height" >
    
    <v-col md="12">

        <v-form v-model="valid" ref="registerForm" >
        
        <v-card class="mx-auto elevation-8 mt-5" max-width="320" :loading="loading">
            
            <v-card-title primary-title class="cyan darken-3 white--text">
               <h4>Registro de Comercio</h4><v-icon class="mx-2" color="white">mdi-storefront</v-icon>
            </v-card-title>

            <v-divider></v-divider>
        
            <v-card-text class="px-6">

                <v-flex xs12 >
                    <v-text-field
                        color="cyan darken-3"
                        prepend-inner-icon="mdi-storefront"
                        label="Nombre del Comercio"
                        type="text"
                        v-model="form.nb_comercio"
                        :rules="[rules.required]"
                        dense
                        rounded
                        filled >
                    </v-text-field>
                </v-flex>

                <v-flex xs12 class="">
                    <v-text-field
                        color="cyan darken-3"
                        prepend-inner-icon="mdi-storefront"
                        label="NIT"
                        hint="Numero de Informacion Fiscal"
                        persistent-hint
                        type="text"
                        v-model="form.tx_nit"
                        :rules="[rules.required]"
                        dense
                        rounded
                        filled >
                    </v-text-field>
                </v-flex>

                <v-radio-group v-model="despacho" row :rules="[rules.required]">
                    <v-radio label="Depacho Todo Cali" value="cali"></v-radio>
                    <v-radio label="Despacho por Zonas (selecione)" value="zonas"></v-radio>
                </v-radio-group>

                <v-flex md12 v-if="despacho == 'zonas'">
                    <v-select
                        dense
                        outlined
                        :rules="rules.zonas"
                        label="Zona"
                        v-model="form.zonas" 
                        :items="getZonas"
                        item-value="id"
                        item-text="nb_zona"
                        append-icon="mdi-select-marker"
                        multiple=""
                        chips
                        clearable
                    ></v-select>
                </v-flex>

                <v-divider></v-divider>

                <v-flex xs12 class="mt-2" >
                    <v-text-field
                        color="cyan darken-3"
                        prepend-inner-icon="mdi-account"
                        label="Nombre Usuario"
                        type="text"
                        v-model="form.nb_usuario"
                        :rules="[rules.required]"
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
                        v-model="form.email"
                        :rules="rules.email"
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
                        v-model="form.password"
                        :rules="rules.password"
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
                        :type="show ? 'text' : 'password'"
                        v-model="form.passwordRew"
                        :rules="[rules.password_confirmation]"
                        :disabled="passwordValid"
                        dense
                        rounded
                        filled  >
                    </v-text-field>
                </v-flex>

            </v-card-text>

            <v-card-actions class="white px-6 pb-4">
                    
                    
                    
                <v-row >
                
                    <v-col cols="12">
                        <v-btn block dark small color="cyan darken-3" :loading="loading" @click="register">Registrarse</v-btn>
                    </v-col>
                    <v-col cols="6">
                        <v-btn text  x-small color="cyan darken-3" :loading="loading" @click="$router.push('tipocuenta')">
                        tipo de cuenta<v-icon>mdi-account-question</v-icon>
                        </v-btn>
                    </v-col>
                    <v-col cols="6">
                        <v-btn text  x-small color="cyan darken-3" :loading="loading" @click="$router.push('login')">
                        Ingresar<v-icon>mdi-login-variant</v-icon>
                        </v-btn>
                    </v-col>

                </v-row>
              
                     <!-- <v-tooltip top >
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
                     </v-tooltip>          -->       
            </v-card-actions>
           
        </v-card>

        </v-form>

    </v-col>
    

</v-row>
<pre>{{$data}}</pre>
</div>

</template>

<script>
import AppRules from '@mixins/AppRules'
import { mapGetters } from 'vuex';

export default {
    mixins: [ AppRules ],
    computed: {
        ...mapGetters(['getZonas']),
        passwordValid()
        {
            if(this.form.password)
            {
                return (!this.form.password.length > 7);
            }

            return true;
        }
    },
    watch:
    {
        despacho(val)
        {
            if(val == 'cali') {
                this.form.zonas = [7]
            } else {
                this.form.zonas = []
            }
            
        }
    },
    data () 
	{
        return {
            form:{
                nb_comercio: '',
                tx_nit:      '',
                nb_usuario:  '',
                email:       '',
                password:    '',
                passwordRew: '',
                zonas:       []
            },
            rules: {
                zonas: [
                    v => (this.despacho == 'zonas') ? v.length > 0 || 'indique zonas de despacho' : true
                ],
            },
            show: false,
            loading: false,
            valid: '',
            despacho: ''
        }
    },
    methods: {
        register()
        {
            if (!this.$refs.registerForm.validate())  return 
            
            this.loading = true
            
            this.$store.dispatch('registerCommerce', this.form)
            .then(response => {
              
                if(response.status == 201 && response.statusText == "Created")
                {
                    this.$refs.registerForm.reset();
                    this.showMessage(`Se ha registrado Corectamente. Ingrese en su correo para activar el usuario `);
                    this.$router.push('login');
                }

            }).catch(error =>
            {
                this.showError(error);
            })
            .then(() => 
            {
                this.loading = false
            })

        }
    }

}
</script>

<style>
#full-container{
    height: 92.8vh;
}

</style>