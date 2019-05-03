<?php
return [
    'url' => env('FRONTEND_URL', 'http://localhost:3000'), //フロントエンドのURL
    'reset_pass_url' => env('RESET_PASS_URL', '/auth/resetpassword?'), // フロントエンドのパスワードリセットページのURL
    'email_verify_url' => env('FRONTEND_EMAIL_VERIFY_URL', '/auth/emailverification?queryURL='), // メール認証のURL
    'parameter_queryUrl' => 'queryURL=',
    'parameter_token' => 'token=',
];
