<?php
return [
    'subject' => 'Your onboarding was rejected',

    'html_template' => '
        <p>Dear {{ user.first_name }},</p>
        <p>Unfortunately, your onboarding request has been rejected.</p>
        <p>The company <strong>{{ company.name }}</strong> (VAT: {{ company.vat }}) has not been approved on the platform.</p>
        <p>If you believe this is a mistake, please contact our support.</p>
        <p><br></p>
        <p>Kind regards,</p>
        <p>{{ company.name }}</p>
    ',

    'text_template' => "
        Dear {{ user.first_name }},

        Unfortunately, your onboarding request has been rejected.
        The company {{ company.name }} (VAT: {{ company.vat }}) has not been approved on the platform.
        If you believe this is a mistake, please contact our support.

        Kind regards,
        {{ company.name }}
    ",
];
