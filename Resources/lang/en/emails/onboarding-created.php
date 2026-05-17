<?php
return [
    'subject' => 'An onboarding has been created',

    'html_template' => '
        <p>Dear admin,</p>
        <p>Your onboarding request has been created and is now being reviewed.</p>
        <p>We will notify you as soon as the process updates.</p>
        <p><br></p>

        [button url="{{ accept_url }}" text="Accept Onboarding" type="success"]
        [button url="{{ reject_url }}" text="Reject Onboarding" type="danger"]

        <p><br></p>
        <p>Kind regards,</p>
        <p>{{ company.name }}</p>
    ',

    'text_template' => "
        Dear {{ user.first_name }},

        Your onboarding request has been created and is now being reviewed.
        We will notify you as soon as the process updates.

        Accept: {{ accept_url }}
        Reject: {{ reject_url }}

        Kind regards,
        {{ company.name }}
    ",
];
