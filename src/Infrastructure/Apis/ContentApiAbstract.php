<?php

namespace My\Infrastructure\Apis;

use Exception;

abstract class ContentApiAbstract
{
    protected $path;

    public function getPath()
    {
        return $this->path;
    }

    public function findAll()
    {
        return $this->getAllItemList();
    }

    public function findById($id)
    {
        $filenameToFind = $this->getFilenameById($id);
        return $this->getItemByFilename($filenameToFind);
    }

    public function insert($contentObject)
    {
        $id = $this->getNextId();
        $this->write($id, $contentObject);

        file_put_contents($this->getMaxFilename(), ($id + 1));
    }
    public function update($id, $contentObject)
    {
        return $this->write($id, $contentObject);
    }

    public function delete($id): bool
    {

        $filenameToDelete = $this->getFilenameById($id);
        $filenameFullPath = $this->getPathForFilename($filenameToDelete);

        unlink($filenameFullPath);

        if (file_exists($filenameFullPath)) {
            throw new Exception('Error when try to delete path ' . $filenameFullPath);
        }
        return true;
    }


    protected function getMaxFilename()
    {
        return $this->getPathForFilename('max.txt');
    }


    public function getNextId()
    {

        if (!file_exists($this->getMaxFilename())) {
            return 1;
        }

        return trim(file_get_contents($this->getMaxFilename()));
    }

    protected function write($id, $contentObject)
    {
        $filenameToSave = $this->getFilenameById($id);

        file_put_contents($this->getPathForFilename($filenameToSave), json_encode($contentObject));
    }

    protected function getPathForFilename(string $filename): string
    {
        return $this->path . '/' . $filename;
    }

    protected function getFilenameById($id)
    {
        return $id . '.json';
    }

    protected function getIdFromFilename($filename)
    {
        return str_replace('.json', '', trim(basename($filename)));
    }

    protected function getItemByFilename($filenameToFind): object
    {
        $fileList = scandir($this->path);
        foreach ($fileList as $fileLoop) {

            if (!$this->isJson($fileLoop)) continue;

            $baseFilename = basename($fileLoop);

            if ($baseFilename == $filenameToFind) {
                return $this->getJsonContent($this->getPathForFilename($baseFilename));
            }
        }

        throw new Exception('Cannot find item by filename:' . $filenameToFind);
    }

    protected function getAllItemList(): array
    {
        $itemList = [];

        $fileList = scandir($this->path);
        foreach ($fileList as $fileLoop) {

            if (!$this->isJson($fileLoop)) continue;

            $baseFilename = basename($fileLoop);

            $itemList[] = $this->getJsonContent($this->getPathForFilename($baseFilename));
        }
        return $itemList;
    }

    protected function isJson(string $filename): bool
    {
        return (substr($filename, -5) === '.json');
    }

    protected function getJsonContent(string $filename): object
    {
        $contentObject = json_decode(file_get_contents($filename));
        $contentObject->id = $this->getIdFromFilename($filename);
        return $contentObject;
    }
}
