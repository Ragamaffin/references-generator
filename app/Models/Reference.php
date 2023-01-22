<?php

namespace App\Models;

use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Reference extends Model
{
    use HasFactory;

    public const STATUS_OPEN = 'o';
    public const STATUS_CLOSED = 'c';
    private const MAXIMUM_SAME_ATTACHED_TAGS = 1;

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

    public function setTags($resource)
    {
        foreach ($resource->tags as $tag) {
            if (!in_array($tag->tag_id, $this->tags()->pluck('tags.tag_id')->toArray())) {
                $this->tags()->attach($tag);
            }
        }
    }

    public function removeTags($resource)
    {
        foreach ($resource->tags as $tag) {
            if ($this->isAllowedToDetachTag($tag->tag_id)) {
                $this->tags()->detach($tag);
            }
        }
    }

    public static function getReferencesCreatedByCurrentUser()
    {
        return Auth::user()->references->where('status', Reference::STATUS_OPEN);
    }

    public static function getStatusList()
    {
        return [
            self::STATUS_OPEN => __('Open'),
            self::STATUS_CLOSED => __('Closed')
        ];
    }

    public function getStatus()
    {
        return self::getStatusList()[$this->status];
    }

    public static function getStatusButtonColors()
    {
        return [
            self::STATUS_OPEN => 'btn-success',
            self::STATUS_CLOSED => 'btn-danger'
        ];
    }

    public function getStatusColor()
    {
        return self::getStatusButtonColors()[$this->status];
    }

    private function isAllowedToDetachTag($tagId)
    {
        $count = count(array_keys($this->getAttachedResourcesTagsAsArray(), $tagId));

        if ($count === self::MAXIMUM_SAME_ATTACHED_TAGS) {
            return true;
        }

        return false;
    }

    private function getAttachedResourcesTagsAsArray()
    {
        $tags = [];

        foreach ($this->resources as $resource) {
            $tags = array_merge($tags, $resource->tags()->pluck('tags.tag_id')->toArray());
        }

        return $tags;
    }
}
