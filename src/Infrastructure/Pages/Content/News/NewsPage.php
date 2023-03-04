<?php

namespace My\Infrastructure\Pages\Content\News;

use Dupot\StaticManagementFramework\Render\View;
use My\Domain\News\NewsCrud;
use My\Domain\Tools\Validator;
use My\Infrastructure\Apis\NewsApi;
use My\Infrastructure\Pages\Content\ContentPageAbstract;

class NewsPage extends ContentPageAbstract
{
    protected $pageSelected = __CLASS__;

    protected $newsApi = null;

    public function __construct()
    {
        parent::__construct();

        $this->newsApi = new NewsApi();
    }


    public function list()
    {

        $newsList = $this->newsApi->findAll();

        $view = new View(
            __DIR__ . '/views/list.php',
            ['newsList' => $newsList]
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

        $news = (object)[
            'title' => $postParamList['title'],
            'publication_date' => $postParamList['publication_date'],
            'content' => $postParamList['content'],
            'status' => isset($postParamList['active']) ? 'published' : 'draft'

        ];

        $this->newsApi->insert($news);

        return $this->getResponse()->redirect('news.html');
    }

    public function edit($id)
    {
        $response = $this->processEdit($id);

        $view = new View(
            __DIR__ . '/views/edit.php',
            ['news' => $response->getItem(), 'errorList' => $response->getErrorList()]
        );

        $this->enrichForm($view);


        return $this->render();
    }

    public function processEdit($id)
    {
        $newsCrud = new NewsCrud();
        $newsCrud->setSubmitEnabled($this->getRequest()->isMethodPost());
        $newsCrud->setSubmitFieldList($this->getRequest()->getPostParamList());
        $newsCrud->setRepositoryApi(new NewsApi());
        $response = $newsCrud->update($id);

        if ($response->isStatusSuccess()) {
            return $this->getResponse()->redirect('news.html');
        }

        return $response;
    }

    public function delete($id)
    {
        $response = $this->processDelete($id);

        $view = new View(
            __DIR__ . '/views/delete.php',
            ['news' => $response->getItem(), 'errorList' => $response->getErrorList()]
        );

        $this->enrichForm($view);


        return $this->render();
    }

    public function processDelete($id)
    {
        $newsCrud = new NewsCrud();
        $newsCrud->setSubmitEnabled($this->getRequest()->isMethodPost());
        $newsCrud->setSubmitFieldList($this->getRequest()->getPostParamList());
        $newsCrud->setRepositoryApi(new NewsApi());
        $response = $newsCrud->delete($id);

        if ($response->isStatusSuccess()) {
            return $this->getResponse()->redirect('news.html');
        }

        return $response;
    }
}
