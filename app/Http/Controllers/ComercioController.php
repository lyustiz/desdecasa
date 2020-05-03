<?php

namespace App\Http\Controllers;

use App\Models\Comercio;
use App\Models\ComercioCategoria;
use App\Models\Horario;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Traits\ComercioCategoriaTrait;
use App\Http\Controllers\Traits\HorarioTrait;

class ComercioController extends Controller
{
    
    use ComercioCategoriaTrait;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comercios = Comercio::with(['foto:id,tx_src', 'comercioCategoria:id,id_categoria', 'barrio:id,nb_barrio'])
                              ->select('id', 'nb_comercio', 'tx_descripcion', 'id_zona', 'tx_direccion' )
                              ->where('id_status', 1)
                              ->get();
        
        return $comercios;

    }

    /**
     * Listar Comercio por Categoria     
     *
     * @return \Illuminate\Http\Response
     */
    public function comercioCategoria($id_categoria, $tipoDespacho)
    {
  
        
        $result =  Comercio::with([
                    'comercioCategoria:id_comercio,id_categoria', 
                    'horario:nb_horario,id_comercio',
                    'telefono:id_comercio,tx_telefono,id_tipo_telefono,bo_whatsapp',
                    'comercioDespacho:id_comercio,id_zona',
                    ])
                    ->select('comercio.id',
                                'comercio.nb_comercio',
                                'comercio.tx_descripcion',
                                'comercio.tx_direccion',
                                'comercio.tx_foto',
                                'comercio.tx_longitud',
                                'comercio.tx_latitud',
                                'comercio.bo_abierto',
                                'comercio.id_departamento',
                                'departamento.nb_departamento',
                                'comercio.id_ciudad',
                                'ciudad.nb_ciudad',
                                'comercio.id_zona',
                                'zona.nb_zona',
                                'comercio.id_barrio',
                                'barrio.nb_barrio',
                                'contacto.tx_email',
                                'contacto.tx_sitio_web',
                                'contacto.tx_facebook',
                                'contacto.tx_twitter',
                                'contacto.tx_instagram',
                                'contacto.tx_youtube',
                            ) 
                    ->selectRaw('(SELECT concat(count(valoracion.id), "-", sum(valoracion.nu_valoracion)/count(valoracion.id)) 
                                    FROM valoracion 
                                    WHERE valoracion.id_comercio = comercio.id) AS nu_pc_valoracion' 
                                )
                    ->join('departamento', 'comercio.id_departamento', '=', 'departamento.id')  
                    ->join('ciudad', 'comercio.id_ciudad', '=', 'ciudad.id')  
                    ->join('zona', 'comercio.id_zona', '=', 'zona.id') 
                    ->join('barrio', 'comercio.id_barrio', '=', 'barrio.id') 
                    ->join('contacto', 'comercio.id', '=', 'contacto.id_comercio')   
                    ->where('comercio.id_status', 1)
                    ->whereHas('comercioCategoria', function (Builder $query) use ($id_categoria) {
                        $query->where('id_categoria', $id_categoria);
                    })
                    ->has('horario');
                            
        if($tipoDespacho == 'cali')
        {
            $result = $result->whereHas('comercioDespacho', function (Builder $query) {
                        $query->where('id_zona', 7);
                    })->get();
        } else {

            $result = $result->whereHas('comercioDespacho', function (Builder $query) {
                        $query->where('id_zona', '<>' , 7);
                    })->get();
        }

        return $result;
    }

    /**
     * Listar Comercio por Categoria     
     *
     * @return \Illuminate\Http\Response
     */
    public function comercioBarrio($id_barrio)
    {
        return  Comercio::select('comercio.id', 'comercio.nb_comercio') 
                        ->join('contacto', 'comercio.id', '=', 'contacto.id_comercio')  
                        ->whereNotNull('tx_foto')
                        ->where('comercio.id_barrio', $id_barrio)
                        ->where('comercio.id_status', 1)
                        ->whereHas('comercioDespacho', function (Builder $query) {
                            $query->where('id_zona', '<>', 7);
                        })
                        ->get();
    }

    /**
     * Listar Comercio por Categoria     
     *
     * @return \Illuminate\Http\Response
     */
    public function comercioSearch(Request $request )
    {
        $nb_comercio = $request->input('nombre');
        
        return  Comercio::select('comercio.id', 'comercio.nb_comercio') 
                        ->join('contacto', 'comercio.id', '=', 'contacto.id_comercio')  
                        ->whereNotNull('tx_foto')
                        ->whereRaw('LOWER(`nb_comercio`) LIKE ? ','%'.trim(strtolower($nb_comercio)).'%')
                        ->where('comercio.id_status', 1)
                        ->whereHas('comercioDespacho', function (Builder $query) {
                            $query->where('id_zona', 7);
                        })
                        ->take(20)
                        ->get();


        
    }

    /**
     * Listar Comercio por Categoria     
     *
     * @return \Illuminate\Http\Response
     */
    public function comercioUsuario($id_usuario)
    {
        $barrios =  Comercio::with([
                        'contacto:id,id_comercio,tx_email,tx_sitio_web,tx_facebook,tx_twitter,tx_instagram,tx_youtube',
                        'telefono:id,id_comercio,tx_telefono,id_tipo_telefono,bo_whatsapp',
                        'comercioCategoria:id_comercio,id_categoria', 
                        'departamento:id,nb_departamento', 
                        'ciudad:id,nb_ciudad,tx_latitud,tx_longitud',
                        'zona:id,nb_zona,tx_latitud,tx_longitud',
                        'comuna:id,nb_comuna,tx_latitud,tx_longitud',
                        'barrio:id,nb_barrio,tx_latitud,tx_longitud', 
                        'horario:nb_horario,id_comercio',
                    ])
                    ->where('id_usuario', $id_usuario)
                    ->where('id_status', 1)
                    ->first();

        return $barrios;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = request()->validate([

            'nb_comercio'       => 'required',
            'nb_fiscal'        => 'required',
            'tx_nit'           => 'required',
            'tx_descripcion'   => 'required',
            'id_departamento'  => 'required',
            'id_ciudad'        => 'required',
            'id_zona'          => 'required',
            'id_comuna'        => 'required',
            'id_barrio'        => 'required',
            'tx_direccion'     => 'required',
            'id_tipo_comercio' => 'required',
            'id_tipo_pago'     => 'required',
            'tx_latitud'       => 'required',
            'tx_longitud'      => 'required',
            'tx_observaciones' => 'required',
            'id_status'        => 'required',
            'id_usuario'       => 'required',
            
        ]);

        $comercio = Comercio::create($request->all());

        return [ 'msj' => 'Registro Agregado Correctamente', compact('comercio') ];
    
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function infoValidate($request)
    {
        return request()->validate([

            'nb_comercio'       => 'bail|required|max:100',
            'nb_fiscal'         => 'bail|required|max:100',
            'tx_nit'            => 'bail|required|max:12|regex:/(^[0-9]+-{1}[0-9]{1})/',
            'tx_descripcion'    => 'bail|required|max:200',
            'id_tipo_comercio'  => 'bail|required',
            'categorias'        => 'bail|required|array',
            'id_tipo_pago'      => 'bail|required',
            'horarios'          => 'bail|required|array',
            'tx_foto'           => 'bail|required|max:100',
            'tx_src'            => 'bail|nullable',
            'id_usuario'        => 'bail|required',
            
        ],
        [
            'tx_foto.required'   => 'La Foto es requerida',
            'tx_foto.max'        => 'El nombre de la imagen es muy largo max: 100',
            'tx_nit.unique'      => 'El nit del Comercio ya esta en uso',
            'tx_nit.regex'       => 'Formato de NIT incorrecto Ej. 123123123-1',
        ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function comercioInfo(Request $request)
    {
        $validate = $this->infoValidate($request);

        $request->merge(['id_status' => 1]);

        $response = \DB::transaction(function ()  use($request) {

            $comercio = Comercio::create($request->only(
                'nb_comercio',
                'nb_fiscal',
                'tx_nit',
                'tx_descripcion',
                'id_tipo_comercio',
                'id_tipo_pago',
                'id_usuario',
                'id_status'
            ));

            $categorias =  ComercioCategoriaTrait::storeAll([
                'categorias'    => $request->input('categorias'),
                'id_comercio'   => $comercio->id,
                'id_usuario'    => $request->input('id_usuario'),
            ]);

            $horarios  = HorarioTrait::storeAll([
                'horarios'      => $request->input('horarios'),
                'id_comercio'   => $comercio->id,
                'id_usuario'    => $request->input('id_usuario'),
            ]);

            $comercio['categorias'] = $categorias;

            $comercio['horarios']   = $horarios;

            return $comercio;
        
        });

        return [ 'msj' => 'Comercio Actualizado Correctamente', 'comercio' => $response];
    
    }

    private function storePhoto($fileSrc, $filename)
	{
        $srcFoto  = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $fileSrc));

        $stored = Storage::disk('commerce')->put($filename, $srcFoto);

        return $stored;
    }

    private function getFilename($file, $id_comercio)
    {
        $extension = explode(".", $file)[1];

        return "$id_comercio.$extension"; 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function comercioInfoUpdate(Request $request)
    {
        $validate = $this->infoValidate($request);

        $comercio = Comercio::where('id', $request->input('id'));

        $response = \DB::transaction(function ()  use($request, $comercio) {
            
            $filename = $this->getFilename($request->input('tx_foto'), $request->input('id'));
        
            if($request->filled('tx_src'))
            {
                $photo    = $this->storePhoto($request->input('tx_src'), $filename);
            }
           
            $request->merge(['tx_foto' => $filename]);

            $update = $comercio->update($request->only(
                'nb_comercio',
                'nb_fiscal',
                'tx_nit',
                'tx_descripcion',
                'id_tipo_comercio',
                'id_tipo_pago',
                'tx_foto',
                'id_usuario',
            ));

            $categorias =  ComercioCategoriaTrait::replaceAll([
                'categorias'    => $request->input('categorias'),
                'id_comercio'   => $request->input('id'),
                'id_usuario'    => $request->input('id_usuario'),
            ]);

            $horarios  = HorarioTrait::replaceAll([
                'horarios'      => $request->input('horarios'),
                'id_comercio'   => $request->input('id'),
                'id_usuario'    => $request->input('id_usuario'),
            ]);

            return [ 'categorias' => $categorias, 'horarios' => $horarios ];

        });
        
        return [ 'msj' => 'Comercio Actualizado Correctamente',  $response];
    }


    //LOCATIONS FORM

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function comercioLocation(Request $request)
    {
        request()->validate([

            "id"                => 'bail|required|integer',
            "id_departamento"   => 'bail|required|integer',
            "id_ciudad"         => 'bail|required|integer',
            "id_zona"           => 'bail|required|integer',
            "id_comuna"         => 'bail|required|integer',
            "id_barrio"         => 'bail|required|integer',
            "tx_direccion"      => 'bail|required|max:50',
            'tx_latitud'       =>  'required',
            'tx_longitud'      =>  'required',
            "id_usuario"        => 'bail|required|integer',
            
        ]);

        $comercio = Comercio::where('id', $request->input('id'))->update($request->all());

        return [ 'msj' => 'Comercio Actualizado Correctamente', 'comercio' => $comercio];
    }



       /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function comercioOpenClose(Request $request, Comercio $comercio)
    {
        request()->validate([
            "bo_abierto"        => 'bail|required|integer',
        ]);

        $comercio = $comercio->update($request->only('bo_abierto'));

        if($request->input('bo_abierto') == 1)
        {
            return  [ 'msj' => 'Comercio Abierto Correctamente', 'openclose' => 1];
        }

        return [ 'msj' => 'Comercio Cerrado Correctamente', 'openclose' => 0];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comercio  $comercio
     * @return \Illuminate\Http\Response
     */
    public function show($id_comercio)
    {
        return        Comercio::with([
                            'comercioCategoria:id_comercio,id_categoria', 
                            'horario:nb_horario,id_comercio',
                            'telefono:id_comercio,tx_telefono,id_tipo_telefono,bo_whatsapp',
                            ])
                        ->select('comercio.id',
                                'comercio.nb_comercio',
                                'comercio.tx_descripcion',
                                'comercio.tx_direccion',
                                'comercio.tx_foto',
                                'comercio.tx_longitud',
                                'comercio.tx_latitud',
                                'comercio.bo_abierto',
                                'comercio.id_departamento',
                                'departamento.nb_departamento',
                                'comercio.id_ciudad',
                                'ciudad.nb_ciudad',
                                'comercio.id_zona',
                                'zona.nb_zona',
                                'comercio.id_barrio',
                                'barrio.nb_barrio',
                                'contacto.tx_email',
                                'contacto.tx_sitio_web',
                                'contacto.tx_facebook',
                                'contacto.tx_twitter',
                                'contacto.tx_instagram',
                                'contacto.tx_youtube',
                                ) 
                        ->selectRaw('(SELECT concat(count(valoracion.id), "-", sum(valoracion.nu_valoracion)/5) 
                                        FROM valoracion 
                                        WHERE valoracion.id_comercio = comercio.id) AS nu_pc_valoracion' 
                                    )
                        ->join('departamento', 'comercio.id_departamento', '=', 'departamento.id')  
                        ->join('ciudad', 'comercio.id_ciudad', '=', 'ciudad.id')  
                        ->join('zona', 'comercio.id_zona', '=', 'zona.id') 
                        ->join('barrio', 'comercio.id_barrio', '=', 'barrio.id') 
                        ->join('contacto', 'comercio.id', '=', 'contacto.id_comercio')         
                        ->where('comercio.id_status', 1)
                        ->where('comercio.id', $id_comercio)
                        ->first();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comercio  $comercio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comercio $comercio)
    {
        $comercio = $comercio->delete();
 
        return [ 'msj' => 'Registro Eliminado' , compact('comercio')];

    }
}
