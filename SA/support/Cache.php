<?php

namespace Repse\Sa\support;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class Cache{

    public function setCache(string $articleName , $article)
    {
        $cache = new FilesystemAdapter();
        $cacheItem = $cache->getItem(md5($articleName));

        if(!$cacheItem->isHit())
        {
            $cacheItem->set($article);
            $cache->save($cacheItem);
        }else
        {
            $item = $cacheItem->get();
            return $item;
        }
    }
}

