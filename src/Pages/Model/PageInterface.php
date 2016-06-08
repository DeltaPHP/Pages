<?php


namespace Pages\Model;


use DeltaPhp\Operator\Entity\NamedEntityInterface;

interface PageEntityInterface extends NamedEntityInterface
{
    public function getUrl();
}
