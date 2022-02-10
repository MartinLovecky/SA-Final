<?php

namespace Repse\Sa\controllers;

use Repse\Sa\support\Cache;
use Repse\Sa\tool\Selector;
use Repse\Sa\databese\story\Article;

class ArticleController{

    public function __construct(protected Selector $selector,protected Article $article,protected Cache $cache){}

    public function inputArticleToCache()
    {
        if(isset($this->selector->article))
        {
            $parsedArticle = $this->cache->setCache($this->selector->article,$this->article->getArticle($this->selector->article,$this->selector->page));
            return $parsedArticle;
        }
    }

    public function getArticleFromCache()
    {   

        $args = func_get_args();
        if(!empty($args))
        {
            $parsedArticle = $this->cache->setCache($args[0],$this->article->getArticle($args[0],$args[1]));
            return $parsedArticle;
        }

    }

}