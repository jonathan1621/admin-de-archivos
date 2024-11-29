<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Archivo
 *
 * @property $id
 * @property $organismo_id
 * @property $descripcion
 * @property $archivo
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Archivo extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['organismo_id', 'descripcion', 'archivo','nombre_original'];

    public function organismo()
    {
        return $this->belongsTo(Organismo::class, 'organismo_id');
    }

}
