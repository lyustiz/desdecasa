<template>
    <v-form v-model="valid" ref="form" >
    <v-card class="mx-auto" max-width="400">
        <v-card-title >
            Informacion del Comercio
        </v-card-title>
        <v-card-text>

            <v-flex xs12 >
                <v-text-field
                    color="cyan darken-3"
                    prepend-inner-icon="mdi-gavel"
                    label="Nit"
                    hint=""
                    :rules="rules.required"
                    v-model="form.tx_nit"
                    dense
                    outlined
                    filled >
                </v-text-field>
            </v-flex>

            <v-flex xs12 >
                <v-text-field
                    color="cyan darken-3"
                    prepend-inner-icon="mdi-storefront-outline"
                    label="Nombre Fiscal"
                    type="text"
                    :rules="rules.required"
                    v-model="form.nb_fiscal"
                    dense
                    outlined
                    filled >
                </v-text-field>
            </v-flex>

            <v-flex xs12 >
                <v-text-field
                    color="cyan darken-3"
                    prepend-inner-icon="mdi-storefront-outline"
                    label="Nombre Comercial"
                    type="text"
                    :rules="rules.required"
                    v-model="form.nb_comercio"
                    dense
                    outlined
                    filled >
                </v-text-field>
            </v-flex>

            <v-flex xs12 d-flex>
                <v-select
                    label="Tipo Comercio*"
                    prepend-inner-icon="mdi-storefront-outline"
                    :rules="rules.select"
                    v-model="form.id_tipo_comercio" 
                    :items="selects.tipoComercio"
                    item-value="id"
                    item-text="nb_tipo_comercio"
                    dense
                    outlined
                    filled
                ></v-select>
            </v-flex>

            <v-flex xs12 d-flex>
                <v-select
                    prepend-inner-icon="credit_card"
                    label="Medios de Pago*"
                    v-model="form.id_tipo_pago" 
                    :rules="rules.select"
                    :items="selects.tipoPago"
                    item-value="id"
                    item-text="nb_tipo_pago"
                    multiple
                    dense
                    outlined
                    filled
                ></v-select>
            </v-flex>

            <v-flex xs12 d-flex>
                <v-textarea
                    prepend-inner-icon="mdi-calendar-clock"
                    label="Horarios"
                    hint="Indique horarios de entrada y salida"
                    v-model="form.tx_horarios"
                    :rules="rules.required"
                    dense
                    outlined
                    filled
                    rows="2"
                ></v-textarea>
            </v-flex>

            <v-flex xs12 d-flex>
                <v-textarea
                    prepend-inner-icon="mdi-wallet-travel"
                    label="Actividad Comercial"
                    hint="Detalle la Actvidad Comercial de la Empresa"
                    v-model="form.tx_horarios"
                    dense
                    outlined
                    filled
                    rows="2"
                ></v-textarea>
            </v-flex>
            
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn small dark fab color="amber" @click="cancel()"> <v-icon>mdi-restore</v-icon></v-btn>
                <v-btn small dark fab color="primary" @click="store()"> <v-icon>mdi-content-save</v-icon></v-btn>
          </v-card-actions>
          <pre>{{$data}}</pre>  
    </v-card>
    </v-form>
</template>

<script>

import AppForm from '@mixins/AppForm'
import AppData from '@mixins/AppData'

export default {
    
    mixins: [ AppForm, AppData ],

    created() 
    {
        this.fetch()
        
    },
    computed: 
    {
        getIduser()
        {
            return 20 // this.$store.getters['getUserid']
        }
    },

    data(){
        return{
            resource: 'comercio', 
            form: {
                nb_comercio:       '',
                nb_fiscal:        '',
                tx_nit:           '',
                tx_descripcion:   '',
                id_tipo_comercio: '',
                id_tipo_pago:     '',
                tx_horarios:      '',
                id_usuario:       '',
            },
            selects: {
                tipoComercio: [
                    { id: 1, nb_tipo_comercio: 'Sede Física'},
                    { id: 2, nb_tipo_comercio: 'Tienda Virtual (Solo Medios Digitales)'},
                    { id: 3, nb_tipo_comercio: 'Solo Servicio a Domicilio (No posee Sede Física)'}
                ],
                tipoPago: [
                    { id: 1, nb_tipo_pago: 'Visa'},
                    { id: 2, nb_tipo_pago: 'Mastercard'},
                    { id: 3, nb_tipo_pago: 'Efectivo'},
                    { id: 4, nb_tipo_pago: 'Debito'},
                    { id: 5, nb_tipo_pago: 'Criptomoneda'},
                    { id: 6, nb_tipo_pago: 'Paypal'}
                ]
            },
            
        }
    },
    methods:
    {
        fetch()
        {
            this.form.id_usuario = this.getIduser;

            axios.get('/api/v1/' + this.resource + '/usuario/' + this.getIduser)
			.then( response =>
			{
                this.item = response.data;
                this.mapForm()
                this.setRelations()
			})
            .catch( error =>
            {
              console.log(error)
            })
            
        },

        store()
        {
            if (!this.$refs.form.validate())  return 

            this.loading = true;
            this.form.id_usuario = this.getIduser;
            
            axios.post('/api/v1/' + this.resource, this.form)
			.then( response =>
			{
                this.showMessage(response.data.msj)
			})
            .catch( error =>
            {
                this.showError(error);
            })
            .finally( () =>
            {
                this.loading = false
            }); 
    
        },

        setRelations()
        {
            if(this.item)
            {
                this.form.tx_horarios = this.item.horario
            }
        }
    }
    
}
</script>

<style>

</style>