<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TiengDongSound extends Model
{
    protected $table = 'tiengdong_sounds';

    // The primary key is 'id' (post_id) which is non-incrementing big integer
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'id',
        'category_id',
        'title',
        'slug',
        'mp3_url',
        'local_path',
        'detail_url',
    ];

    /**
     * Get the category that this sound belongs to.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(TiengDongCategory::class, 'category_id');
    }
}
