<?php

namespace My\Infrastructure\Apis;

use My\Domain\Sellers\SellersApiInterface;

class SellersApi extends ContentApiAbstract implements SellersApiInterface
{
    protected $path = ROOT_STATIC_PATH . '/src/Data/Db/Sellers';
}
