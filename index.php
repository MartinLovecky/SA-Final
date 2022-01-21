<?php

use eftec\bladeone\BladeOne;

require(__DIR__ . '/vendor/autoload.php');

session_set_cookie_params(0);
session_start();

$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$dotenv->required(['DB_NAME','DB_USER','DB_HOST','DB_PASS']);

$blade = new BladeOne(__DIR__ . '/views', __DIR__ . '/cache',BladeOne::MODE_AUTO);
$blade->setBaseUrl('/public/');
$blade->getCsrfToken();

/** $blade->setAuth('johndoe','admin');
 * @auth
 * The user is authenticated...
*@endauth
*
*@guest
*   The user is not authenticated...
*@endguest
 */

$selector = new Repse\Sa\tool\Selector();
$selector->viewName();

$mailer = new Repse\Sa\tool\Mailer();
$db = new Repse\Sa\databese\DB();
$message = new Repse\Sa\support\MessageBag($selector);

$request = new Repse\Sa\http\Request();
$request->getRequest();


$form = new Repse\Sa\tool\html\Forms();
$sanitizer = new Repse\Sa\support\Sanitizer();
$member = new Repse\Sa\databese\user\Member($db->con);
$member->checkRemember();
$validator = new Repse\Sa\support\Validator($message,$member);
$requestController = new Repse\Sa\controllers\RequestController($db,$mailer,$validator,$sanitizer,$message);
$article = new Repse\Sa\databese\story\Article($db->con,$message);
$articleController = new Repse\Sa\controllers\ArticleController($selector,$article);

echo $blade->run($selector->viewName,include(__DIR__ . '/app/viewVariables.php'));



