<template>
    <v-form v-model="valid" ref="form" >
    <v-card class="mx-auto" max-width="400" :loading="loading">
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
                    label="Categorias del Comercio*"
                    prepend-inner-icon="mdi-storefront-outline"
                    :rules="rules.select"
                    v-model="form.categorias" 
                    :items="getCategorias"
                    item-value="id"
                    item-text="nb_categoria"
                    multiple
                    chips
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
                    chips
                    dense
                    outlined
                    filled
                ></v-select>
            </v-flex>

            <v-flex xs12 d-flex>
                <v-combobox
                    prepend-inner-icon="mdi-calendar-clock"
                    label="Horarios*"
                    hint="Seleccione o escriba los horarios de trabajo"
                    v-model="form.horarios" 
                    :rules="rules.select"
                    :items="selects.horarios"
                    multiple
                    chips
                    dense
                    outlined
                    filled
                ></v-combobox>
            </v-flex>

            <v-flex xs12 d-flex>
                <v-textarea
                    prepend-inner-icon="mdi-wallet-travel"
                    label="Actividad Comercial"
                    hint="Detalle la Actvidad Comercial de la Empresa"
                    v-model="form.tx_descripcion"
                    dense
                    outlined
                    filled
                    rows="2"
                ></v-textarea>
            </v-flex>
            
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn small dark fab color="amber" @click="cancel()" :loading="loading"> <v-icon>mdi-restore</v-icon></v-btn>
                <v-btn small dark fab color="primary" @click="setData()" :loading="loading"> <v-icon>mdi-content-save</v-icon></v-btn>
          </v-card-actions>
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
        this.item = this.$store.getters['getComercio']
        this.mapForm()
        this.setRelations()
        this.loading = false
    },

    computed: 
    {
        getComercio()
        {
            return this.$store.getters['getComercio']
        },
        
        getIduser()
        {
            return this.$store.getters['getUserid']
        },

        getCategorias()
        {
            return this.$store.getters['getCategorias']
        }
    },

    data(){
        return{
            resource: 'comercio', 
            form: {
                nb_comercio:      '',
                nb_fiscal:        '',
                tx_nit:           '',
                tx_descripcion:   '',
                id_tipo_comercio: '',
                categorias:       '',
                id_tipo_pago:     '',
                horarios:         '',
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
                ],
                horarios: ['Lunes a viernes 7:00 am - 8:00 pm', ' Sabados 7:00 am - 8:00 pm' ]
            },
        }
    },
    methods:
    {

        setData()
        {
            if(this.item.hasOwnProperty('id')) {
                this.form.id = this.item.id
                this.update()
            } else {
                this.store()
            }
        },

        store()
        {
            if (!this.$refs.form.validate())  return 

            this.loading = true;
            this.form.id_usuario = this.getIduser;
            
            axios.post('/api/v1/' + this.resource + '/info', this.form)
			.then( response =>
			{
                this.showMessage(response.data.msj)
                this.item = response.data.comercio
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

        update()
        {
            if (!this.$refs.form.validate())  return 

            this.loading = true;
            this.form.id_usuario = this.getIduser;
            
            axios.put('/api/v1/' + this.resource + '/info', this.form)
			.then( response =>
			{
                this.showMessage(response.data.msj)
                this.item = this.form
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
                let horarios = this.item.horario.map(item => item.nb_horario) 
                this.form.horarios    = horarios
                this.selects.horarios = horarios
                this.form.categorias  = this.item.comercio_categoria.map(item => item.id_categoria) 
            }
        },

        cancel()
        {
            this.$refs.form.resetValidation()
            this.mapForm()
            this.setRelations()
        }
    }
}
</script>

<style>

</style>