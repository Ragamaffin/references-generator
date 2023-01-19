<?php

namespace App\Models;

use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\TextUI\Help;

class Resource extends Model
{
    use HasFactory;

    public const RESOURCE_TYPE_FILE = 'file';
    public const RESOURCE_TYPE_URL = 'url';

    protected $primaryKey = 'resource_id';

    protected $fillable = [
        'resource_name',
        'resource_type',
        'description',
        'year',
        'resource_url',
        'file_path'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'resource_tag', 'resource_id', 'tag_id', 'resource_id', 'tag_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'user_id');
    }

    public static function getAllTypes()
    {
        return [
          self::RESOURCE_TYPE_FILE => __('File'),
          self::RESOURCE_TYPE_URL => __('Internet resource')
        ];
    }

    public function getTypeName()
    {
        return self::getAllTypes()[$this->resource_type];
    }

    public function hideField($key)
    {
        if ($this->resource_type !== $key) {
            return 'hidden';
        }

        return false;
    }

    public function getRelatedTagsToString($type = Helper::TAGS_STRING)
    {
        $tags = [];

        foreach ($this->tags as $tag) {
            $tags[] = $tag->tag_name;
        }

        return $type === Helper::TAGS_STRING
            ? implode(', ', $tags)
            : $tags;
    }
}
