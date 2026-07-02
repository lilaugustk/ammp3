<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TiengDongTag extends Model
{
    protected $table = 'tiengdong_tags';

    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * Get all sounds associated with this tag.
     */
    public function sounds(): BelongsToMany
    {
        return $this->belongsToMany(TiengDongSound::class, 'tiengdong_sound_tag', 'tag_id', 'sound_id');
    }
}
