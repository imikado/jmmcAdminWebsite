<?php

namespace My\Infrastructure\Pages\Content\Publication;

use Dupot\StaticManagementFramework\Render\View;
use My\Infrastructure\Apis\EventsApi;
use My\Infrastructure\Apis\ExhibitorsApi;
use My\Infrastructure\Apis\NewsApi;
use My\Infrastructure\Apis\SellersApi;
use My\Infrastructure\Pages\Content\ContentPageAbstract;

class PublicationPage extends ContentPageAbstract
{
    protected $pageSelected = __CLASS__;

    protected $binaryPath = PHP_PATH;

    public function index()
    {

        $messageList = $this->processPublish();

        $view = new View(
            __DIR__ . '/views/index.php',
            ['messageList' => $messageList]
        );

        $this->layout->appendContext('contentList', $view);

        return $this->render();
    }

    protected function processPublish()
    {
        if (!$this->getRequest()->isMethodPost()) {
            return [];
        }

        $messageList = [];

        $postParamList = $this->getRequest()->getPostParamList();
        if (isset($postParamList['publish']) and $postParamList['publish'] == 1) {

            $messageList[] = 'Site généré avec succès:';

            $outputList = $this->publish();
            foreach ($outputList as $outputLoop) {
                $messageList[] = '- ' . $outputLoop;
            }
        }

        return $messageList;
    }

    protected function publish()
    {
        $staticProjectPath = $this->getConfigManager()->getSectionParam('path', 'root') . '/../' . $this->getConfigManager()->getSectionParam('path', 'static.project');

        /*
        $dbList = [
            (object)[
                'path' => 'static.db.news',
                'api' => new NewsApi(),
            ],

            (object)[
                'path' => 'static.db.events',
                'api' => new EventsApi(),
            ],

            (object)[
                'path' => 'static.db.sellers',
                'api' => new SellersApi(),
            ],

            (object)[
                'path' => 'static.db.exhibitors',
                'api' => new ExhibitorsApi(),
            ],


        ];

        foreach ($dbList as $dbLoop) {
            $staticDbPathLoop = $this->getConfigManager()->getSectionParam('path', $dbLoop->path);
            $apiLoop = $dbLoop->api;
            $localDbPathLoop = $apiLoop->getPath();
            $this->syncFromTo($localDbPathLoop, $staticProjectPath . '/' . $staticDbPathLoop);
        }
        */
        return $this->callGeneration($staticProjectPath);
    }

    protected function syncFromTo($fromPath, $toPath)
    {

        $this->callSystem("cp -rf $fromPath/*  $toPath/");
    }

    protected function callGeneration($path)
    {
        return $this->callSystem("cd $path/src ; " . $this->binaryPath . " generate.php");
    }

    protected function callSystem($cmd)
    {

        // echo '<pre>';
        //echo $cmd .= ' 2>&1';
        exec($cmd, $outputList);

        return $outputList;

        //echo '</pre>';
    }
}
