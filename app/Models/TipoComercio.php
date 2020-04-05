<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoComercio extends Model
{
    protected $table 	= 'tipo_comercio';
    
    protected $fillable =   [
                            'nb_tipo_comercio',
                            'tx_icono',
                            'tx_observaciones',
                            'id_status',
                            'id_usuario',
                            'created_at',
                            'updated_at'
                            ];

    protected $hidden   = [ 'created_at', 'updated_at'];

    public function status(){
    
        return $this->BelongsTo('App\Models\Status', 'id_status');
    
    }

    public function usuario(){
    
        return $this->BelongsTo('App\Models\Usuario', 'id_usuario');
    
    }

    public function comercio(){

        return $this->HasMany('App\Models\Comercio', 'id_comercio');

    }
}
