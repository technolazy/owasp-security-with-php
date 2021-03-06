<?php

namespace security\Controllers\Corporate;

require_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'public/init.php';

use \security\Controllers\Corporate\BaseCorporateController;
use \security\Models\Authenticator\Authenticate;
use \security\Models\Authenticator\CheckAuth;
use \security\Models\Corporate\DestroySessionCorporate;
use \security\Models\ErrorRunner;
use \security\Models\SessionInitializers;
use \security\Models\SiteLogger\FullLog;
use \security\Models\Router\Router;
use \stdClass;

class DestroySessionCorporateController extends BaseCorporateController
{
    public function __construct(stdClass $models, stdClass $userData)
    {
        isset($models->init) && $models->init instanceof SessionInitializers ?
        $this->setInit($models->init) : $this->setDefaultInit();
        $this->destroy = new DestroySessionCorporate($this->init);
    }
    public function setInit(SessionInitializers $init)
    {
        $this->init = $init;
    }
    protected function setDefaultInit()
    {
        $this->init = new SessionInitializers();
    }
    public function destroySession()
    {
        $this->data['loggedout'] = $this->destroy->destroySession();
    }
    public function jsonSerialize()
    {
        return $this->data;
    }
}

if (isset($_POST['submit']) || isset($_GET)) {
    extract($_POST);
    extract($_GET);
    $auth = new Authenticate();
    $isAjax = (isset($isAjax) && $auth->isAjax()) ? true : false;
    $errorRunner = new ErrorRunner();
    $logger = new FullLog('User Logging out');
    $checkAuth = new CheckAuth($logger);
    $init = new SessionInitializers();
    $errors = [];

    $isUser = $checkAuth->isAuth();
    $csrf = !empty($csrf) ? $csrf : null;
    $session = isset($_SESSION) ? $_SESSION : null;

    $csrf || $errors[] = "There is no token for this account.  You have most likely timed out.";
    $isUser || $errors[] = "You are not authenticated as an user.";
    $session || $errors[] = "You do not have a session identifier.";

    if (!isset($_SESSION['csrf_token']) || $_SESSION['csrf_token'] !== $csrf) {
        $errors[] = "You do not have permission to perform that action.";
    }
    $userData = new stdClass;
    $userData->session = $session;

    $modelObjects = new stdClass;
    $modelObjects->init = $init;
    if (empty($errors)) {
        $controller = new DestroySessionCorporateController($modelObjects, $userData);
        $controller->destroySession();
        if ($isAjax) {
            echo json_encode($controller);
        }
        if (!$isAjax) {
            // Do something else
        }
    }
    if (!empty($errors)) {
        $router = new Router(__DIR__);
        $redirectHome = $router->getRootPath() . "goodsite/";
        // You can use this to pass a redirection location to the browser.
        // But we will use javaScript to pass the URL through.
        $errorRunner->runErrors($errors);
    }
}
