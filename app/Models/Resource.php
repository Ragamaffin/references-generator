<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
