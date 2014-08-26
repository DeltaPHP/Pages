<?php
/**
 * User: Vasiliy Shvakin (orbisnull) zen4dev@gmail.com
 */
return [
    "PagesManager" => function ($c) {
            $manager = new \Pages\Model\PagesManager();
            return $manager;
    },
];