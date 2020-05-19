<template>
    <v-row>

        <v-col cols="12" md="6">
            <v-card min-height="240">

            <v-card-title class="green white--text my-2 py-2">

                <span class="body-1 mx-2">Status del Usuario:</span>

                <v-spacer></v-spacer> 

                <v-chip class="mx-2">
                    <v-avatar left>
                        <v-icon>mdi-account-circle</v-icon>
                    </v-avatar>
                    {{user.nb_usuario}}
                    <v-tooltip bottom :color="allColor(userAll())" open-on-click>
                        <template v-slot:activator="{ on }">
                            <v-avatar v-on="on" right >
                                <v-icon :color="allColor(userAll())">{{ allIcon(userAll())}}</v-icon>
                            </v-avatar>
                        </template>
                        <span>{{allMsj(userAll())}}</span>
                    </v-tooltip>
                </v-chip>

            </v-card-title>

            <v-card-text>
                <v-row no-gutters>
                    <v-col cols="12"><v-icon :color="dataColor(user.nb_nombres)">{{ dataIcon(user.nb_nombres)}} </v-icon> Informacion Personal</v-col>
                    <v-col cols="12"><v-icon :color="dataColor(user.tx_foto)">{{ dataIcon(user.tx_foto)}} </v-icon> Foto</v-col>
                </v-row>
            </v-card-text>
            </v-card>

        </v-col>

        <v-col cols="12" md="6">

            <v-card min-height="240">

            <v-card-title class="green white--text my-2 py-2">
                
                <span class="body-1 mx-2">Status del Comercio:</span>

                <v-spacer></v-spacer>

                <v-chip class="mx-2">
                    <v-avatar left>
                        <v-icon>mdi-storefront</v-icon>
                    </v-avatar>
                    {{commercio.nb_comercio}}
                    <v-tooltip bottom :color="allColor(comercioAll())" open-on-click>
                        <template v-slot:activator="{ on }">
                            <v-avatar right v-on="on">
                                <v-icon :color="allColor(comercioAll())">{{ allIcon(comercioAll())}}</v-icon>
                            </v-avatar>
                        </template>
                        <span>{{allMsj(comercioAll())}}</span>
                    </v-tooltip>
                </v-chip>
            
            </v-card-title>

            <v-card-text>
                <v-row no-gutters>
                    <v-col cols="12"><v-icon :color="dataColor(commercio.tx_nit)">{{ dataIcon(commercio.tx_nit)}} </v-icon> Informacion General</v-col >
                    <v-col cols="12"><v-icon :color="dataColor(commercio.foto)">{{ dataIcon(commercio.foto)}} </v-icon> Foto del Comercio</v-col >
                    <v-col cols="12"><v-icon :color="dataColor(commercio.id_zona)">{{ dataIcon(commercio.id_zona)}} </v-icon> Ubicacion</v-col >
                    <v-col cols="12"><v-icon :color="dataColor(commercio.contacto)">{{ dataIcon(commercio.contacto)}} </v-icon> Contacto</v-col >
                    <v-col cols="12"><v-icon :color="dataColor(commercio.horario)">{{ dataIcon(commercio.horario)}} </v-icon> Horarios</v-col >
                    <v-col cols="12"><v-icon :color="dataColor(commercio.telefono)">{{ dataIcon(commercio.telefono)}} </v-icon> Telefonos</v-col >
                    <v-col cols="12"><v-icon :color="dataColor(commercio.comercio_categoria)">{{ dataIcon(commercio.comercio_categoria)}} </v-icon> Categorias</v-col >
                </v-row>
            </v-card-text>
            
            </v-card>

        </v-col>

    </v-row>
   
</template>

<script>
export default {

    computed: {

        user() {
           return this.$store.getters['getUser']
        },
        commercio() {
           return this.$store.getters['getComercio']
        }
        
    },
    methods: 
    {
        dataIcon(data)
        {
           return ( Array.isArray(data) ? data.length > 0 : data ) ? 'mdi-check' : 'mdi-close' 

        },

        dataColor(data)
        {
           
           return ( Array.isArray(data) ? data.length > 0 : data ) ? 'green' : 'red' 

        },

        allIcon(data)
        {
           return (data) ? 'mdi-check-circle' : 'mdi-alert-circle' 

        },

        allColor(data)
        {
          
          return (data) ? 'success' : 'warning' 

        },

        allMsj(data)
        {
          
          return (data) ? 'Configuracion Completa' : 'Existen items Pendientes favor Revisar' 

        },

        userAll()
        {
           return (this.user.nb_nombres && this.user.tx_email && this.user.fe_nacimiento && this.user.tx_sexo && this.user.tx_foto)
        },

        comercioAll()
        {
            return  this.commercio &&
                    this.commercio.foto.length  > 0  &&
                    this.commercio.horario.length  > 0  &&
                    this.commercio.zona != null  &&
                    this.commercio.contacto != null  &&
                    this.commercio.telefono.length > 0 &&  
                    this.commercio.comercio_categoria.length > 0  
        }
    }
}
</script>

<style>

</style>