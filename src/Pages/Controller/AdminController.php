<?php
/**
 * User: Vasiliy Shvakin (orbisnull) zen4dev@gmail.com
 */

namespace Pages\Controller;

use Attach\Model\Parts\AttachSave;
use Pages\Model\Page;
use DeltaCore\AdminControllerInterface;

class AdminController extends IndexController implements AdminControllerInterface
{
    use AttachSave;

    public function getFileManager()
    {
        return $this->getPagesManager()->getFileManager();
    }

    public function listAction()
    {
        $manager = $this->getPagesManager();
        $itemsPerPage = $this->getConfig(["Pages", "Admin", "itemsPerPage"], 10);
        $countItems = $manager->count();
        $pageInfo = $this->getPageInfo($countItems, $itemsPerPage);
        $items = $manager->find([], null, $pageInfo["perPage"], $pageInfo["offsetForPage"], "id");

        $this->getView()->assign("items", $items);
        $this->getView()->assignArray($pageInfo);
        $this->getView()->assign("countItems", $countItems);
        $titleEnd = $pageInfo["page"] == 1 ? "" : " страница " . $pageInfo["page"];
        $this->getView()->assign("pageTitle", "Страницы сайта {$titleEnd}");
    }

    public function formAction(array $params = [])
    {
        if (isset($params["id"])) {
            $id = $params["id"];
            $nm = $this->getPagesManager();
            $item = $nm->findById($id);
            if (!$item) {
                throw new \RuntimeException("Bad item id $id");
            }
            $this->getView()->assign("item", $item);
        }
    }

    public function saveAction()
    {
        $this->autoRenderOff();
        //save item
        $request = $this->getRequest();
        $requestParams = $request->getParams();
        $manager = $this->getPagesManager();
        /** @var Page $item */
        $item = isset($requestParams["id"]) ? $manager->findById($requestParams["id"]) : $manager->create();
        if (empty($item)) {
            throw new \LogicException("item not found");
        }
        $manager->load($item, $requestParams);
        $manager->save($item);

        $maxFileSize = $this->getConfig(["Pages", "Attach", "Size"], 500 * 1024);
        $this->processFilesRequest($item, $maxFileSize);

        $this->getResponse()->redirect($this->getRouteUrl("pages_list"));
    }

    public function rmAction(array $params = [])
    {
        $this->autoRenderOff();
        $id = $this->getId();
        $this->getPagesManager()->deleteById($id);
        $this->getResponse()->redirect($this->getRouteUrl("pages_list"));
    }


}
