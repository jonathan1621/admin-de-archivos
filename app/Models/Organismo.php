<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organismo extends Model
{

    public function archivos()
    {
        return $this->hasMany(Archivo::class, 'organismo_id');
    }

    use HasFactory;

    protected $fillable = ['nombre'];

}
