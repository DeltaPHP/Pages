<?php
/**
 * User: Vasiliy Shvakin (orbisnull) zen4dev@gmail.com
 */

namespace Pages\Model\Parts;

trait PagesManager
{
    /**
     * @return \Pages\Model\PagesManager
     */
    public function getPagesManager()
    {
        return $this->getApplication()["pagesManager"];
    }
}
