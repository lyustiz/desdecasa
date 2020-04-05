<template>
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
                    type="text"
                    :rules="rules.required"
                    v-model="data"
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
                    v-model="data"
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
                    v-model="data"
                    dense
                    outlined
                    filled >
                </v-text-field>
            </v-flex>

            <v-flex xs12 d-flex>
                <v-select
                    label="Tipo Comercio*"
                    prepend-inner-icon="mdi-storefront-outline"
                    :rules="rules.required"
                    v-model="select" 
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
                    v-model="pago" 
                    :rules="rules.required"
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
                    dense
                    outlined
                    filled
                    rows="2"
                ></v-textarea>
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

import AppRules from "~/mixins/AppRules"; 

export default {
     mixins:[AppRules],
    data(){
        return{
            data: null,
            pago: null,
            select: null,
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
    }
}
</script>

<style>

</style>