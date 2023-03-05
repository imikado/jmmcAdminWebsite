<?php

namespace My\Infrastructure\Apis;

use My\Domain\OtherPages\OtherPagesApiInterface;

class OtherPagesApi extends ContentApiAbstract implements OtherPagesApiInterface
{
    protected $path = ROOT_DATA_PATH . '/Db/OtherPages';
}
