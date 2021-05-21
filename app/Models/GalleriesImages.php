<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GalleriesImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'galleries_id',
        'path',
        'img_original_name',
    ];
    public function gallery(): BelongsTo
    {
        return $this->belongsTo(Galleries::class);
    }
}
