<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['gekentekende_voertuigen_id', 'file_path'];

    public function gekentekendeVoertuigen()
    {
        return $this->belongsTo(GekentekendeVoertuigen::class, 'gekentekende_voertuigen_id');
    }
}