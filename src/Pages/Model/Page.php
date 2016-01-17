<?php
/**
 * User: Vasiliy Shvakin (orbisnull) zen4dev@gmail.com
 */

namespace Pages\Model;


use Attach\Model\Parts\GetImagesTrait;
use DeltaCore\Prototype\MiddleObject;
use DeltaDb\EntityInterface;

/**
 * Class Page
 * @package Pages
 * @method  setFileManager(\Attach\Model\FileManager $fileManager)
 * @method \Attach\Model\FileManager getFileManager()
 */
class Page extends MiddleObject implements EntityInterface
{
    use GetImagesTrait;

    protected $title;
    protected $text;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

}
