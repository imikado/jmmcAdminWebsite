<?php

namespace My\Domain\Exhibitors;

use Exception;

interface ExhibitorsApiInterface
{

    public function findById($id);
    public function update($id, object $exhibitors);
}
