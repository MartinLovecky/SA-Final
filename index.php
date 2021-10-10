<?php

session_start();

require(__DIR__ . '/vendor/autoload.php');

$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ );
$dotenv->load();
$dotenv->required(['DB_NAME','DB_USER','DB_HOST','DB_PASS']);

$blade = new eftec\bladeone\BladeOne(__DIR__ . '/views',__DIR__ . '/cache');
$blade->getCsrfToken(); 
$blade->setBaseUrl('/public'); 

$selector = new Repse\Sa\tool\Selector();
$selector->viewName();

$mailer = new Repse\Sa\tool\Mailer();
$db = new Repse\Sa\databese\DB();
$message = new Repse\Sa\support\MessageBag();

$request = new Repse\Sa\http\Request();
$request->getRequest();

$sanitizer = new Repse\Sa\support\Sanitizer($purifier);

$member = new Repse\Sa\databese\user\Member($db->con);
$validator = new Repse\Sa\support\Validator($message,$blade,$member);
$requestController = new Repse\Sa\controllers\RequestController($db->con,$mailer,$validator,$sanitizer);

$article = new Repse\Sa\databese\story\Article($db->con,$message);
$articleController = new Repse\Sa\controllers\ArticleController($selector,$article);
//NOTE testing coments delete when not needed
//dd($member->isUnique('Marthas95','x@seznam.cz'));
//$article->getArticle('allwin','3');
//move one dir up dirme(__DIR__,1)
//dd($articleController->getArticleFromCache('terror',1));

echo $blade->run('incl.app',include_once(__DIR__ . '/app/viewVariables.php'));
