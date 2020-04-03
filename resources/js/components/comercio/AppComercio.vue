<template>

   <v-card class="ma-3">

        <v-img class="white--text align-end" height="200px" :src="`images/${comercio.tx_foto}.jpg`"></v-img>
        
        <v-card-title> 
            <v-icon>mdi-storefront</v-icon> {{ comercio.tx_nombre }}  
        </v-card-title>
        
        <v-card-text>
            
            <p class="caption"> 
                <v-icon>mdi-map-marker</v-icon>  {{ comercio.tx_direccion }}
            </p>

            <p> 
                <v-icon>mdi-clock</v-icon> 
                <v-chip color="green" text-color="white" small>{{ comercio.tx_hora_inicio }}</v-chip>
                <v-chip color="red" text-color="white" small>{{ comercio.tx_hora_fin }}</v-chip>
            </p>

            <p> 
                <v-icon>mdi-phone</v-icon> 
                
                <v-btn link  :href="comercio.tx_telefono" target="_blank" text>
                    {{ comercio.tx_telefono }}
                </v-btn>

                <v-btn link  :href="`https://wa.me/${comercio.tx_telefono}`" target="_blank" icon >
                    <v-icon color="green">mdi-whatsapp</v-icon>
                </v-btn>
            </p>
            
        </v-card-text>
        
        <v-card-actions>

            <v-badge bordered color="info" overlap :content="comercio.nu_valoracion">
                <v-btn icon color="primary">
                    <v-icon>mdi-message-plus-outline</v-icon>
                </v-btn>
            </v-badge>
            
            <v-spacer></v-spacer>

            <span>({{ comercio.nu_valoracion }}-5)</span>

            <v-rating
                v-model="comercio.nu_valoracion"
                color="amber"
                background-color="amber"
                dense
                hover
                ripple
            ></v-rating>
           
        </v-card-actions>
    </v-card>
</template>

<script>

export default 
{
    props:
    {
        comercio:{
            type:       Object,
            default:    null
        },
    },
    data () 
	{
        return {
            rating: 0,
        }
    },
}
</script>
