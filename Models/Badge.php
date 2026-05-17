<?php

namespace Modules\Onboarding\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use DataSDK\Tools\Traits\Slugs\TranslatableSlug;
use DataSDK\Tools\Traits\Language;

use Modules\Onboarding\Models\User;
use Modules\Onboarding\Models\Companies;


class Badge extends Model
{

    use TranslatableSlug;
    use Language;


    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon'
    ];


    protected $translatable = [
        'name', 
        'slug', 
        'description'
    ];   



    public function users()
    {

        return $this->morphedByMany(
            User::class,
            'badgeable',
            'badgeables'
        )->withTimestamps();

    }


    public function companies()
    {

        return $this->morphedByMany(
            Companies::class,
            'badgeable',
            'badgeables'
        )->withTimestamps();

    }

 
 

    /**
     * Tildel et badge til en model
     */
    public function assignToModel($model): bool
    {
        if (!$model) {
            return false;
        }
        
        if (!self::modelHasBadge($model, $this->slug)) {
            $this->badgeables()->attach([
                [
                    'badgeable_type' => get_class($model),
                    'badgeable_id' => $model->id
                ]
            ]);
            return true;
        }
        return false;
    }

    /**
     * Fjern dette badge fra en model
     */
    public function removeFromModel($model): bool
    {
        if (!$model) {
            return false;
        }
        
        $this->badgeables()
            ->where('badgeable_type', get_class($model))
            ->where('badgeable_id', $model->id)
            ->detach();
        return true;
    }

    /**
     * Hent alle modeller med dette badge
     */
    public function getModelsWithThisBadge($modelClass = null): Collection
    {
        $query = $this->badgeables();
        
        if ($modelClass) {
            $query->where('badgeable_type', $modelClass);
        }
        
        $items = $query->get();
        
        // Hent de faktiske modeller
        $models = new Collection();
        foreach ($items as $item) {
            if ($item->badgeable_type && class_exists($item->badgeable_type)) {
                $model = $item->badgeable_type::find($item->badgeable_id);
                if ($model) {
                    $models->push($model);
                }
            }
        }
        
        return $models;
    }

    /**
     * Tæl antal modeller med dette badge
     */
    public function countModels($modelClass = null): int
    {
        $query = $this->badgeables();
        
        if ($modelClass) {
            $query->where('badgeable_type', $modelClass);
        }
        
        return $query->count();
    }

    /**
     * Hent badge som HTML
     */
    public function toHtml(): string
    {
        $color = '#6c757d'; // Standard farve da color ikke findes i DB
        $icon = $this->icon ?: 'fas fa-certificate';
        
        return sprintf(
            '<span class="badge badge-pill" style="background-color: %s; color: white;" 
                data-toggle="tooltip" title="%s">
                <i class="%s"></i> %s
            </span>',
            $color,
            htmlspecialchars($this->description ?: $this->name),
            $icon,
            htmlspecialchars($this->name)
        );
    }

    /**
     * Hent alle badges med model counts
     */
    public static function getAllWithCounts($modelClass = null): Collection
    {
        $query = self::withCount(['badgeables' => function ($query) use ($modelClass) {
            if ($modelClass) {
                $query->where('badgeable_type', $modelClass);
            }
        }]);
        
        return $query->get();
    }
    
    /**
     * Relation count for badgeables (til brug med withCount)
     */
    public function getBadgeablesCountAttribute()
    {
        return $this->badgeables()->count();
    }
}