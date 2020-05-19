<template>

    <v-card class="mx-rigth pa-2 image-container" outlined ref="imageContainer">
            
        <v-sheet color="grey lighten-5" class="py-2 px-1 " :height="height+18" :width="( width *(images.length + 1) ) + ((images.length + 1) * 8 )">
            
            <!-- Image Item -->
            <template v-for="(image, idx) in images" >
                <v-hover v-slot:default="{ hover }" :key="idx" >
                <v-expand-x-transition>
                <v-avatar  :width="width" :height="height" tile class="ml-1">
                    <v-img :src="image">
                        <v-scale-transition>
                            <v-icon v-if="hover" color="white" class="pointer" size="48" @click="removeImage(idx)">mdi-close-circle-outline</v-icon>
                        </v-scale-transition>
                    </v-img>
                </v-avatar>
                </v-expand-x-transition>
                </v-hover>
            </template>

            <!-- Image Add -->
            <v-avatar color="grey lighten-2" :width="width" :height="height" tile v-if="!topItems" id="addImage">
                <v-file-input 
                    accept="image/*" 
                    :capture="capture" 
                    v-model="files" 
                    color="purple"
                    prepend-icon="mdi-image-search" 
                    class="col-1 mr-5 mb-2">
                    <template v-slot:selection></template>
                </v-file-input>
            </v-avatar>

            <!-- input (permite valiar Imagenes) -->
            <v-input readonly dense :rules="[rules.imageReq]" :value="images" hide-details="auto"></v-input>
        
        </v-sheet>

        <!-- Cropper Tool -->
        <v-dialog
            v-model="crop"
            fullscreen 
            persistent 
            transition="dialog-transition"
            overlay-color="grey"
        >
            <v-container>

                <v-card class="col-10 mx-auto">

                    <cropper 
                        
                        v-if="crop"
                        classname="cropper"
                        :src="rawImg"
                        :stencil-props="{
                            aspectRatio: aspectRatio
                        }"
                        ref="cropper"
                    ></cropper>
                    
                    <v-btn fab top right absolute @click="cropImage" color="success" class="mt-12">
                        <v-icon>mdi-crop</v-icon>
                    </v-btn>

                    <v-btn fab top left absolute @click="crop=false" color="error" class="mt-12">
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                    
                </v-card>
                
            </v-container>
            
        </v-dialog>
            
    </v-card> 
    
</template>

<script>
import AppForm from '@mixins/AppForm'
import { Cropper } from 'vue-advanced-cropper'

export default {

    components: {
		Cropper
    },
    
    mixins: [ AppForm ],

    props: {

        nroImages:{
            type:      Number,
            default:    1
        },

        width:{
            type:       Number,
            default:    166.5
        },

        height:{
            type:       Number,
            default:    100
        },

        aspectRatio: {
            type:       Number,
            default:    333/200
        },

        capture: {
            type:       Boolean,
            default:    false
        },

        imagesIn: {
            type:       Array,
            default:    () => []
        },

        imagePath: {
            type:       String,
            default:    false
        },

    },

    created()
    {
        if( this.imagesIn.length > 0 )
        {
            this.images = []

            for (const image of this.imagesIn) 
            {
                this.images.push( this.imagePath + image )
            }
        }
    },

    computed: 
    {
        topItems()
        {
            return this.images.length >= this.nroImages
        }
    },

    watch:
    {
        files(file)
        {
            if(file)
            {
                let reader = new FileReader();

                reader.readAsDataURL(file);

                reader.onprogress = () => 
                {
                    this.loading = true
                }

                reader.onload = () => 
                {
                    this.loading = false
                    
                    this.rawImg = reader.result;
                    
                    this.crop = true

                    this.files = null 
                };

                reader.onerror = () => 
                {
                   this.showError({ msj: 'error al intentar cargar imagen'})
                };

            }
        }
    },
    data() 
    {
        return {
            files:    null,
            images:   [],
            rawImg:   null,
            crop:     false,
            loading:  true,
        }
    },
    methods:
    {
        removeImage(index)
        {
            this.images = this.images.filter( (item, idx) => (idx != index))

            this.$emit('updateImages', this.images)

            this.focusAdd()
        }, 
        
        cropImage() 
        {
            const { canvas } = this.$refs.cropper.getResult()
            this.images.push(canvas.toDataURL('image/jpeg', 0.92))
            this.$emit('updateImages', this.images)

            this.crop   = false
            this.rawImg = null
            this.focusAdd()
        },

        focusAdd()
        {
            var container = this.$refs.imageContainer.$el;
            
            if(this.images.length == 0 )
            {
                container.scrollLeft  = 0
            } else
            {
                container.scrollLeft  += this.width;
            }
        },
        
        validImage(image)
        {
            let size = image.size / 1024  ; //kilobites
            let type = image.type.split('/');
            let imageType = ['jpeg', 'png', 'bmp'];

            const fileTypes = [
                "image/apng",
                "image/bmp",
                "image/gif",
                "image/jpeg",
                "image/pjpeg",
                "image/png",
                "image/svg+xml",
                "image/tiff",
                "image/webp",
                "image/x-icon"
                ];

            if(size > 0)
            {
                if(size > 2048)
                {
                    let msj = 'archivo debe ser menor de 2 MB. (Actual: '+ (size / 1024).toFixed(2) +' MB)';
                    this.showError(msj)
                    return false;
                }
            }

            if( (type[0] != 'image') || ( !imageType.includes(type[1]) ) )
            {
                let msj = 'solo se permiten imagenes con los formatos: ' + imageType;
                this.showError(msj)
                return false;
            }

        return true;
        },

    }
 
}
</script>

<style>
 .pointer{
     cursor: pointer;
 }
 .cropper {
	height: 600px;
	background: #DDD;
}
.image-container{
    overflow-x: auto;
    overflow-y: hidden;
}
</style>