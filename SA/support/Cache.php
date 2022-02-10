<?php

namespace Repse\Sa\support;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class Cache{

    public function __construct(protected FilesystemAdapter $FilesystemAdapter){}

    public function setCache(string $articleName , $article)
    {
        $cacheItem = $this->FilesystemAdapter->getItem(md5($articleName));

        if(!$cacheItem->isHit())
        {
            $cacheItem->set($article);
            $cache->save($cacheItem);
        }
    }
    public function getCache()
    {
        return $this->FilesystemAdapter->get();
    }
}

