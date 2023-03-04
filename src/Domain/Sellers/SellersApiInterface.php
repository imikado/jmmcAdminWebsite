<?php

namespace My\Domain\Sellers;

use Exception;

interface SellersApiInterface
{

    public function findById($id);
    public function update($id, object $sellers);
}
