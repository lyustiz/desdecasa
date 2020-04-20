<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Valoracion extends Model
{
    protected $table 	= 'valoracion';
    
    protected $fillable =   [
                            'id_comercio',
                            'tx_valoracion',
                            'nu_valoracion',
                            'tx_observaciones',
                            'id_status',
                            'id_usuario',
                            'created_at',
                            'created_at',
                            'updated_at'
                            ];
    
    protected $dateFormat = 'Y-m-d';

    public function comercio(){

        return $this->HasMany('App\Models\Comercio', 'id_comercio');

    }

    public function status(){
    
        return $this->BelongsTo('App\Models\Status', 'id_status');
    
    }

    public function usuario(){
    
        return $this->BelongsTo('App\Models\Usuario', 'id_usuario');
    
    }
}
