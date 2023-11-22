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

    public function scopeMostPopular(Builder $query, $from = null, $to = null): Builder
    {
        return $query->withCount([
            'review' => fn(Builder $q) => $this->filterDateRange($q, $from, $to)
        ])
            ->withAvg('review', 'rating')
            ->having('review_count', '>=', 10)
            ->orderBy('review_avg_rating', 'desc');
    }
    public function scopeAvgRating(Builder $query)
    {
        return $query->withAvg('review', 'rating');
    }
    public function scopeHighestRated(Builder $query, $from = null, $to = null): Builder
    {
        return $query->withAvg([
            'review' => fn(Builder $q) => $this->filterDateRange($q, $from, $to)
        ], 'rating')->orderBy('review_avg_rating', 'desc');
    }
    public function scopeLowestRated(Builder $query): Builder
    {
        return $query->withAvg('review', 'rating')->orderBy('review_avg_rating', 'asc');
    }

    private function filterDateRange(Builder $query, $from, $to)
    {
        if ($from && !$to) {
            $query->where('created_at', '>=', $from);
        } elseif (!$from && $to) {
            $query->where('created_at', '<=', $to);

        } elseif ($from && $to) {
            $query->whereBetween('created_at', [$from, $to]);
        }
    }
}
