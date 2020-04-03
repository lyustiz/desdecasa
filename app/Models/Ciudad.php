<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    protected $fillable =   [
                            'co_ciudad',
                            'nb_ciudad',
                            'id_departamento',
                            'nu_latitud',
                            'nu_longitud',
                            'tx_observaciones',
                            'id_status',
                            'id_usuario',
                            'created_at',
                            'updated_at'
                            ];

    protected $hidden   = ['id','created_at','updated_at'];

    public function departamento(){

        return $this->BelongsTo('App\Models\Departamento', 'id_departamento');

    }

    public function status(){
    
        return $this->BelongsTo('App\Models\Status', 'id_status');
    
    }

    public function usuario(){
    
        return $this->BelongsTo('App\Models\Usuario', 'id_usuario');
    
    }

    public function zona(){

        return $this->HasMany('App\Models\Zona', 'id_zona');

    }
}
