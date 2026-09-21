<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Photo extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'est_couverture' => 'boolean',
            'est_publiee'    => 'boolean',
        ];
    }

    public function attachable(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopePubliees($query)
    {
        return $query->where('est_publiee', true);
    }
}
