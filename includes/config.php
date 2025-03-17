<?php
// Database configuration (this is just for structure - we're using a fake DB)
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'futureskill_db');

// Site configuration
define('SITE_URL', 'http://localhost/futureskill-clone');
define('SITE_NAME', 'FutureSkill Clone');
define('SITE_DESCRIPTION', 'แหล่งรวมคอร์สเรียนออนไลน์พัฒนาทักษะในอนาคต เรียน Data, Tech, Business และ Creative ครอบคลุมทุกสายงาน');

// Default thumbnail if no image is available
define('DEFAULT_THUMBNAIL', SITE_URL . '/assets/images/default-thumbnail.jpg');

// Currency settings
define('CURRENCY_SYMBOL', '฿');
define('DECIMAL_POINT', '.');
define('THOUSANDS_SEPARATOR', ',');
