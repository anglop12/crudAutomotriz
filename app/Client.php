<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'clients';

    public $timestamps = true;
    
    public $fillable = [
        'name', 'lastname', 'age', 'concessionaire_id',
    ];

    public function concessionaire()
    {
        return $this->belongsTo(Concessionaire::class, 'concessionaire_id');
    }

}
