<?php
return [
    'subject' => 'Din onboarding er blevet godkendt',

    'html_template' => '
        <p>Kære {{ user.first_name }},</p>
        <p>Din onboarding er blevet godkendt, og firmaet <strong>{{ company.name }}</strong> (CVR: {{ company.vat }}) er nu officielt godkendt på platformen.</p>
        <p>Du har nu fuld adgang til platformen.</p>
        <p><br></p>
        <p>Med venlig hilsen,</p>
        <p>{{ company.name }}</p>
    ',

    'text_template' => "
        Kære {{ user.first_name }},

        Din onboarding er blevet godkendt, og firmaet {{ company.name }} (CVR: {{ company.vat }}) er nu officielt godkendt på platformen.
        Du har nu fuld adgang til platformen.

        Med venlig hilsen,
        {{ company.name }}
    ",
];
