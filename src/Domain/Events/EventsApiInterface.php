<?php

namespace My\Domain\Events;

use Exception;

interface EventsApiInterface
{

    public function findById($id);
    public function update($id, object $events);
}
