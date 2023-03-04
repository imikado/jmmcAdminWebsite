<?php

namespace My\Infrastructure\Apis;

use My\Domain\Exhibitors\ExhibitorsApiInterface;

class ExhibitorsApi extends ContentApiAbstract implements ExhibitorsApiInterface
{
    protected $path = ROOT_DATA_PATH . '/Db/Exhibitors';
}
