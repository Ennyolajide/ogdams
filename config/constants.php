<?php

return [

    'site' => [
        'url' => env('APP_URL'),
        'name' => env('APP_NAME'),
        'email' => 'support@ogdams.com',
        'phone' => '+234 9066 6857 02',
        'telegram' => 'https://t.me/ogdams',
        'address' => 'Camp, Abeokuta, Ogun State, Nigeria.',
        'twitter' => 'https://twitter.com/ogdamstech',
        'facebook' => 'https://facebook.com/ogdams',
        'instagram' => 'https://instagram.com/ogdamstech',
        'google' => '#',
        'linkedin' => '#',
        'bussinessName' => 'Ogdams Technologies',
        'googleMap' => 'https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d7916.862982549558!2d3.4318005225864616!3d7.1915070292316345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x103a363bcdd152df%3A0xf3ab70233638c6ec!2sCamp%2C+Abeokuta!3m2!1d7.194497999999999!2d3.4359531!5e0!3m2!1sen!2sng!4v1564561313169!5m2!1sen!2sng',
        'about' => '©2020 Copyright Ogdams Technologies. All Rights Reserved.',

        'sms' => [
            'sender' => env('SITE_SMS_SENDER'),
        ],

        'emails' => [
            'sender' => [
                'name' => env('SITE_EMAIL_SENDER'),
                'noreply' => env('SITE_EMAIL_SENDER_NOREPLY'),
            ]

        ]
    ],

    'api' => [
        'url' => 'https://documenter.getpostman.com/view/6362674/SVtYTSdn?version=latest'
    ],

    'livechat' => [
        'tawk' => 'https://embed.tawk.to/5d9e09dff82523213dc67a21/default'
    ],

    'fundings' => [
        'paystack' => [
            'min' =>  500,
            'max' =>  2499,
        ]
    ],

    'url' => [
        'paystack' => 'https://api.paystack.co/',
        'ringo'  => 'https://sales.ringo.ng/api/',
        'smartsmssolutions' => 'https://smartsmssolutions.com/api/',
        'freecurrencyconveter' => 'https://free.currconv.com/api/v7/'
    ],

    'smartsmssolutions' => [
        'token' => env('SMARTSMSSOLUTION_TOKEN')
    ],

    'ringo' => [
        'username' => env('RINGO_USERNAME'),
        'password' => env('RINGO_PASSWORD'),
    ],

    'paystack' => [
        'secretkey' => env('PAYSTACK_SECRET_KEY'),
    ],


    'charges' => [
        'paystack' => [
            'cappedCharge' => 2000,
            'addtionalCharge' => 0,
            'chargePercentage' => 0,
        ],
    ],

    'bonuses' => [
        'referral' => 100,
    ],

    'hostedSims' => [
        'url' => 'https://ussd.simhosting.ng/api/?',
        'apiToken' => env('SINGLE_HOSTED_SIM_API_TOKEN'),

    ],

    'twilio' => [
        'sid' => env('TWILIO_SID'),
        'token' => env('TWILIO_TOKEN'),
        'number' => env('TWILIO_NUMBER'),
    ]

];
