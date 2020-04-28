<template>
    <div>
    <v-carousel
        cycle
        :height="cardHeight"
        hide-delimiter-background
        show-arrows-on-hover
        class="elevation-3 list-publicidad"
    >
        <v-carousel-item
            v-for="(item, i) in publicidad"
            :key="i"
            :src="item.src"
            class="list-publicidad"
        >
        </v-carousel-item>

    </v-carousel>
    </div>
</template>

<script>
export default {
    created()
    {
       this.publicidad = [ 
                            { src: this.imgSmall             },
                            { src: '/images/publicidad3.jpg' }
                        ];
    },
    computed:{
        imgSmall()
        {
            return ( this.$vuetify.breakpoint.xsOnly) ? '/images/publicidad1-m.jpg' : '/images/publicidad1.jpg'
        },
        cardHeight()
        {
            return ( this.$vuetify.breakpoint.xsOnly) ? '265' : '320'
        }
    },
    data() {
        return{
            publicidad: [ ],
        }
    },
    

}
</script>

<style>
.list-publicidad .v-image__image {
    border-radius: 20px;
}

.list-publicidad {
    border-radius: 20px;
}
</style>