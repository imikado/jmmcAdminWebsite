<?php

namespace My\Infrastructure\Pages\Content\OtherPages;

use Dupot\StaticManagementFramework\Render\View;
use My\Domain\OtherPages\OtherPagesCrud;
use My\Infrastructure\Apis\OtherPagesApi;
use My\Infrastructure\Pages\Content\ContentPageAbstract;

class OtherPagesPage extends ContentPageAbstract
{
    protected $pageSelected = __CLASS__;

    protected $otherPagesApi = null;

    public function __construct()
    {
        parent::__construct();

        $this->otherPagesApi = new OtherPagesApi();
    }


    public function list()
    {

        $otherPagesList = $this->otherPagesApi->findAll();

        $view = new View(
            __DIR__ . '/views/list.php',
            ['otherPagesList' => $otherPagesList]
        );

        $this->layout->appendContext('contentList', $view);

        return $this->render();
    }

    public function addWysiwygForTextId(string $textareaId)
    {
        $view = new View(
            __DIR__ . '/../SharedViews/wysiwyg.php',
            ['textareaId' => $textareaId]
        );

        $this->layout->appendContext('contentList', $view);
    }

    public function addDatePicker()
    {
        $view = new View(
            __DIR__ . '/../SharedViews/datePicker.php',
            []
        );

        $this->layout->appendContext('contentList', $view);
    }

    public function addBeforeWysiwyg()
    {
        $view = new View(
            __DIR__ . '/../SharedViews/beforeWysiwyg.php',
            []
        );

        $this->layout->appendContext('contentList', $view);
    }



    protected function enrichForm($view)
    {
        $this->addBeforeWysiwyg();
        $this->layout->appendContext('contentList', $view);
        $this->addDatePicker();
    }

    public function add()
    {

        $this->processAdd();

        $view = new View(
            __DIR__ . '/views/add.php',
            []
        );

        $this->enrichForm($view);

        return $this->render();
    }

    protected function processAdd()
    {
        if (!$this->getRequest()->isMethodPost()) {
            return;
        }

        $postParamList = $this->getRequest()->getPostParamList();

        $otherPages = (object)[
            'title' => $postParamList['title'],
            'content' => $postParamList['content'],
            'status' => isset($postParamList['active']) ? 'published' : 'draft'

        ];

        $this->otherPagesApi->insert($otherPages);

        return $this->getResponse()->redirect('otherPages.html');
    }

    public function edit($id)
    {
        $response = $this->processEdit($id);

        $view = new View(
            __DIR__ . '/views/edit.php',
            ['otherPages' => $response->getItem(), 'errorList' => $response->getErrorList()]
        );

        $this->enrichForm($view);


        return $this->render();
    }

    public function processEdit($id)
    {
        $otherPagesCrud = new OtherPagesCrud();
        $otherPagesCrud->setSubmitEnabled($this->getRequest()->isMethodPost());
        $otherPagesCrud->setSubmitFieldList($this->getRequest()->getPostParamList());
        $otherPagesCrud->setRepositoryApi(new OtherPagesApi());
        $response = $otherPagesCrud->update($id);

        if ($response->isStatusSuccess()) {
            return $this->getResponse()->redirect('otherPages.html');
        }

        return $response;
    }
}
