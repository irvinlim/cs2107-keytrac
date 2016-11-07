<?php
global $config;

// KeyTrac auth token.
$config['keytrac_auth_token'] = '<AUTH_TOKEN>';

// Enter the user_id for an existing KeyTrac user to enrol him, instead of registering a new user.
$config['keytrac_existing_user'] = '';

// MySQL connection options.
$config['mysql_user'] = '<USERNAME>';
$config['mysql_pass'] = '<PASSWORD>';
$config['mysql_host'] = '<HOSTNAME>';
$config['mysql_db'] = '<DATABASE>';

// Enter a random string that will be used to salt the hashes.
$config['random_salt'] = '';