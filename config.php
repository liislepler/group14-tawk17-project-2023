<?php

// Run `node -e "console.log(require('crypto').randomBytes(32).toString('hex'))"`
// in terminal to generate secret
define('APPLICATION_NAME', 'Trackersaurus');
define('JWT_SECRET', 'bbfa5004bc1edabf0b89e3a15d07742584be8d1762dd91f27d5515c06');


// Set database connection info here
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'tracker_db');