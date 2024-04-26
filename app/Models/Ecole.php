<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ecole extends Model
{
    use HasFactory;

    protected $table = 'ecoles';

    protected $fillable = [
        'nom',
        'code',
        'email',
        'phone',
        'province_id',
        'region_id',
        'district_id',
        'commune_id',
        'adresse',
        'user_id',
        'is_active',
        'category_id',
        'logo'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
