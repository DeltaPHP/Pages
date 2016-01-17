<?php
/**
 * User: Vasiliy Shvakin (orbisnull) zen4dev@gmail.com
 */
return [
    "pagesManager" => function ($c) {
        $manager = new \Pages\Model\PagesManager();
        $fm = $c["fileManager"];
        $manager->setFileManager($fm);
        return $manager;
    },

];
