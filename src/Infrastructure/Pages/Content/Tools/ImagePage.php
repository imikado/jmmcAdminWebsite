<?php

namespace My\Infrastructure\Pages\Content\Tools;

use Dupot\StaticManagementFramework\Render\View;
use My\Infrastructure\Pages\Content\ContentPageAbstract;

class ImagePage extends ContentPageAbstract
{
    protected $pageSelected = __CLASS__;

    protected $binaryPath = PHP_PATH;

    public function index()
    {

        $messageList = $this->processImageResize();

        $view = new View(
            __DIR__ . '/views/imageResize.php',
            ['messageList' => $messageList]
        );

        $this->layout->appendContext('contentList', $view);

        return $this->render();
    }

    protected function processImageResize()
    {
        if (!$this->getRequest()->isMethodPost()) {
            return [];
        }

        $messageList = [];

        $postParamList = $this->getRequest()->getPostParamList();
        if (isset($_FILES['imageToResizePath']) and isset($postParamList['imageToResizeWidth'])) {

            $imageFile = $_FILES['imageToResizePath'];
            $imageWidth = $postParamList['imageToResizeWidth'];

            $tmpName = $imageFile['tmp_name'];
            $name = $imageFile['name'];

            $this->imageResize($tmpName, $name, $imageWidth);
        }

        return $messageList;
    }


    protected function callSystem($cmd)
    {

        // echo '<pre>';
        //echo $cmd .= ' 2>&1';
        exec($cmd, $outputList);

        return $outputList;

        //echo '</pre>';
    }

    protected function imageResize($file_name, $name, $width, $height = 0)
    {
        list($wid, $ht) = getimagesize($file_name);
        $r = $wid / $ht;

        $new_height = $width / $r;
        $new_width = $width;


        $source = imagecreatefromjpeg($file_name);
        $dst = imagecreatetruecolor($new_width, $new_height);

        imagecopyresized($dst, $source, 0, 0, 0, 0, $new_width, $new_height, $wid, $ht);


        $newFilename = $width . '_' . basename($name);

        header('Content-Type: application/force-download');
        header('Content-Disposition: attachment; filename=' . $newFilename);

        header('Content-Type: image/jpeg');


        // Output
        imagejpeg($dst);
    }
}
