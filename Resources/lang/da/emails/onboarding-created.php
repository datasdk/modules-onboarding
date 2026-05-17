<?php
return [
    'subject' => 'En onboarding er blevet oprettet',

    'html_template' => '
        <p>Kære admin,</p>
        <p>Din onboarding-anmodning er blevet oprettet og er nu under gennemgang.</p>
        <p>Vi vil give dig besked, så snart processen opdateres.</p>
        <p><br></p>

        [button url="{{ accept_url }}" text="Godkend" type="success"]
        [button url="{{ reject_url }}" text="Afvis" type="danger"]

        <p><br></p>
        <p>Med venlig hilsen,</p>
        <p>{{ company.name }}</p>
    ',

    'text_template' => "
        Kære {{ user.first_name }},

        Din onboarding-anmodning er blevet oprettet og er nu under gennemgang.
        Vi vil give dig besked, så snart processen opdateres.

        Godkend: {{ accept_url }}
        Afvis: {{ reject_url }}

        Med venlig hilsen,
        {{ company.name }}
    ",
];
