<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Alert Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain alert messages for various scenarios
    | during CRUD operations. You are free to modify these language lines
    | according to your application's requirements.
    |
    */

    'backend' => [

        //added
        'permissions' => [
            'created' => 'The permission was successfully created.',
            'updated' => 'The permission was successfully updated.',
            'deleted' => 'The permission was successfully deleted.',
        ],
        //added
        'countries' => [
            'created' => 'The country was successfully created.',
            'updated' => 'The country was successfully updated.',
            'deleted' => 'The country was successfully deleted.',
        ],
        'roles' => [
            'created' => 'The role was successfully created.',
            'deleted' => 'The role was successfully deleted.',
            'updated' => 'The role was successfully updated.',
        ],

        'users' => [
            'cant_resend_confirmation' => 'The application is currently set to manually approve users.',
            'confirmation_email'  => 'A new confirmation e-mail has been sent to the address on file.',
            'confirmed'              => 'The user was successfully confirmed.',
            'created'             => 'The user was successfully created.',
            'deleted'             => 'The user was successfully deleted.',
            'deleted_permanently' => 'The user was deleted permanently.',
            'restored'            => 'The user was successfully restored.',
            'session_cleared'      => "The user's session was successfully cleared.",
            'social_deleted' => 'Social Account Successfully Removed',
            'unconfirmed' => 'The user was successfully un-confirmed',
            'updated'             => 'The user was successfully updated.',
            'updated_password'    => "The user's password was successfully updated.",
        ],
        'forms' => [
            'created' => 'The form was successfully created.',
            'updated' => 'The form was successfully updated.',
            'deleted' => 'The form was successfully deleted.',
        ],
        'skiplogics' => [
            'created' => 'The skip logic was successfully created.',
            'updated' => 'The skip logic was successfully updated.',
            'deleted' => 'The skip logic was successfully deleted.',
        ],
        'questions' => [
            'created' => 'The question was successfully created.',
            'updated' => 'The question was successfully updated.',
            'deleted' => 'The question was successfully deleted.',
        ],
    ],

    'frontend' => [
        'contact' => [
            'sent' => 'Your information was successfully sent. We will respond back to the e-mail provided as soon as we can.',
        ],
    ],
];
