<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    use HasFactory;

    public const STATUS_COMPLETE = 'c';
    public const STATUS_STARTED = 's';

    protected $fillable = [
        'reference_name',
        'created_by',
        'status'
    ];

    public function resources()
    {
        return $this->belongsToMany(Resource::class);
    }
}
