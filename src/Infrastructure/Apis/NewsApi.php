<?php

namespace My\Infrastructure\Apis;

use My\Domain\News\NewsApiInterface;

class NewsApi extends ContentApiAbstract implements NewsApiInterface
{
    protected $path = ROOT_DATA_PATH . '/Db/News';
}
