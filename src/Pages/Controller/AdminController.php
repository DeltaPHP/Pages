<?php

namespace Pages\Controller;

use Attach\Model\Command\EntityAttachSaveCommand;
use DeltaPhp\Operator\EntityOperatorInterface;
use Pages\Model\Page;
use DeltaCore\AdminControllerInterface;
use Pages\Model\PageImageRelation;
use UUID\Model\UuidComplexShortTables;

class AdminController extends IndexController implements AdminControllerInterface
{

    public function listAction()
    {
        /** @var EntityOperatorInterface $operator */
        $operator = $this->getOperator();

        $countItems = $operator->count(Page::class);

        $itemsPerPage = $this->getConfig(["Pages", "Admin", "itemsPerPage"], 10);
        $pageInfo = $this->getPageInfo($countItems, $itemsPerPage);

        $items = $operator->find(Page::class, [], $pageInfo["perPage"], $pageInfo["offsetForPage"], "id");

        $this->getView()->assign("items", $items);
        $this->getView()->assignArray($pageInfo);
        $this->getView()->assign("countItems", $countItems);
        $titleEnd = $pageInfo["page"] == 1 ? "" : " страница " . $pageInfo["page"];
        $this->getView()->assign("pageTitle", "Страницы сайта {$titleEnd}");
    }

    public function formAction(array $params = [])
    {
        if (isset($params["id"])) {
            $id = hexdec($params["id"]);
            $nm = $this->getOperator();
            $item = $nm->get(Page::class, $id);
            if (!$item) {
                throw new \RuntimeException("Bad item id {$params["id"]}");
            }
            $this->getView()->assign("item", $item);
        } else {
            $id = $this->getOperator()->genId(Page::class);
            $this->getView()->assign("id", $id);
        }
    }

    public function saveAction()
    {
        $this->autoRenderOff();
        //save item
        $request = $this->getRequest();
        $operator = $this->getOperator();
        $requestParams = $request->getParams();
        if (isset($requestParams["id"])) {
            $id = $operator->create(UuidComplexShortTables::class, ["value" => $requestParams["id"]]);
            unset($requestParams["id"]);
        }
        
        /** @var Page $item */
        $item = $operator->get(Page::class, $id) ?: $operator->create(Page::class);
        if (empty($item)) {
            throw new \LogicException("item not found");
        }
        $operator->load($item, $requestParams);
        $item->setId($id);
        $operator->save($item);

        $maxFileSize = $this->getConfig(["Pages", "Attach", "Size"], 500 * 1024);

        $this->getOperator();

        $fileCommand = new EntityAttachSaveCommand($item, $request, PageImageRelation::class, ["", "maxFileSize" =>$maxFileSize]);
        $this->getOperator()->execute($fileCommand);

        $this->getResponse()->redirect($this->getRouteUrl("pages_list"));
    }

    public function rmAction(array $params = [])
    {
        if (isset($params["id"])) {
            $id = hexdec($params["id"]);
            $nm = $this->getOperator();
            $item = $nm->get(Page::class, $id);
            if (!$item) {
                throw new \RuntimeException("Bad item id {$params["id"]}");
            }
            $this->getOperator()->delete($item);
        }
        $this->getResponse()->redirect($this->getRouteUrl("pages_list"));
    }
}
