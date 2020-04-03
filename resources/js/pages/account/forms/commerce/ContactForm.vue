<template>
    <v-card class="mx-auto" max-width="400">
        <v-card-title >
            Informacion del Contacto
        </v-card-title>
        <v-card-text>

            <v-flex xs12 >
                <v-text-field
                    color="cyan darken-3"
                    prepend-inner-icon="mdi-phone"
                    label="Telefono Fijo"
                    type="text"
                    v-model="data"
                    dense
                    outlined
                    filled >
                </v-text-field>
            </v-flex>

            <v-flex xs12 >
                <v-text-field
                    color="cyan darken-3"
                    prepend-inner-icon="mdi-cellphone"
                    label="Telefono Movil"
                    type="text"
                    v-model="data"
                    dense
                    outlined
                    filled >
                </v-text-field>
            </v-flex>

            <v-flex xs12 >
                <v-text-field
                    color="cyan darken-3"
                    prepend-inner-icon="mdi-email"
                    label="Email de Comercio"
                    type="text"
                    hint="Email de contacto del Comercio"
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
                    prepend-inner-icon="mdi-printer"
                    label="Fax"
                    type="text"
                    v-model="data"
                    dense
                    outlined
                    filled >
                </v-text-field>
            </v-flex>

            <v-flex xs12 >
                <v-text-field
                    color="cyan darken-3"
                    prepend-inner-icon="mdi-whatsapp"
                    label="Whatsapp"
                    type="text"
                    v-model="data"
                    dense
                    outlined
                    filled >
                </v-text-field>
            </v-flex>

            <v-flex xs12 >
                <v-text-field
                    color="cyan darken-3"
                    prepend-inner-icon="mdi-tablet-dashboard"
                    label="Sitio Web"
                    type="text"
                    v-model="data"
                    dense
                    outlined
                    filled >
                </v-text-field>
            </v-flex>

            <v-flex xs12 >
                <v-text-field
                    color="cyan darken-3"
                    prepend-inner-icon="mdi-facebook"
                    label="Facebook"
                    type="text"
                    hint="Ej: https://www.facebook.com/desdecasa.com"
                    v-model="data"
                    dense
                    outlined
                    filled >
                </v-text-field>
            </v-flex>

            <v-flex xs12 >
                <v-text-field
                    color="cyan darken-3"
                    prepend-inner-icon="mdi-twitter"
                    label="Twitter"
                    type="text"
                    hint="Ej: @desdecasa.com"
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
                    prepend-inner-icon="mdi-instagram"
                    label="Instagram"
                    type="text"
                    hint="Ej: @desdecasa.com"
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
                    prepend-inner-icon="mdi-youtube"
                    label="Youtube"
                    type="text"
                    hint="Ej: https://www.youtube.com/channel/UCeG2aGmZ2"
                    :rules="rules.required"
                    v-model="data"
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

import AppRules from "~/mixins/AppRules"; 

export default {
     mixins:[AppRules],
    data(){
        return{
            data: null,
            select: null,
            selects: {
                tipoEmpresa: [
                    { id: 1, nb_tipo_empresa: 'Sede Física'},
                    { id: 2, nb_tipo_empresa: 'Tienda Virtual (Solo Medios Digitales)'},
                    { id: 3, nb_tipo_empresa: 'Solo Servicio a Domicilio (No posee Sede Física)'}
                ],
                tipoPago: [
                    { id: 1, nb_tipo_pago: 'Visa'},
                    { id: 2, nb_tipo_pago: 'Mastercard'},
                    { id: 3, nb_tipo_pago: 'Efectivo'},
                    { id: 3, nb_tipo_pago: 'Debito'},
                    { id: 3, nb_tipo_pago: 'Criptomoneda'},
                    { id: 3, nb_tipo_pago: 'Paypal'}
                ]
            },
            
        }
    }
}
</script>

<style>

</style>