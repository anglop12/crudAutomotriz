<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Concessionaire extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'concessionaires';

    public $timestamps = true;

    public $fillable = [
        'name', 'state', 'city',
    ];

    public function clients()
    {
        return $this->hasMany(Client::class, 'concessionaire_id');
    }

}
