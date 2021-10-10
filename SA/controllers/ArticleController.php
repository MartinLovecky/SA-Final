<?php

namespace Repse\Sa\controllers;

use Repse\Sa\support\Cache;
use Repse\Sa\tool\Selector;
use Repse\Sa\databese\story\Article;

class ArticleController{

    public function __construct(protected Selector $selector,protected Article $article){}

    public function getArticleFromCache()
    {   
        $cache = new Cache();

        if(isset($this->selector->article))
        {
            // frist element is key name  
            $parsedArticle = $cache->setCache($this->selector->article,$this->article->getArticle($this->selector->article,$this->selector->page));
            return $parsedArticle;
        }
        $args = func_get_args();
        if(!empty($args))
        {
            $parsedArticle =  $cache->setCache($args[0],$this->article->getArticle($args[0],$args[1]));
            return $parsedArticle;
        }

    }

}