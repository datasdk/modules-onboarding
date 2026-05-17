<?php

return [
    'name' => 'Onboarding',

    "default_verify_badge_id" => null,

    'admin' => [
 
        'navigationbar'=>[

            "group" => "Onboarding",

            "sorting" => 300,

            "link" => ["name" => "Onboarding", 'icon'=> 'fas fa-user-check', 'name' => 'Onboarding', 'link' => 'onboarding.index'],
            

             'submenu' => [

                ["name" => "Badges", 'icon'=> 'fas fa-user-check', 'link' => 'onboarding.badges.index'],

                [ "icon" => "fas fa-cog", "name" => "Settings", "link" => "onboarding.settings.index", 'new_window' => false], 
                
            ],

           
        ],

    ],


    "settings" => [
        "onboarding_admin_email" => "ak@profilgroup.dk"
    ]

];
