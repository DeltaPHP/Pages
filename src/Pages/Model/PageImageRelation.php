<?php


namespace Pages\Model;


use Attach\Model\EntityImageRelation;
use Attach\Model\FileEntity;

class PageImageRelation extends EntityImageRelation
{
    public function __construct()
    {
        $this->setFirstClass(Page::class);
        $this->setSecondClass(FileEntity::class);
    }
}
