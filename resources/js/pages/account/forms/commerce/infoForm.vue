<template>
    <v-form v-model="valid" ref="form" >
    
            <v-card class="mx-auto" max-width="480" :loading="loading">
            
            <v-card-title class="lime white--text mb-3 py-2">
                Informacion del Comercio
            </v-card-title>

            <v-card-text>

                <v-flex xs12 class="mb-2">
                    <image-load :nroImages="3" :imagesIn="images" :imagePath="imagePath" @updateImages="updateImages($event)"></image-load>
                </v-flex>

                <v-flex xs12 >
                    <v-text-field
                        color="cyan darken-3"
                        prepend-inner-icon="mdi-gavel"
                        label="Nit"
                        hint="NIT del Comercio                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             Ej: 123123123-1"
                        :rules="rules.nit"
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
                        :rules="[rules.required, rules.maxlength(50)]"
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
                        :rules="[rules.maxlength(50), rules.required]"
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
                        :rules="[rules.select]"
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
                        :rules="[rules.mutiple]"
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
                        :rules="[rules.select]"
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
                        :rules="[rules.select]"
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
                        :items="selects.horarios"
                        :rules="[rules.maxlength(180)]"
                        dense
                        outlined
                        auto-grow
                        filled
                        rows="2"
                        counter="150"
                    ></v-textarea>
                </v-flex>
                
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn small dark fab color="amber" @click="cancel()" :loading="loading"> <v-icon>mdi-restore</v-icon></v-btn>
                    <v-btn small dark fab color="success" @click="update()" :loading="loading"> <v-icon>mdi-content-save-edit</v-icon></v-btn>
            </v-card-actions>
        </v-card>    
    </v-form>
</template>

<script>

import AppForm from '@mixins/AppForm'
import ImageLoad from './ImageLoad';

export default {

    components: {
        'image-load':  ImageLoad
    },
    
    mixins: [ AppForm ],

    created()
    {
        this.item = this.$store.getters['getComercio']
        this.mapForm()
        this.setRelations()
        this.setImages(this.item.foto)
        this.loading = false
    },

    computed: 
    {
        getIduser()
        {
            return this.$store.getters['getUserid']
        },

        getCategorias()
        {
            return this.$store.getters['getCategorias']
        },

        images()
        {
            return (this.form.fotos) ? this.form.fotos : [] 
        }
    },

    data(){
        return{
            resource:   'comercio', 
            imagePath:  '/storage/commerce/',
            form: {
                id:               null,
                nb_comercio:      null,
                nb_fiscal:        null,
                tx_nit:           null,
                tx_descripcion:   null,
                id_tipo_comercio: null,
                categorias:       [],
                id_tipo_pago:     null,
                horarios:         [],
                id_usuario:       null,
                fotos:            []
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
                this.setImages(response.data.comercio.fotos)
			})
            .catch( error =>
            {
                this.showError(error);
            })
            .finally( () => this.loading = false ); 
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

        setImages(images)
        {
            
            this.form.fotos = [];

            if(images) 
            {
                for (const image of images)
                {
                    this.form.fotos.push(image.tx_src)
                }
            }
        },

        updateImages(images)
        {
            this.form.fotos = [];
            
            for (let image of images) 
            {
                this.form.fotos.push(image.replace(this.imagePath, ''))
            }
        },

        cancel()
        {
            this.$refs.form.resetValidation() 
            this.mapForm()
            this.setRelations()
            this.setImages(this.item.foto)
        }
    }
}
</script>

<style>
    .v-file-input .v-icon {
        font-size: 60px !important;
        color: var(--v-info-base);
        margin: 8px;
        opacity: 0.8;
    }

    .v-file-input .v-icon:hover {
        opacity: 1;
    }
</style>