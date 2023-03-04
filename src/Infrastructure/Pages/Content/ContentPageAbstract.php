<?php

namespace My\Infrastructure\Pages\Content;

use Dupot\StaticManagementFramework\Page\PageAbstract;
use Dupot\StaticManagementFramework\Render\Layout;
use Dupot\StaticManagementFramework\Render\View;
use My\Infrastructure\Pages\Content\events\EventsPage;
use My\Infrastructure\Pages\Content\Exhibitors\ExhibitorsPage;
use My\Infrastructure\Pages\Content\News\NewsPage;
use My\Infrastructure\Pages\Content\Publication\PublicationPage;
use My\Infrastructure\Pages\Content\Sellers\SellersPage;
use My\Infrastructure\Pages\Content\Tools\ImagePage;

class ContentPageAbstract extends PageAbstract
{
    protected $pageSelected = null;
    protected $layout = null;

    public function __construct()
    {
        $this->layout = new Layout(__DIR__ . '/../Layouts/AdminLayout.php');
        $this->addNavbar();
    }

    public function before()
    {
        if (!$this->isConnected()) {
            return $this->getResponse()->redirect('/');
        }
    }

    protected function isConnected()
    {
        if ($this->getRequest()->getSessionParamOr('userConnected', false)) {
            return true;
        }
        return false;
    }

    public function addNavbar()
    {

        $linkList = [
            (object)[
                'label' => 'Actualites',
                'link' => 'news.html',
                'pageSelected' => NewsPage::class
            ],
            (object)[
                'label' => 'Agenda',
                'link' => 'events.html',
                'pageSelected' => EventsPage::class
            ],
            (object)[
                'label' => 'Commercants',
                'link' => 'sellers.html',
                'pageSelected' => SellersPage::class

            ],
            (object)[
                'label' => 'Exposants',
                'link' => 'exhibitors.html',
                'pageSelected' => ExhibitorsPage::class

            ],


            (object)[
                'label' => 'Outils',
                'link' => 'image_resize.html',
                'pageSelected' => ImagePage::class

            ],


            (object)[
                'label' => 'Publier',
                'link' => 'publication.html',
                'pageSelected' => PublicationPage::class

            ],


        ];

        $view = new View(__DIR__ . '/navbarView.php', ['linkList' => $linkList, 'pageSelected' => $this->pageSelected]);

        $this->layout->assignContext('nav', $view);
    }

    public function render()
    {
        echo $this->layout->render();
    }
}
