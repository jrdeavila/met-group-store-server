<?php


return [
  'expected_json' => [
    'help' => 'Please, provide a valid JSON body',
    'error' => 'Request without JSON body'
  ],
  'login_user_not_exist' => [
    'help' => 'Please, try with another credentials',
    'error' => 'User not exist to authentication'
  ],
  'register_user_exist' => [
    'help' => 'Try to use different username',
    'error' => 'Username is used for another user',
  ],
  'login_failed' => [
    'help' => 'Try to provide the correct password',
    'error' => 'Invalid password',
  ],
  'form_validation' => [
    'help' => 'Some of the fields were sended with invalid format',
  ],
  'store_exist' => [
    'help' => 'Try with another name',
    'error' => 'Store Already Exist',
  ],
];
