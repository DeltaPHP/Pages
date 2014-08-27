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

    public function getNameInUri()
    {
        return $this->getRequest()->getUriPartByNum(2);
    }

    public function viewAction()
    {
        $name = $this->getNameInUri();
        if(!$name) {
            $this->getResponse()->redirect("/");
        }

        $manager = $this->getPagesManager();
        $item = $manager->findOne(["name" => $name]);
        if(!$item) {
            throw new NotFoundException("Page $name not found");
        }
        $this->getView()->assign("item", $item);
        $this->getView()->assign("pageTitle", "{$item->getTitle()}" );
        $this->getView()->assign("pageDescription", "{$item->getDescription()}" );
    }

} 