<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComercioDespacho extends Model
{
    protected $table 	= 'comercio_despacho';
    
    protected $fillable =   [
                            'id_comercio',
                            'id_zona',
                            'tx_observaciones',
                            'id_status',
                            'id_usuario',
                            'created_at',
                            'updated_at'
                            ];

    protected $hidden   = ['created_at','updated_at'];

    public function comercio(){

        return $this->BelongsTo('App\Models\Comercio', 'id_comercio');

    }

    public function zona(){

        return $this->BelongsTo('App\Models\Comercio', 'id_zonao');

    }
    
    public function status(){
    
        return $this->BelongsTo('App\Models\Status', 'id_status');
    
    }

    public function usuario(){
    
        return $this->BelongsTo('App\Models\Usuario', 'id_usuario');
    
    }
}
