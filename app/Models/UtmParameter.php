<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class UtmParameter extends Model
{
    use HasFactory;

    protected $fillable = [
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_term',
        'utm_content'
    ];

    protected $appends = [
        'utm_exchanges_count',
        'completed_utm_exchanges_count'
    ];

    public function utmExchanges()
    {
        return $this->hasMany(UtmExchanges::class, 'utm_id');
    }

    public function completedUtmExchanges()
    {
        return $this->hasMany(UtmExchanges::class, 'utm_id')->where('is_completed', true);
    }

    public function getUtmExchangesCountAttribute()
    {
        $count = $this->utmExchanges;
        return $count ? count($count) : 0;
    }

    public function getCompletedUtmExchangesCountAttribute()
    {
        $count = $this->completedUtmExchanges;
        return $count ? count($count) : 0;
    }

    protected static function booted()
    {
        static::addGlobalScope('with_counts', function (Builder $builder) {
            $builder->withCount([
                'utmExchanges',
                'completedUtmExchanges'
            ]);
        });
    }
}
