<template>
<v-container fluid>

    <v-card class="map-card">
        
        <app-map  
            :accessToken="accessToken" 
            :mapStyle="mapStyle" 
            :center="center" 
            :zoom="zoom" 
            :minZoom="minZoom"
            :maxZoom="maxZoom"
            @load="onMapLoaded"> 
             
            <map-marker 
                v-for="(comercio, index) in comercios" 
                :coordinates="[ comercio.tx_longitud, comercio.tx_latitud ]" 
                :color="(comercio.bo_abierto == 1) ? 'green' : 'red'"   
                :key="index"> 
                <map-popup>
                    
                    <card-comercio :comercio="comercio"></card-comercio>

                </map-popup>
            </map-marker>

            <map-layer 
                v-for="(source, index) in sources" 
                :key="index+1"
                :source="source"
                sourceId="comuna"
                layerId="comuna"
                :layer="layer"
            ></map-layer>
        
        </app-map>

    </v-card>

    <!-- Contenedor de  Filtros -->
    <v-navigation-drawer :value="true" app clipped right class="grey lighten-5">
        <app-filters></app-filters> 
    </v-navigation-drawer>

</v-container>
</template>

<script>

import  Mapbox from "mapbox-gl";
import {    MglMap, 
            MglMarker, 
            MglPopup, 
            MglGeojsonLayer  
        } from "vue-mapbox";
import CardComercio from './CardComercio'

export default {
    name: 'map-view',
    components: {
       'app-map'      :  MglMap,
       'map-marker'   :  MglMarker, 
       'map-popup'    :  MglPopup,
       'map-layer'    :  MglGeojsonLayer,
       'card-comercio':  CardComercio
    },

    created() 
    {
        this.mapbox = Mapbox;
        this.mapScope = null
    },

    computed: 
    {

        comercios()
        {
            return this.$store.getters['getComercios'];
        },

        countComercios()  
        {
            return  this.$store.getters['countComercios'];
        }
    },

    data() 
    {
       return {
            accessToken:'pk.eyJ1IjoibHl1c3RpeiIsImEiOiJjazZ0aGpzNjUwYW9qM2ZxaWxvY291b2x2In0.W4RUOc_RspaFduFD1XOxjA', 
            mapStyle:   'mapbox://styles/mapbox/streets-v11', 
            center:     [ -76.5231, 3.4314 ],
            mapbox:     '',
            zoom :      10.97,
            minZoom:    12,
            maxZoom:    15,
            coordinates:[
                [ -76.5231, 3.4314 ],
                [ -76.5231, 3.4414 ],
                [ -76.5331, 3.4314 ],
                [ -76.5231, 3.4514 ],
            ],
            sources:    [],
            layer:  {
                    'id': 'comuna',
                    'type': 'fill',
                    'source': 'comuna',
                    'paint': {
                        'fill-color': '#F66546',
                        'fill-opacity': 0.3
                    }
            }
        }
    },
    
    methods:
    {
        onMapLoaded(event)
        {
            if(this.hasComuna)
            {
                let center = this.comunas.filter(item => item.id == this.comuna)

                if(center.length > 0)
                {
                    center = [ parseFloat(center[0].tx_longitud), parseFloat(center[0].tx_latitud) ]
                    let mapScope = event.map;
                    mapScope.easeTo({center: center, zoom: 13})
                    this.mapScope = event.map;
                }

                this.sources.push(require('~/assets/geo/comuna'+this.comuna+'.json'))
                
                if( this.setLatLon != [0,0] )
                {
                    this.coordinates.push([ parseFloat(this.setLatLon[0]), parseFloat(this.setLatLon[1])]);
                }
            }else{
                this.mapScope = event.map;
            }
        },
        
    }



/**
 if ("geolocation" in navigator) {
  navigator.geolocation.getCurrentPosition(function(position) {
  console.log(position.coords.latitude, position.coords.longitude);
  */
}
</script>

<style >

.mgl-map-wrapper
{
    height: 600px !important;
    width: 80vw !important;
}

.map-card
{
  height: 89.5vh !important;
}


</style>