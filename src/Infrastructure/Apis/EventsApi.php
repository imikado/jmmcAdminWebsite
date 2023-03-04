<?php

namespace My\Infrastructure\Apis;

use My\Domain\Events\EventsApiInterface;

class EventsApi extends ContentApiAbstract implements EventsApiInterface
{
    protected $path = ROOT_STATIC_PATH . '/src/Data/Db/Events';
}
