<?php

return [
    'initial_account_password' => env('KESISWAAN_INITIAL_ACCOUNT_PASSWORD', env('KESISWAAN_INITIAL_STUDENT_PASSWORD')),
    'initial_student_password' => env('KESISWAAN_INITIAL_STUDENT_PASSWORD', env('KESISWAAN_INITIAL_ACCOUNT_PASSWORD')),
];
