<?php

namespace App\Models;

class Helper
{
    public static function getRelatedTagsToString($model)
    {
        $tags = [];
        foreach ($model->tags as $tag) {
            $tags[] = $tag->tag_name;
        }
        return implode(', ', $tags);
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
}
