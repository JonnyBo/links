<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Link extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'link', 'slug'
    ];

    public static function getLastSlugs() {
        $links = self::query()
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();
        return $links->map(function($link, $key) {
            return URL::to('/') . '/' . $link->slug;
        });

    }

    public function getSlug() :string {
        $link = self::query()
            ->orderBy('id', 'desc')
            ->first();
        $lastChar = 'a';
        if ($link && $link->slug) {
            ++$link->slug;
            return $link->slug;
        }
        return $lastChar;
    }
}
