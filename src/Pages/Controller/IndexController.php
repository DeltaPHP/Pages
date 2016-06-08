<?php
/**
 * User: Vasiliy Shvakin (orbisnull) zen4dev@gmail.com
 */

namespace Pages\Controller;

use DeltaCore\AbstractController;
use DeltaPhp\Operator\EntityOperatorInterface;
use DeltaRouter\Exception\NotFoundException;
use DeltaUtils\Exception\EmptyException;
use Pages\Model\Page;
use DeltaPhp\Operator\OperatorDiTrait;

class IndexController extends AbstractController
{
    use OperatorDiTrait;

    public function viewAction($params)
    {
        if (!isset($params["url"])) {
            $this->getResponse()->redirect("/");
        }

        $url = $params["url"];
        /** @var EntityOperatorInterface $operator */
        $operator = $this->getOperator();
        try {
            $item = $operator->find(Page::class, ["url" => $url], 1)->firstOrFail();
        } catch (EmptyException $e) {
            throw new NotFoundException("Page {$url} not found");
        }
        $this->getView()->assign("item", $item);
        $this->getView()->assign("pageTitle", "{$item->getTitle()}");
        $this->getView()->assign("pageDescription", "{$item->getDescription()}");
        $this->getView()->assign("canonicalRef", $this->getRouteUrl("pages_view", ["url"=> $url]));
    }

}
