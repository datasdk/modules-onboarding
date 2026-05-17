<?php
return [
    'subject' => 'Din onboarding blev afvist',

    'html_template' => '
        <p>Kære {{ user.first_name }},</p>
        <p>Desværre er din onboarding-anmodning for firmaet <strong>{{ company.name }}</strong> (CVR: {{ company.vat }}) blevet afvist.</p>
        <p>Hvis du mener, dette er en fejl, bedes du kontakte vores support.</p>
        <p><br></p>
        <p>Med venlig hilsen,</p>
        <p>{{ company.name }}</p>
    ',

    'text_template' => "
        Kære {{ user.first_name }},

        Desværre er din onboarding-anmodning for firmaet {{ company.name }} (CVR: {{ company.vat }}) blevet afvist.
        Hvis du mener, dette er en fejl, bedes du kontakte vores support.

        Med venlig hilsen,
        {{ company.name }}
    ",
];
