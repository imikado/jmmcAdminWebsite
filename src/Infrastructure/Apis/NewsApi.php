<?php

namespace My\Infrastructure\Apis;

use My\Domain\News\NewsApiInterface;

class NewsApi extends ContentApiAbstract implements NewsApiInterface
{
    protected $path = ROOT_STATIC_PATH . '/src/Data/Db/News';
}
