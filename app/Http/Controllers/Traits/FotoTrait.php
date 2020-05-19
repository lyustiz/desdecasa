<?php

namespace App\Http\Controllers\Traits;
use App\Models\Foto;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

trait FotoTrait
{
    static protected $nroImages = 3;
    static protected $imagesExists = [];

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    static public function store(array $data)
    {
        $validate = Validator::make($data,[

            'nb_foto'           => 'nullable|max:80',
            'tx_src'            => 'required',
            'id_tipo_foto'      => 'required|integer',
            'id_comercio'       => 'required|integer',
            'tx_observaciones'  => 'nullable|max:100',
            'id_status'         => 'required',
            'id_usuario'        => 'required',

        ])->validate();

        $foto = Foto::create($data);

        return [ 'msj' => 'Foto Agregada Correctamente', 'foto' => $foto ];
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    static public function storeAll(array $data)
    {
        $fotos = [];
        $foto  = [];
        
        $imageNames = self::storeImage( $data['fotos'], $data['id_comercio']);

        foreach ($data['fotos'] as $key => $source) {


            
            $foto = self::store([
                'nb_foto'           => $imageNames[$key],
                'tx_src'            => $imageNames[$key],
                'id_tipo_foto'      => 1,
                'id_comercio'       => $data['id_comercio'],
                'tx_observaciones'  => null,
                'id_status'         => 1,
                'id_usuario'        => $data['id_usuario'],
            ]);

            $fotos[] = ['tx_src' => $imageNames[$key]];
        }

        return $fotos;
    }


    static public function storeImage($images, $id_comercio)
	{
        $imageNames = [];

        foreach ( $images as $key => $image ) {
            
            if( substr( $image, 0, 4 ) == 'data' ) 
            {
                for ( $i=1 ; $i <= self::$nroImages ; $i++ ) {
            
                    $imageName = "$id_comercio-$i.jpg";
    
                    if( !in_array($imageName, self::$imagesExists) )
                    {
                        break;
                    }
                }
                
                $srcImage  = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));
                                                         
                $stored = Storage::disk('commerce')->put($imageName, $srcImage);

                self::$imagesExists[] = $imageName;

                $imageNames[] = $imageName;

            }else{

                $imageNames[] = $image;
            }
        }
        
        return $imageNames;
    }




    static public function imageName($source, $id_comercio)
    {
      
        if( substr( $source, 0, 4 ) != 'data' ) //devolver imagenes almacenadas
        {
            return $source;
            
        } else {

            for ( $i=1 ; $i <= self::$nroImages ; $i++ ) {
            
                $imageName = "$id_comercio-$i.jpg";

                if( !in_array($imageName, $imagesExists) )
                {
                    return $imageName;
                }
            }
        }
        return response()->json(['error' => 'error al cargar imagenes'], 500);
    }

    


    


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Foto $foto)
    {
        $validate = request()->validate([

            'nb_foto'           => 'nullable|max:80',
            'tx_src'            => 'required',
            'id_tipo_foto'      => 'required|integer',
            'id_comercio'       => 'required|integer',
            'tx_observaciones'  => 'nullable|max:100',
            'id_status'         => 'required',
            'id_usuario'        => 'required',

        ]);
        
        $foto = $foto->update($request->all());

        return [ 'msj' => 'Registro Editado' , compact('foto')];
    
    }

    static public function replaceAll(array $data)
    {
        $query = Foto::select('tx_src')->where('id_comercio', $data['id_comercio']);

        $fotos = $query->get();

        $query->delete();

        self::imagesExists($fotos, $data['fotos']);

        $fotos    = self::storeAll($data);

        return $fotos;
    }

    // retorna images existentes
    static public function imagesExists($ImagesOld, $ImagesNew)
    {
        foreach ($ImagesOld as $old) 
        {
            foreach ($ImagesNew as $new) 
            {
                if( $old->tx_src == $new )
                {
                    self::$imagesExists[] = $old->tx_src;
                }
            }
        }
    }

    
    public function deleteImageFiles( $images )
    {
        foreach ( $images as $path) {
            
            if( substr( $path, 0, 4 ) != 'data' ) //solo borrar imagenes almacenadas
            {
                Storage::disk('commerce')->delete(path);
            }
        }
    }

   


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    static public function destroy(Foto $foto)
    {
        $foto = $foto->delete();
 
        return [ 'msj' => 'Registro Eliminado' , compact('foto')];

    }


   
}
