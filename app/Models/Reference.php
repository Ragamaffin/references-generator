<?php

namespace App\Models;

use App\Http\Helpers\Helper;
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

    public static function getReferencesCreatedByCurrentUser()
    {
        return Auth()->user()->references->where('status', Reference::STATUS_OPEN);
    }

    public function getRelatedTagsToString()
    {
        $tags = [];

        foreach ($this->resources as $resource) {
            $tags = array_merge($tags, $resource->getRelatedTagsToString(Helper::TAGS_ARRAY));
        }

        $tags = array_unique($tags);

        return implode(', ', $tags);
    }
}
