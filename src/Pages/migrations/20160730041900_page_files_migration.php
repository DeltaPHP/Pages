<?php

use Phinx\Migration\AbstractMigration;
use DeltaCore\Application;
use DeltaPhp\Operator\Command\GenerateIdCommand;
use Attach\Model\ImageFileEntity;
use Pages\Model\PageImageRelation;

class PageFilesMigration extends AbstractMigration
{
    public function up()
    {
        if (!defined("ROOT_DIR")) {
            define('ROOT_DIR', realpath(__DIR__ . '/..'));
        }
        if (!defined("PUBLIC_DIR")) {
            define('PUBLIC_DIR', ROOT_DIR . '/public');
        }
        if (!defined("VENDOR_DIR")) {
            define('VENDOR_DIR', ROOT_DIR . '/vendor');
        }
        if (!defined("DATA_DIR")) {
            define('DATA_DIR', ROOT_DIR . '/data');
        }


        $loader = include ROOT_DIR . "/vendor/autoload.php";

        $app = new Application();
        $app->setLoader($loader);

        $app->init();

        /** @var \Attach\Model\FileManager $fm */
        $fm = $app["fileManager"];

        $section = (integer) $fm->getSection(\Pages\Model\Page::class);

        $sql = "select id old_id, object, \"name\", description, type, sub_type, path, \"order\" info, main, created from files_old where type='image' and section={$section}";
        $files  = $this->fetchAll($sql);

        /** @var \DeltaPhp\Operator\EntityOperator $operator */
        $operator = $app["Operator"];

        $getUuidFunction = function($class) use ($operator){
            $idGenerateCommand = new GenerateIdCommand($class);
            $id = $operator->execute($idGenerateCommand);
            return $id;
        };

        foreach ($files as $fileData) {
            $page = $operator->find(\Pages\Model\Page::class, ["old_id" => $fileData["object"]])->firstOrFail();
            /** @var \Attach\Model\FileEntity $fileObject */
            $fileObject = $operator->create(ImageFileEntity::class);
            $fileData["id"] = $getUuidFunction(ImageFileEntity::class);
            $operator->load($fileObject, $fileData);
            usleep(mt_rand(0, 1000000));
            $operator->save($fileObject);

            $relation = $operator->create(PageImageRelation::class);
            $relation->setId($getUuidFunction(PageImageRelation::class));
            $relation->setFirst($page);
            $relation->setSecond($fileObject);
            usleep(mt_rand(0, 1000000));
            $operator->save($relation);
        }
    }
}
