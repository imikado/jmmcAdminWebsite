<?php

namespace My\Infrastructure\Pages\Auth;

use Dupot\StaticManagementFramework\Page\PageAbstract;
use Dupot\StaticManagementFramework\Render\Layout;
use Dupot\StaticManagementFramework\Render\View;

class AuthPage extends PageAbstract
{

    const SALT = 'm45CCY!';

    protected $layout = null;
    protected $userList = [];

    public function __construct()
    {

        $this->userList = [
            AUTH_ADMIN_LOGIN => $this->hashPassword(AUTH_ADMIN_PASSWORD)
        ];

        $this->layout = new Layout(__DIR__ . '/../Layouts/AuthLayout.php');
    }

    protected function hashPassword($password)
    {
        return sha1(self::SALT . $password);
    }

    public function login()
    {
        $errorList = $this->processLogin();

        $view = new View(
            __DIR__ . '/view.php',
            ['errorList' => $errorList]
        );

        $this->layout->appendContext('contentList', $view);

        return $this->render();
    }

    public function processLogin()
    {
        if (!$this->getRequest()->isMethodPost()) {
            return [];
        }

        $username = $this->getRequest()->getPostParam('username');
        $password = $this->getRequest()->getPostParam('password');

        if (isset($this->userList[$username]) and $this->userList[$username] == $this->hashPassword($password)) {
            $this->getRequest()->setSessionParam('userConnected', true);
            return $this->getResponse()->redirect(WEB_ROOT . '/index.php/news.html');
        }

        $this->getRequest()->setSessionParam('userConnected', false);

        return [
            'bad credentials'
        ];
    }

    public function render()
    {

        echo $this->layout->render();
    }
}
