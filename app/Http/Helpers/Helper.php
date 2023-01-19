<?php

namespace App\Http\Helpers;

use App\Models\User;

class Helper
{
    public const TAGS_STRING = 'string';
    public const TAGS_ARRAY = 'array';

    public static function setTags($model, $request)
    {
        $model->tags()->detach();

        if ($request->tags) {
            foreach ($request->tags as $tag) {
                $model->tags()->attach($tag);
            }
        }
    }

    public static function isCreatedByUser($model)
    {
        if ($model->created_by === Auth()->user()->user_id) {
            return true;
        }

        return false;
    }

    public static function isAdmin()
    {
        if (Auth()->user()->role === User::ROLE_ADMIN) {
            return true;
        }

        return false;
    }

    public static function isUserHasAccess($model)
    {
        if (self::isAdmin() || self::isCreatedByUser($model)) {
            return true;
        }

        return false;
    }
}
