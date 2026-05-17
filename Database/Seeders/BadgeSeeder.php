<?php

namespace Modules\Onboarding\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Onboarding\Models\Badge;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $badges = [
            [
                'name' => ['da' => 'Verificeret', 'en' => 'Verified'],
                'slug' => ['da' => 'verificeret', 'en' => 'verified'],
                'description' => ['da' => 'Brugeren eller virksomheden er verificeret.', 'en' => 'The user or company is verified.'],
                'icon' => 'fas fa-check-circle',
            ],
            [
                'name' => ['da' => 'Premium', 'en' => 'Premium'],
                'slug' => ['da' => 'premium', 'en' => 'premium'],
                'description' => ['da' => 'Premium-bruger eller partner.', 'en' => 'Premium user or partner.'],
                'icon' => 'fas fa-star',
            ],
            [
                'name' => ['da' => 'Superbruger', 'en' => 'Superuser'],
                'slug' => ['da' => 'superbruger', 'en' => 'superuser'],
                'description' => ['da' => 'Bruger med ekstra privilegier.', 'en' => 'User with extra privileges.'],
                'icon' => 'fas fa-crown',
            ],
            [
                'name' => ['da' => 'Betroet Partner', 'en' => 'Trusted Partner'],
                'slug' => ['da' => 'betroet-partner', 'en' => 'trusted-partner'],
                'description' => ['da' => 'Virksomhed med tillidsscore.', 'en' => 'Company with trust score.'],
                'icon' => 'fas fa-shield-alt',
            ],
            [
                'name' => ['da' => 'Top Vurderet', 'en' => 'Top Rated'],
                'slug' => ['da' => 'top-vurderet', 'en' => 'top-rated'],
                'description' => ['da' => 'Bruger eller virksomhed med top rating.', 'en' => 'User or company with top rating.'],
                'icon' => 'fas fa-thumbs-up',
            ],
            [
                'name' => ['da' => 'Ny Begynder', 'en' => 'New Beginner'],
                'slug' => ['da' => 'ny-begynder', 'en' => 'new-beginner'],
                'description' => ['da' => 'Nyoprettet bruger.', 'en' => 'Newly created user.'],
                'icon' => 'fas fa-user-plus',
            ],
            [
                'name' => ['da' => 'Loyal Kunde', 'en' => 'Loyal Customer'],
                'slug' => ['da' => 'loyal-kunde', 'en' => 'loyal-customer'],
                'description' => ['da' => 'Trofast kunde i lang tid.', 'en' => 'Loyal customer for a long time.'],
                'icon' => 'fas fa-heart',
            ],
            [
                'name' => ['da' => 'Mester', 'en' => 'Master'],
                'slug' => ['da' => 'mester', 'en' => 'master'],
                'description' => ['da' => 'Certificeret mester.', 'en' => 'Certified master.'],
                'icon' => 'fas fa-tools',
            ],
            [
                'name' => ['da' => 'Ambassadør', 'en' => 'Ambassador'],
                'slug' => ['da' => 'ambassador', 'en' => 'ambassador'],
                'description' => ['da' => 'Officiel ambassadør for platformen.', 'en' => 'Official platform ambassador.'],
                'icon' => 'fas fa-award',
            ],
            [
                'name' => ['da' => 'Influencer', 'en' => 'Influencer'],
                'slug' => ['da' => 'influencer', 'en' => 'influencer'],
                'description' => ['da' => 'Social media influencer.', 'en' => 'Social media influencer.'],
                'icon' => 'fas fa-bullhorn',
            ],
        ];

        foreach ($badges as $data) {
            Badge::firstOrCreate(
                $data
            );
        }
    }
}