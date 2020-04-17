<template>
<div class="text-xs-center">
    <v-dialog
        v-model="showDialog"
        width="320"
    >
    <template v-slot:activator="{ on }">
        <v-btn icon v-on="on">
            <v-icon >account_circle</v-icon>
        </v-btn>
    </template>

    <v-card :loading="loading">
        <v-card-title
            class="headline grey lighten-2"
            primary-title
        >
            {{user.nb_nombre}}
            <v-spacer></v-spacer>
                <v-btn icon x-small  color="red" dark @click="showDialog = false"><v-icon>mdi-close-circle</v-icon></v-btn> 
        </v-card-title>

        <v-list two-line subheader>
            <v-list-item>
                <v-list-item-avatar>
                    <v-icon :class="[iconClass]">mdi-account</v-icon>
                </v-list-item-avatar>

                <v-list-item-content>
                    <v-list-item-title>Usuario</v-list-item-title>
                    <v-list-item-subtitle>
                        {{ user.nb_usuario }}
                    </v-list-item-subtitle>
                </v-list-item-content>

                <v-list-item-action>
                <v-btn icon ripple>
                    <v-icon color="grey lighten-1">info</v-icon>
                </v-btn>
                </v-list-item-action>
            </v-list-item>
            <v-list-item>
                <v-list-item-avatar>
                    <v-icon :class="[iconClass]">mail</v-icon>
                </v-list-item-avatar>

                <v-list-item-content>
                    <v-list-item-title>E-mail</v-list-item-title>
                    <v-list-item-subtitle>
                        {{ user.tx_email }}
                    </v-list-item-subtitle>
                </v-list-item-content>

                <v-list-item-action>
                <v-btn icon ripple>
                    <v-icon color="grey lighten-1">info</v-icon>
                </v-btn>
                </v-list-item-action>
            </v-list-item>
            
        </v-list>

        <v-divider></v-divider>

        <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn
            color="primary"
            text
            :loading="loading"
            @click="logout()" >
            <v-icon>mdi-logout-variant</v-icon>
            Cerrar Sesion
        </v-btn>
        </v-card-actions>
    </v-card>
    </v-dialog>
</div>
</template>

<script>
    export default {
        data () {
            return {
                showDialog: false,
                iconClass:'grey lighten-1 white--text',
                loading: false
            }
        },
        computed:
        {
            user(){
                return this.$store.getters['getUser']
            }
        },

        methods: 
        {
            logout()
            {
                this.loading = true
            
                this.$store.dispatch('logout')
                .then(response => {
                
                    if(response.status == 200)
                    {
                        this.showMessage(response.data)
                        this.$router.push('/').catch(()=>{});
                    }

                }).catch(error =>
                {
                    console.log(error);
                })
                .then(() => 
                {
                    this.loading = false
                })

            }
        }
    }
</script>