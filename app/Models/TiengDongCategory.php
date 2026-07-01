<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TiengDongCategory extends Model
{
    protected $table = 'tiengdong_categories';

    protected $fillable = [
        'name',
        'slug',
        'url',
    ];

    /**
     * Get all sounds in this category.
     */
    public function sounds(): HasMany
    {
        return $this->hasMany(TiengDongSound::class, 'category_id');
    }
}
