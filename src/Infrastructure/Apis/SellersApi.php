<?php

namespace My\Infrastructure\Apis;

use My\Domain\Sellers\SellersApiInterface;

class SellersApi extends ContentApiAbstract implements SellersApiInterface
{
    protected $path = ROOT_DATA_PATH . '/Db/Sellers';
}
