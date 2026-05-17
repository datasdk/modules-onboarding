<?php

namespace Modules\Onboarding\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Onboarding\Models\Badge;
use Modules\Companies\Models\Companies;
use Modules\Crm\Http\Controllers\Api\UserController;
use Modules\Companies\Http\Controllers\CompaniesController;


class OnboardingRelationsProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     */
    public function boot(): void
    {
        $this->registerRelations();
    }

    /**
     * Register dynamic relations using resolveRelationUsing
     */
    protected function registerRelations(): void
    {


        UserController::whitelist([
            "companies.badges",
            "company.badges"
        ]);
        

        CompaniesController::whitelist([
            "badges"
        ]);



        // Relation for alle badges på en company (many-to-many)
        Companies::resolveRelationUsing('badges', function (Companies $company) {
            return $company->morphToMany(
                Badge::class,
                'badgeable',      // morph name
                'badgeables',     // pivot table
                'badgeable_id',   // foreign key på pivot
                'badge_id'        // related key på pivot
            )->withTimestamps();
        });


    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        // Her kan du tilføje bindings hvis nødvendigt
    }

    /**
     * Optional: services provided.
     */
    public function provides(): array
    {
        return [];
    }
}
