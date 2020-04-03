<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ComercioCategoria extends Pivot
{
    protected $fillable =   [
                            'id_comercio',
                            'id_categoria',
                            'tx_observaciones',
                            'id_status',
                            'id_usuario',
                            'created_at',
                            'updated_at'
                            ];

    protected $hidden   = ['id','created_at','updated_at'];

    public function categoria(){

        return $this->BelongsTo('App\Models\Categoria', 'id_categoria');

    }

    public function comercio(){

        return $this->BelongsTo('App\Models\Comercio', 'id_comercio');

    }
    
    public function status(){
    
        return $this->BelongsTo('App\Models\Status', 'id_status');
    
    }

    public function usuario(){
    
        return $this->BelongsTo('App\Models\Usuario', 'id_usuario');
    
    }
}
