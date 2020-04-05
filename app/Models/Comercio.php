<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comercio extends Model
{
    protected $table 	= 'comercio';
    
    protected $fillable =   [
                            'nb_cliente',
                            'nb_fiscal',
                            'tx_nit',
                            'tx_descripcion',
                            'id_departamento',
                            'id_ciudad',
                            'id_zona',
                            'id_comuna',
                            'id_barrio',
                            'tx_direccion',
                            'id_tipo_comercio',
                            'id_tipo_pago',
                            'nu_latitud',
                            'nu_longitud',
                            'tx_observaciones',
                            'id_status',
                            'id_usuario',
                            'created_at',
                            'updated_at'
                            ];

    protected $hidden   = ['created_at','updated_at'];

    

    public function departamento(){

        return $this->BelongsTo('App\Models\Departamento', 'id_departamento');

    }
    public function ciudad(){

        return $this->BelongsTo('App\Models\Ciudad', 'id_ciudad');

    }
    public function zona(){

        return $this->BelongsTo('App\Models\Zona', 'id_zona');

    }
    public function comuna(){

        return $this->BelongsTo('App\Models\Comuna', 'id_comuna');

    }

    public function barrio(){

        return $this->BelongsTo('App\Models\Barrio', 'id_barrio');

    }

    public function tipoComercio(){

        return $this->BelongsTo('App\Models\TipoComercio', 'id_tipo_comercio');

    }

    public function tipoPago(){

        return $this->BelongsTo('App\Models\Tipo_Pago', 'id_tipo_pago');

    }

    public function status(){
    
        return $this->BelongsTo('App\Models\Status', 'id_status');
    
    }

    public function usuario(){
    
        return $this->BelongsTo('App\Models\Usuario', 'id_usuario');
    
    }

    public function telefono(){

        return $this->HasMany('App\Models\Telefono', 'id_telefono');

    }

    public function horario(){

        return $this->HasMany('App\Models\Horario', 'id_horario');

    }

    public function contacto(){

        return $this->HasMany('App\Models\Contacto', 'id_contacto');

    }

    public function foto(){

        return $this->HasMany('App\Models\Foto', 'id');

    }

    public function pago(){

        return $this->HasMany('App\Models\Pago', 'id_pago');

    }

    public function subcripcion(){

        return $this->HasMany('App\Models\Subcripcion', 'id_subcripcion');

    }

    public function valoracion(){

        return $this->HasMany('App\Models\Valoracion', 'id_valoracion');

    }

    public function comercioCategoria(){

        return $this->HasMany('App\Models\ComercioCategoria', 'id');

    }
}
