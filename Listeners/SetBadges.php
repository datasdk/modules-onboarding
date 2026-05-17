<?php

namespace Modules\Onboarding\Listeners;

use Modules\Onboarding\Events\OnboardingAccepted;
use Modules\Onboarding\Models\Badge;
use Modules\Onboarding\Models\Companies;


class SetBadges
{
    /**
     * Håndter eventet (uanset om det er accept eller reject).
     */
    public function handle(OnboardingAccepted $event): void
    {
        $onboarding = $event->onboarding ?? null;

        if (!$onboarding) {
            return;
        }

        $user = $onboarding->user;
        $company = $onboarding->company;

        /*
        lav user!
        if ($user) {
            $this->assignBadgeToModel($user);
        }

        if ($company) {
            
        }
        */
        

        $this->assignBadgeToModel($company);
    }

    /**
     * Privat hjælpemetode til at tildele badge til en model
     */
    private function assignBadgeToModel($model): void
    {
        if (!$model) {
            return;
        }

        
        $default_verify_badge_id = config("onboarding.default_verify_badge_id");


        
        $badge = $default_verify_badge_id ? Badge::find($default_verify_badge_id) : Badge::first();
    

        if(!$badge){ return; }


        $badgeSlug = $badge->slug;


        // 2. Tjek om modellen allerede har badge
        if ($model->hasBadge($badgeSlug)) {
            return; // Allerede har badge
        }

        // 3. Tilføj badge til modellen via pivot
        $model->addBadge($badge);


        // 4. (Valgfrit) Log eller udfør yderligere handlinger
        $this->logBadgeAssignment($model, $badge);


    }


    /**
     * (Valgfrit) Log eller håndter yderligere efter badge-tildeling
     */
    private function logBadgeAssignment($model, Badge $badge): void
    {
        // Eksempel på logging
       

        // Du kan også sende notifikationer, opdatere cache, etc.
        // event(new BadgeAssigned($model, $badge));
    }

}