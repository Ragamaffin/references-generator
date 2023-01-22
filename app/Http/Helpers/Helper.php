<?php

namespace App\Http\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Helper
{
    public static function isCreatedByUser($model)
    {
        if ($model->created_by === Auth::id()) {
            return true;
        }

        return false;
    }

    public static function isAdmin()
    {
        if (Auth::user()->role === User::ROLE_ADMIN) {
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

    public static function getRelatedTagsToString($model)
    {
        $tags = [];

        foreach ($model->tags as $tag) {
            $tags[] = $tag->tag_name;
        }

        return implode(', ', $tags);
    }
}
