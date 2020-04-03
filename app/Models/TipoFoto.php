<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoFoto extends Model
{
    protected $fillable =   [
                            'nb_tipo_foto',
                            'tx_icono',
                            'tx_path',
                            'tx_observaciones',
                            'id_status',
                            'id_usuario',
                            'created_at',
                            'updated_at'
                            ];

    protected $hidden   = ['id', 'created_at', 'updated_at'];

    public function status(){
    
        return $this->BelongsTo('App\Models\Status', 'id_status');
    
    }

    public function usuario(){
    
        return $this->BelongsTo('App\Models\Usuario', 'id_usuario');
    
    }

    public function foto(){

        return $this->HasMany('App\Models\Foto', 'id_foto');

    }

}
