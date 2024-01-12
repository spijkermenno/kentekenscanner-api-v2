<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalyticsEvent extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'event_name', 'parameters'];
    protected $keyType = 'string';
    public $incrementing = false;

    // No need for the creating event to generate UUID, as it will be provided in the API request
}
