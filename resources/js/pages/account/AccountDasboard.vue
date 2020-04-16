<template>

  <div id="full-container" class="cyan px-3">
  <v-container fluid>
      
  <v-row >
      
      <v-col>
        <v-btn text dark>
            Administracion de la Cuenta
        </v-btn>
      </v-col>
      
  </v-row>

  <v-divider dark></v-divider>

  <v-row>
      
      <template v-for="(card, i) in cardSections" >
     
        <v-col :md="card.cols" :key="i" v-if="card.visible" >

            <card-sections 
                :visible="card.visible"
                :expand="card.expand"
                :color="card.color"
                :title="card.title"
                :subtitle="card.subtitle"
                :icon="card.icon"
                :menuItems="card.menuItems"
                :component="card.component"
                @expand="expand(card.id)"
                @minimize="minimize(card.id)"
            ></card-sections>

        </v-col>

      </template>

    </v-row>

</v-container>
</div>

</template>

<script>

import { mapActions } from 'vuex';
import CardSection from './CardSections';

export default {
    components: 
    {
        'card-sections': CardSection
    },
    created()
    {
        let auth = this.$store.getters['getAuth'];

        if(!auth)
        {
             this.$router.push('login').catch(err => {})
        }
        
        let userID = this.$store.getters['getUserid']
        
        this.apiComercioUsuario(userID)
        .then( (response)=> {
            this.expand(2)
        })
  
    },
    data()
    {
        return {

            cardCols: 3,
            cardHeight: 180,
            display: 'd-block',
            expander: true,
            cardSections: [
                {
                    id: 1,
                    color: 'amber',
                    title: 'Cuenta',
                    subtitle: 'Configurar',
                    icon: 'mdi-account-box',
                    visible: true,
                    expand: false,
                    menuItems: [],
                    component: 'account', 
                    cols: 3
                },
                {
                    id: 2,
                    color: 'success',
                    title: 'Comercio',
                    subtitle: 'Configurar',
                    icon: 'mdi-storefront',
                    visible: true,
                    expand: false,
                    menuItems: [],
                    component: 'commerce', 
                    cols: 3
                },
                {
                    id: 3,
                    color: 'red',
                    title: 'Imagenes',
                    subtitle: 'Administrar',
                    icon: 'mdi-image',
                    visible: true,
                    expand: false,
                    menuItems: [],
                    component: 'images', 
                    cols: 3
                },
                {
                    id: 4,
                    color: 'purple',
                    title: 'Pagina Web',
                    subtitle: 'Configurar',
                    icon: 'mdi-tablet-dashboard',
                    visible: true,
                    expand: false,
                    menuItems: [],
                    component: 'webpage', 
                    cols: 3
                },
                

            ]
        }
    },
    methods: {

        ...mapActions(['apiComercioUsuario']),

        expand(cardId)
        {
            
            this.cardSections.forEach((card, index) => {
                
                if(card.id == cardId)
                {
                    this.cardSections[index].expand = true;
                    this.cardSections[index].cols = 12;
                }
                else
                {
                    this.cardSections[index].visible = false;
                }

            }, this);


        },

        minimize(cardId)
        {

            this.cardSections.forEach((card, index) => {
                
                if(card.id == cardId)
                {
                    this.cardSections[index].expand = false;
                    this.cardSections[index].cols = 3;
                }
                else
                {
                    this.cardSections[index].visible = true;
                }

            }, this);
            
        }
    }
}
</script>

<style>
#full-container{
    height: 100%;
    min-height: 100vh;
    width: 100%;
}
</style>

<!--  <v-divider dark :class="display"></v-divider>

        <v-col md12>
            <v-card color="ligth" :class="display">
                <v-card-title primary-title >
                    Estado de la Cuenta
                </v-card-title>
                <v-divider></v-divider>
                <v-card-text>
                    <v-list>
                        <v-list-tile avatar>
                            Numero de Visitas <v-chip >53.000</v-chip>
                        </v-list-tile>
                    </v-list>
                    <v-list>
                        <v-list-tile avatar>
                            Reseñas <v-chip >255</v-chip>
                        </v-list-tile>
                    </v-list>

                    <v-list>
                        <v-list-tile avatar>
                            Valoracion 
                            <v-chip >255</v-chip> 
                            <v-rating
                                value="5"
                                color="amber"
                                background-color="amber"
                                dense
                                hover
                                ripple
                            ></v-rating>
                        </v-list-tile>
                    </v-list>
                </v-card-text>
            </v-card>
        </v-col>  -->


