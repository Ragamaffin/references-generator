<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'resource_name',
        'resource_type',
        'description',
        'year',
        'pages',
        'resource_url'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'resource_tag', 'resource_id', 'tag_id');
    }
}
