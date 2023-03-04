<?php

namespace My\Infrastructure\Apis;

use My\Domain\Exhibitors\ExhibitorsApiInterface;

class ExhibitorsApi extends ContentApiAbstract implements ExhibitorsApiInterface
{
    protected $path = ROOT_STATIC_PATH . '/src/Data/Db/Exhibitors';
}
