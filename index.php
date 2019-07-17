<?php

require_once 'vendor/autoload.php';
require_once 'core/config.php';

/**
 * Getting updates from webhook
 */
$update = file_get_contents("php://input");
$update = json_decode($update, false);

$connectionService = new \SimpleTelegramBot\Connection\CurlConnectionService();

/**
 * Init Commander
 */
$commander = new \Core\Base\Commander($update, $connectionService);

/**
 * Set commands and reactions on it
 */
$commander->command('/start', \Core\Actions\StartAction::class);
$commander->command('/save', \Core\Actions\SaveAction::class);
$commander->command('/me', \Core\Actions\MeAction::class);

/**
 * Run commander
 */
$commander->run();