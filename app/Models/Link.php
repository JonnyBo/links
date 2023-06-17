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
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
        return $links->map(function($link, $key) {
            return [
                'link' => URL::to('/') . '/' . $link->slug,
            ];
        });

    }

    public function getSlug() :string {
        $link = self::query()
            ->orderBy('created_at', 'desc')
            ->first();
        $lastChar = 'a';
        if ($link && $link->slug) {
            $lastChar = mb_substr($link->slug, -1);
            ++$lastChar;
            return mb_substr($link->slug, 0, -1) . $lastChar;
        }
        return $lastChar;
    }
}
