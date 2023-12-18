<?php

require_once __DIR__ . '/../models/Dice4.php';
require_once __DIR__ . '/../models/Dice6.php';
require_once __DIR__ . '/../models/Dice8.php';
require_once __DIR__ . '/../models/Dice9.php';
require_once __DIR__ . '/../models/Dice10.php';
require_once __DIR__ . '/../models/Dice20.php';
require_once __DIR__ . '/../models/Roll.php';
require_once 'database/DB.php';
// require_once 'database/DB_functions.php';

DB::connect(
    'localhost',
    'dice_game',
    'root',
    ''
);
