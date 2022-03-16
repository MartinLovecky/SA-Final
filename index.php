<?php

use eftec\bladeone\BladeOne;

require(__DIR__ . '/vendor/autoload.php');

session_set_cookie_params(0);
session_start();
ob_start();

$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);
//NOTE: You need create your own .env in root directory 
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$dotenv->required(['DB_NAME','DB_USER','DB_HOST','DB_PASS']);

$blade = new BladeOne(__DIR__ . '/views', __DIR__ . '/cache',BladeOne::MODE_AUTO);
$blade->setBaseUrl('/public/');
$blade->getCsrfToken();

$selector = new Repse\Sa\tool\Selector();
//NOTE: allowedViews must have '' inside array otherwise index will not work.
//NOTE: Page must exist inside views  
$selector->allowedViews = require(__DIR__ . '/app/allowedViews.php');
$selector->viewName();

$mailer = new Repse\Sa\tool\Mailer();
//NOTE: $db->con returns fluent PDO (https://www.sitepoint.com/getting-started-fluentpdo/) 
//NOTE: IF you need use Build in function from PDO or your own functions from DB in other class use only $db
$db = new Repse\Sa\databese\DB();
$message = new Repse\Sa\support\MessageBag($selector);

$request = new Repse\Sa\http\Request();
$request->getRequest();

$wrapper = new Repse\Sa\tool\html\Wrapper($selector);
$form = new Repse\Sa\tool\html\Forms();
$member = new Repse\Sa\databese\user\Member($db,$message);
$validator = new Repse\Sa\support\Validator($message,$member);
$requestController = new Repse\Sa\controllers\RequestController($db,$mailer,$validator,$message);
//TODO: ArticleController functions update,delete,create returns void later they should return message
$article = new Repse\Sa\databese\story\Article($db->con,$message);
$articleController = new Repse\Sa\controllers\ArticleController($db->con);

$member->checkRemember();

echo $blade->run($selector->viewName,include(__DIR__ . '/app/viewVariables.php'));