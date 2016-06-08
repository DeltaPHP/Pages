<?php
/**
 * User: Vasiliy Shvakin (orbisnull) zen4dev@gmail.com
 */

namespace Pages\Model;


use DeltaCore\Parts\MagicSetGetManagers;
use DeltaDb\Repository;

/**
 * Class PagesManager
 * @package Pages
 * @method  setFileManager(\Attach\Model\FileManager $fileManager)
 * @method \Attach\Model\FileManager getFileManager()
 * @deprecated
 */
class PagesManager extends Repository
{
    use MagicSetGetManagers;

    protected $metaInfo = [
        'fields' => [
            "id",
            "name",
            "title",
            "description",
            "text",
            "created",
            "changed",
        ]
    ];

    public function create(array $data = null)
    {
        /** @var Page $entity */
        $entity = parent::create($data);
        $entity->setFileManager($this->getFileManager());
        return $entity;
    }
}
