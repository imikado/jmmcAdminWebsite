<?php

namespace My\Domain\News;

use Exception;

interface NewsApiInterface
{

    public function findById($id);
    public function update($id, object $news);
    public function delete($id): bool;
}
