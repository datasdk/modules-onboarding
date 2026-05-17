<?php
return [
    'subject' => 'Your onboarding has been approved',

    'html_template' => '
        <p>Dear {{ user.first_name }},</p>
        <p>Your onboarding has been approved, and the company <strong>{{ company.name }}</strong> (VAT: {{ company.vat }}) is now officially approved on the platform.</p>
        <p>You now have full access to the platform.</p>
        <p><br></p>
        <p>Kind regards,</p>
        <p>{{ company.name }}</p>
    ',

    'text_template' => "
        Dear {{ user.first_name }},

        Your onboarding has been approved, and the company {{ company.name }} (VAT: {{ company.vat }}) is now officially approved on the platform.
        You now have full access to the platform.

        Kind regards,
        {{ company.name }}
    ",
];
