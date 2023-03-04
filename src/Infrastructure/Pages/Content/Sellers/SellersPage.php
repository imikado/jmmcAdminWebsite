<?php

namespace My\Infrastructure\Pages\Content\Sellers;

use Dupot\StaticManagementFramework\Render\View;
use My\Domain\Sellers\SellersCrud;
use My\Infrastructure\Apis\SellersApi;
use My\Infrastructure\Pages\Content\ContentPageAbstract;

class SellersPage extends ContentPageAbstract
{
    protected $pageSelected = __CLASS__;

    protected $sellersApi = null;

    public function __construct()
    {
        parent::__construct();

        $this->sellersApi = new SellersApi();
    }


    public function list()
    {

        $sellersList = $this->sellersApi->findAll();

        $view = new View(
            __DIR__ . '/views/list.php',
            ['sellersList' => $sellersList]
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

        $sellers = (object)[
            'title' => $postParamList['title'],
            'content' => $postParamList['content'],
            'status' => isset($postParamList['active']) ? 'published' : 'draft'

        ];

        $this->sellersApi->insert($sellers);

        return $this->getResponse()->redirect('sellers.html');
    }

    public function edit($id)
    {
        $response = $this->processEdit($id);

        $view = new View(
            __DIR__ . '/views/edit.php',
            ['sellers' => $response->getItem(), 'errorList' => $response->getErrorList()]
        );

        $this->enrichForm($view);


        return $this->render();
    }

    public function processEdit($id)
    {
        $sellersCrud = new SellersCrud();
        $sellersCrud->setSubmitEnabled($this->getRequest()->isMethodPost());
        $sellersCrud->setSubmitFieldList($this->getRequest()->getPostParamList());
        $sellersCrud->setRepositoryApi(new SellersApi());
        $response = $sellersCrud->update($id);

        if ($response->isStatusSuccess()) {
            return $this->getResponse()->redirect('sellers.html');
        }

        return $response;
    }
}
