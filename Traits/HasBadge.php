<?php

namespace Modules\Onboarding\Traits;

use Modules\Onboarding\Models\Badge;

trait HasBadge
{
    /**
     * MorphToMany relation til badges
     */
    public function badges()
    {
        return $this->morphToMany(
            static::class,
            'badgeable',
            'badgeables',
            'badgeable_id',
            'badge_id'
        )->withTimestamps();
    }


    /**
     * Tilføj en badge til modellen
     */
    public function addBadge(string|Badge $badge)
    {

        if (is_string($badge)) {

            $badge = Badge::firstOrCreate(['slug' => $badge]);

        }

        $this->badges()->syncWithoutDetaching([$badge->id]);

        return $this;

    }


    /**
     * Fjern en badge fra modellen
     */
    public function removeBadge(string|Badge $badge)
    {

        if (is_string($badge)) {

            $badge = Badge::where('slug', $badge)->first();

            if (!$badge) return $this;

        }


        $this->badges()->detach($badge->id);

        return $this;

    }


    /**
     * Check om modellen har en specifik badge
     */
    public function hasBadge(string|Badge $badge): bool
    {

        if (is_string($badge)) {

            return $this->badges()->where('slug', $badge)->exists();

        }

        return $this->badges()->where('id', $badge->id)->exists();

    }


}
