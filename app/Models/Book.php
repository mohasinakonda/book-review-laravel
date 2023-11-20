<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;


    public function review()
    {
        return $this->hasMany(Review::class);
    }
    public function scopeTitle(Builder $query, string $title): Builder
    {
        return $query->where('title', 'LIKE', '%' . $title . '%');
    }

    public function scopeMostPopular(Builder $query): Builder
    {
        return $query->withCount('review')->withAvg('review', 'rating')->having('review_count', '>=', 10)->orderBy('review_avg_rating', 'desc');
    }
    public function scopeHighestRated(Builder $query): Builder
    {
        return $query->withAvg('review', 'rating')->orderBy('review_avg_rating', 'desc');
    }
    public function scopeLowestRated(Builder $query): Builder
    {
        return $query->withAvg('review', 'rating')->orderBy('review_avg_rating', 'asc');
    }

}
