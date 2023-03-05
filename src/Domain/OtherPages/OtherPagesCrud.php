<?php

namespace My\Domain\OtherPages;

use Exception;
use My\Domain\Shared\Response\CrudResponse;
use My\Domain\Shared\Tools\Validator;

class OtherPagesCrud
{
    protected $submitEnabled = false;
    protected $submitFieldList = [];
    protected $repositoryApi = null;


    public function setSubmitEnabled(bool $enabled)
    {
        $this->submitEnabled = $enabled;
    }

    public function setSubmitFieldList(array $submitFieldList)
    {
        $this->submitFieldList = $submitFieldList;
    }
    protected function getSubmitField(string $field)
    {
        return $this->submitFieldList[$field];
    }
    protected function hasSubmitField(string $field)
    {
        return array_key_exists($field, $this->submitFieldList);
    }
    public function setRepositoryApi(OtherPagesApiInterface $newsApi)
    {
        $this->repositoryApi = $newsApi;
    }

    protected function getRepositoryApi()
    {
        if ($this->repositoryApi === null) {
            throw new Exception('Missing repositoryApi');
        }

        return $this->repositoryApi;
    }

    public function update($id): CrudResponse
    {

        $newsInDatabase = $this->getRepositoryApi()->findById($id);

        if (!$this->submitEnabled) {
            $response = new CrudResponse();
            $response->setItem($newsInDatabase);
            return $response;
        }

        $newsInDatabase->content = $this->getSubmitField('content');
        $newsInDatabase->status =  'published';


        $validator = new Validator($newsInDatabase);
        $validator->isNotEmpty('content', 'Vous devez remplir un contenu');

        if (!$validator->isValid()) {

            $response = new CrudResponse();
            $response->setItem($newsInDatabase);
            $response->setErrorList($validator->getErrorList());

            return $response;
        }

        $this->getRepositoryApi()->update($newsInDatabase->id, $newsInDatabase);

        $response = new CrudResponse();
        $response->setStatusSuccess();

        return $response;
    }
}
