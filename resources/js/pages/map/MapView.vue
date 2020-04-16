<template>
<div>
    <v-card max-width="400" max-height="400">

        <app-map  :accessToken="accessToken" :mapStyle="mapStyle" :center="center" :zoom="zoom" @click="addMark($event)"> 
            
            
            <template v-for="(coordinate, index) in coordinates" >
                <map-marker :coordinates="coordinate" color="blue" draggable @dragend="moveMark($event)" :key="index"> 
                    <map-popup>
                        <app-comercio :comercio="comercio"></app-comercio>
                    </map-popup>
                </map-marker>
            </template>

            <MglNavigationControl position="top-right" />
            <MglScaleControl position="bottom-left" />

        </app-map>

        <v-card-text>
            <p v-if="coordinates[0]">
              <v-icon>mdi-map-marker</v-icon>
               longitud {{coordinates[0][0].toFixed(5)}} Latitud: {{coordinates[0][1].toFixed(5)}}
            </p>
        </v-card-text>

    </v-card>
    <!-- Contenedor de  Filtros -->
    <v-navigation-drawer :value="true" app clipped right class="grey lighten-5">
        <app-filters></app-filters> 
    </v-navigation-drawer>

</div>
       
   
</template>

<script>

import  Mapbox from "mapbox-gl";
import { MglMap, MglMarker, MglPopup, 
MglAttributionControl,
  MglNavigationControl,
  MglGeolocateControl,
  MglFullscreenControl,
  MglScaleControl } from "vue-mapbox";
import AppComercio from '@components/comercio/AppComercio';

export default {
    name: 'map-location',
    components: {
       'app-map'      :  MglMap,
       'map-marker'   :  MglMarker, 
       'map-popup'    :  MglPopup,
       'app-comercio' :  AppComercio,
       MglAttributionControl,
MglNavigationControl,
MglGeolocateControl,
MglFullscreenControl,
MglScaleControl,
    },
    data() 
    {
       return {
            accessToken: 'pk.eyJ1IjoibHl1c3RpeiIsImEiOiJjazZ0aGpzNjUwYW9qM2ZxaWxvY291b2x2In0.W4RUOc_RspaFduFD1XOxjA', 
            mapStyle: 'mapbox://styles/mapbox/streets-v11',
            center: [ -76.5545206, 3.4549987 ], //3.4549987,-76.5545206  -76.5050675, 3.3984891
            mapbox: '',
            zoom : 15.75,
            coordinates:[
                //[-76.5570788, 3.4541425],
            ],
              //3.4541425,-76.5570788  //cali 10,97 lat3.4314 lon-76.5231
            comercio: {
                foto: [ {tx_src: 'mercado5.jpg'} ],
                nb_comercio:    'Mercado Aguacatal',
                tx_direccion:   'Av 5 Oeste',
                tx_hora_inicio: '7:00AM',
                tx_hora_fin:    '5:30PM',
                tx_telefono:    '05702125437',
                nu_valoracion:  5
            }
        };
    },
    created() {
        // We need to set mapbox-gl library here in order to use it in template
        this.mapbox = Mapbox;

        if ("geolocation" in navigator) {
  navigator.geolocation.getCurrentPosition(function(position) {
  console.log(position.coords.latitude, position.coords.longitude);
});
} else {
  /* la geolocalización NO está disponible */
}
    },
    methods:
    {
        addMark(marca)
        {
            console.log(marca, marca.mapboxEvent.lngLat)
            
            this.coordinates = [];
    
            let lngLat = marca.mapboxEvent.lngLat
            this.coordinates.push([lngLat.lng, lngLat.lat]);
        },

        moveMark(marca)
        {
            console.log(marca.marker._lngLat, marca.mapboxEvent)

            this.coordinates = [];
            let lngLat = marca.marker._lngLat
            this.coordinates.push([lngLat.lng, lngLat.lat]);
        }
    }



/**
 var geojson = {
  type: 'FeatureCollection',
  features: [{
    type: 'Feature',
    geometry: {
      type: 'Point',
      coordinates: [-77.032, 38.913]
    },
    properties: {
      title: 'Mapbox',
      description: 'Washington, D.C.'
    }
  },
  {
    type: 'Feature',
    geometry: {
      type: 'Point',
      coordinates: [-122.414, 37.776]
    },
    properties: {
      title: 'Mapbox',
      description: 'San Francisco, California'
    }
  }]
};

// add markers to map
geojson.features.forEach(function(marker) {

  // create a HTML element for each feature
  var el = document.createElement('div');
  el.className = 'marker';

  // make a marker for each feature and add to the map
  new mapboxgl.Marker(el)
    .setLngLat(marker.geometry.coordinates)
    .addTo(map);
});

new mapboxgl.Marker(el)
  .setLngLat(marker.geometry.coordinates)
  .setPopup(new mapboxgl.Popup({ offset: 25 }) // add popups
    .setHTML('<h3>' + marker.properties.title + '</h3><p>' + marker.properties.description + '</p>'))
  .addTo(map);
 */

 /*
 
 unction geo_success(position) {
  do_something(position.coords.latitude, position.coords.longitude);
}

function geo_error() {
  alert("Sorry, no position available.");
}

var geo_options = {
  enableHighAccuracy: true, 
  maximumAge        : 30000, 
  timeout           : 27000
};

var wpid = navigator.geolocation.watchPosition(geo_success, geo_error, geo_options);
  */
}
</script>

<style>

.mgl-map-wrapper
{
    height: 400px !important;
    width: 400px !important;
}

</style>