<?php

namespace My\Domain\OtherPages;

use Exception;

interface OtherPagesApiInterface
{

    public function findById($id);
    public function update($id, object $otherPages);
}
