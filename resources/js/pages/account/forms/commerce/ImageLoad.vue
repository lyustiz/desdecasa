<template>

        <v-card class="mx-rigth pa-2" outlined >
            
        <v-sheet color="grey lighten-5 py-2 px-1 ">
            
            <template v-for="(image, idx) in images">
                <v-hover v-slot:default="{ hover }" :key="idx">
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

            <v-avatar color="grey lighten-2" :width="width" :height="height" tile v-if="!topItems">

                <v-file-input 
                    accept="image/*" 
                    capture="camera" 
                    v-model="files" 
                    color="purple"
                    prepend-icon="mdi-image-search" 
                    class="col-1 mr-5 mb-2">
                    <template v-slot:selection></template>
                </v-file-input>
                
            </v-avatar>

            <v-input readonly dense :rules="[rules.imageReq]" :value="images" hide-details="auto"></v-input>
            
        </v-sheet>


        <v-dialog
            v-model="crop"
            fullscreen 
            persistent 
            transition="dialog-transition"
            overlay-color="grey"
        >
            <v-container class="">

                <v-card class="col-10 mx-auto">

                    <cropper 
                        
                        v-if="crop"
                        classname="cropper"
                        :src="ImgCroppable"
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

        nroItems:{
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
        }

    },


    computed: 
    {
        topItems()
        {
            return this.images.length >= this.nroItems
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
                    
                    this.ImgCroppable = reader.result;
                    
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
            files:          null,
            images:         [],
            ImgCroppable:   null,
            crop:           false,
            loading:        true,
        }
    },
    methods:
    {
        removeImage(index)
        {
            this.images = this.images.filter(function (item, idx) {
                return (idx != index)
            })
        } , 
        
        cropImage() {

            const {coordinates, canvas} = this.$refs.cropper.getResult()
            this.images.push(canvas.toDataURL('image/jpeg', 0.92))
            this.$refs.cropper.clearImage();
            this.crop = false
            this.ImgCroppable = null
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



        setSrc()
        {
            let fullSrc = '/storage/account/' + this.form.tx_foto
            
            if(this.form.tx_foto)
            {
                if(this.form.tx_foto.length > 0)
                {
                    this.file = { size: 10, type: 'image/jpeg', src: fullSrc, name:this.form.tx_foto }                
                }
            }
        },

        
        fileSrc()
        {
        if(this.file) {

                if(this.validImage(this.file))
                {
                    this.form.tx_foto = this.file.name;
                    let src = (this.file.src) ? this.file.src : URL.createObjectURL(this.file);

                    if(!this.file.src)
                    {
                        this.fileToSrc()
                    }

                    return  src;
                }
            }

            this.form.tx_foto = '';
            this.form.tx_src  = '';
            return 'images/account.png';
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
</style>