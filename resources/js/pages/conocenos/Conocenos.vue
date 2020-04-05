<template>
    <div class="pt-5 px-3 holder"> 
    
    <v-card color="rgba(0,0,0,0.3) " dark class="mx-auto mt-5 pa-3"  max-width="1000">

      <v-card-title class="mb-4 display-1">
        Conocenos
      </v-card-title>

      <v-card-subtitle >
        <h3>Mision</h3>
      </v-card-subtitle>

      <p class="mx-4 mt-4 text-justify">
        Mediante el compromiso, la ética y el profesionalismo “Desde Casa web” se enfocará en
        entregar a la sociedad una herramienta que permita acercar a los pequeños comercios de barrio, 
        un servicio comunitario dispuesto a apoyarse en estos tiempos donde la economía en el mundo está cambiando. 
        Implementando el marketing solidario podremos apoyar a los pequeños comerciantes.
      </p>

      <v-card-subtitle >
        <h3>Vision</h3>
      </v-card-subtitle>

      <p class="mx-4 mt-4 text-justify">
          Ser, para el 2021, la red social de comercios de barrios más influyente, 
          permitiéndole a cada uno de sus miembros surgir y crecer en medio de la crisis, 
          convirtiéndonos en la principal opción para la resolución de las necesidades básicas de consumo, 
          a través de las diferentes herramientas que ofrece el universo digital
      </p>

  </v-card>
  </div>
</template>

<script>
export default {

    data () 
	{
        return {
            show: true,
            logo: require('~/assets/img/publicidad/publicidad1.jpg'),
        }
    },

}
</script>

<style>

</style>