<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    use HasFactory;

    public const STATUS_OPEN = 'o';
    public const STATUS_CLOSED = 'c';

    protected $primaryKey = 'reference_id';

    protected $fillable = [
        'reference_name',
        'created_by',
        'status'
    ];

    public function resources()
    {
        return $this->belongsToMany(Resource::class,
            'reference_resource',
            'reference_id',
            'resource_id',
            'reference_id',
            'resource_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'user_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,
            'reference_tag',
            'reference_id',
            'tag_id',
            'reference_id',
            'tag_id');
    }
}
