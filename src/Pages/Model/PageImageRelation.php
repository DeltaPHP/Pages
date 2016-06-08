<?php


namespace Pages\Model;


use Attach\Model\FileEntity;
use DeltaPhp\Operator\Entity\RelationEntity;

class PageImageRelation extends RelationEntity
{
    public function __construct()
    {
        $this->setFirstClass(Page::class);
        $this->setSecondClass(FileEntity::class);
    }
}
