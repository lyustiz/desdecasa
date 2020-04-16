<template>
    <v-form v-model="valid" ref="form" >
    <v-card class="mx-auto" max-width="400">
        <v-card-title >
            Actualizar Email
        </v-card-title>
        <v-card-text>

            <v-flex xs12 >
                <v-text-field
                    color="cyan darken-3"
                    prepend-inner-icon="mdi-email"
                    label="Correo Actual"
                    type="text"
                    v-model="form.tx_email"
                    :rules="rules.required"
                    readonly
                    dense
                    outlined
                    filled >
                </v-text-field>
            </v-flex>

            <v-flex xs12 >
                <v-text-field
                    color="cyan darken-3"
                    prepend-inner-icon="mdi-email-edit"
                    label="Nuevo Correo"
                    type="text"
                    v-model="form.tx_new_email"
                    :rules="rules.email"
                    dense
                    outlined
                    filled >
                </v-text-field>
            </v-flex>

            <v-flex md12 xs12>
                <v-text-field
                    color="cyan darken-3"
                    prepend-inner-icon="mdi-email-edit"
                    label="Reescribir Correo"
                    type="text"
                    v-model="form.tx_ret_email"
                    :rules="rules.email_confirmation"
                    dense
                    outlined
                    filled  >
                </v-text-field>
            </v-flex>
            
        </v-card-text>
        <v-card-actions>
              <v-spacer></v-spacer>
              
              <v-btn small dark fab color="amber" @click="cancel()" > <v-icon>mdi-restore</v-icon></v-btn>
              <v-btn small dark fab color="primary" @click="update()"> <v-icon>mdi-content-save</v-icon></v-btn>
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
        this.fetch();
    },

    computed: 
    {
        getIduser()
        {
            this.$store.getters['getUserid']
        }
    },

    data()
    {
        return{
            resource: 'usuario', 
            form: {
                tx_email:      '',
                tx_new_email:  '',
                tx_ret_email:  '',
                id_usuario:   ''
            },
        }
    },
    methods: 
    {
        fetch()
        {
            this.form.id_usuario = this.getIduser;

            axios.get('/api/v1/' + this.resource + '/' + this.getIduser)
			.then( response =>
			{
                this.item = response.data;
                this.mapForm()
			})
            .catch( error =>
            {
              console.log(error)
            })
            
        },

        update()
        {
            if (!this.$refs.form.validate())  return 

            this.loading = true;
            this.form.id_usuario = this.getIduser;
            
            axios.put('/api/v1/' + this.resource + '/email/' + this.getIduser, this.form)
			.then( response =>
			{
                this.showMessage(response.data.msj)
                this.item.tx_email = this.form.tx_new_email;
                this.reset();
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

        cancel()
        {
            let email = this.item.tx_email

            this.clear()
            
            this.form.tx_email  = email;
        }

        
    }
}
</script>

<style>

</style>