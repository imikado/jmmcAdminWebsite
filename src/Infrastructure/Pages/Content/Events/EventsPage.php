<?php

namespace My\Infrastructure\Pages\Content\events;

use Dupot\StaticManagementFramework\Render\View;
use My\Domain\Events\EventsCrud;
use My\Infrastructure\Apis\EventsApi;
use My\Infrastructure\Pages\Content\ContentPageAbstract;

class EventsPage extends ContentPageAbstract
{
    protected $pageSelected = __CLASS__;

    protected $eventsApi = null;

    public function __construct()
    {
        parent::__construct();

        $this->eventsApi = new EventsApi();
    }


    public function list()
    {

        $eventsList = $this->eventsApi->findAll();

        $view = new View(
            __DIR__ . '/views/list.php',
            ['eventsList' => $eventsList]
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

        $events = (object)[
            'title' => $postParamList['title'],
            'publication_date' => $postParamList['publication_date'],
            'content' => $postParamList['content'],
            'status' => isset($postParamList['active']) ? 'published' : 'draft'

        ];

        $this->eventsApi->insert($events);

        return $this->getResponse()->redirect('events.html');
    }

    public function edit($id)
    {
        $response = $this->processEdit($id);

        $view = new View(
            __DIR__ . '/views/edit.php',
            ['events' => $response->getItem(), 'errorList' => $response->getErrorList()]
        );

        $this->enrichForm($view);


        return $this->render();
    }

    public function processEdit($id)
    {
        $newsCrud = new EventsCrud();
        $newsCrud->setSubmitEnabled($this->getRequest()->isMethodPost());
        $newsCrud->setSubmitFieldList($this->getRequest()->getPostParamList());
        $newsCrud->setRepositoryApi(new EventsApi());
        $response = $newsCrud->update($id);

        if ($response->isStatusSuccess()) {
            return $this->getResponse()->redirect('events.html');
        }

        return $response;
    }
    /*
    protected function OFFprocessEdit($newsInDatabase)
    {
        if (!$this->getRequest()->isMethodPost()) {
            return [];
        }

        $postParamList = $this->getRequest()->getPostParamList();

        $validator = new Validator($postParamList);
        $validator->isNotEmpty('title', 'Vous devez remplir le titre');
        if (!$validator->isValid()) {
            return $validator->getErrorList();
        }

        $newsInDatabase->title = $postParamList['title'];
        $newsInDatabase->publication_date = $postParamList['publication_date'];
        $newsInDatabase->content = $postParamList['content'];
        $newsInDatabase->status = isset($postParamList['active']) ? 'published' : 'draft';

        $newsApi = new EventsApi();
        $newsApi->update($newsInDatabase->id, $newsInDatabase);

        return $this->getResponse()->redirect('events.html');
    }
    */
}
