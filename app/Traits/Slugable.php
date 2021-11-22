<?php

namespace App\Traits;

use App\Slug;
use Illuminate\Support\Str;

trait Slugable
{
    public static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            self::addSlug($model);
        });
        // static::creating(function ($model) {
        //     self::addSlug($model);
        // });
        // static::created(function ($model){
        //     self::updateClass($model);
        // });
        static::saved(function ($model){
            self::updateClass($model);
        });
    }
    public static function updateClass($model)
    {
        $slug = Slug::where('slug', $model->slug)->first();
        $slug->update([
            'slugable_id' => $model->id,
            'slugable_type' => get_class($model)
        ]);
    }
    public static function addSlug($model)
    {
        if (class_basename($model) == "Slug") {
            return;
        }

        if (!empty($model->slug)) {
            $slug = $model->slug;
            if (self::checkSlugExists($model->getOriginal('slug'))) {
                $oldSlug = Slug::where('slug', $model->getOriginal('slug'))->first();
                if ($oldSlug->slug != $slug) {
                    $oldSlug->update([
                        'slug' => $slug,
                    ]);
                }
            }else {
                Slug::create(['slug' => $slug]);
            }
        }else {
            $slug = Str::slug($model->name);
            if (self::checkSlugExists($slug)) {
                $slug = self::makeSlug($slug);
                Slug::create(['slug' => $slug]);
            } else {
                Slug::create(['slug' => $slug]);
            }
        }
        $model->slug = $slug;
        $model->seo_title = $model->name;
        $model->seo_tag = $model->name;
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
    private static function checkSlugExists($slug)
    {
        return Slug::where('slug', $slug)->exists();
    }
    private static function makeSlug($slug)
    {
        $count =0;
        $tem_slug = $slug;
        while (Slug::where('slug', $tem_slug)->exists()) {
            $count++;
            $tem_slug = $slug . '-'.dechex($count);
        }
        return $tem_slug;
    }
}