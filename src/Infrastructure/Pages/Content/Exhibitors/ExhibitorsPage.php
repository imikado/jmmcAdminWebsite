<?php

namespace My\Infrastructure\Pages\Content\Exhibitors;

use Dupot\StaticManagementFramework\Render\View;
use My\Domain\Exhibitors\ExhibitorsCrud;
use My\Infrastructure\Apis\ExhibitorsApi;
use My\Infrastructure\Pages\Content\ContentPageAbstract;

class ExhibitorsPage extends ContentPageAbstract
{
    protected $pageSelected = __CLASS__;

    protected $exhibitorsApi = null;

    public function __construct()
    {
        parent::__construct();

        $this->exhibitorsApi = new ExhibitorsApi();
    }


    public function list()
    {

        $exhibitorsList = $this->exhibitorsApi->findAll();

        $view = new View(
            __DIR__ . '/views/list.php',
            ['exhibitorsList' => $exhibitorsList]
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

        $exhibitors = (object)[
            'title' => $postParamList['title'],
            'content' => $postParamList['content'],
            'status' => isset($postParamList['active']) ? 'published' : 'draft'

        ];

        $this->exhibitorsApi->insert($exhibitors);

        return $this->getResponse()->redirect('exhibitors.html');
    }

    public function edit($id)
    {
        $response = $this->processEdit($id);

        $view = new View(
            __DIR__ . '/views/edit.php',
            ['exhibitors' => $response->getItem(), 'errorList' => $response->getErrorList()]
        );

        $this->enrichForm($view);


        return $this->render();
    }

    public function processEdit($id)
    {
        $exhibitorsCrud = new ExhibitorsCrud();
        $exhibitorsCrud->setSubmitEnabled($this->getRequest()->isMethodPost());
        $exhibitorsCrud->setSubmitFieldList($this->getRequest()->getPostParamList());
        $exhibitorsCrud->setRepositoryApi(new ExhibitorsApi());
        $response = $exhibitorsCrud->update($id);

        if ($response->isStatusSuccess()) {
            return $this->getResponse()->redirect('exhibitors.html');
        }

        return $response;
    }
}
