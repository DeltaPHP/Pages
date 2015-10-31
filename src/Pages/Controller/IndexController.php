<?php
/**
 * User: Vasiliy Shvakin (orbisnull) zen4dev@gmail.com
 */

namespace Pages\Controller;

use DeltaCore\AbstractController;
use DeltaRouter\Exception\NotFoundException;
use Pages\Model\Parts\PagesManager;

class IndexController extends AbstractController
{
    use PagesManager;

    public function viewAction($params)
    {
        if (!isset($params["name"])) {
            $this->getResponse()->redirect("/");
        }

        $name = $params["name"];
        $manager = $this->getPagesManager();
        $item = $manager->findOne(["name" => $name]);
        if (!$item) {
            throw new NotFoundException("Page $name not found");
        }
        $this->getView()->assign("item", $item);
        $this->getView()->assign("pageTitle", "{$item->getTitle()}");
        $this->getView()->assign("pageDescription", "{$item->getDescription()}");
    }

}
