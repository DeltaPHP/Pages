<?php
/**
 * User: Vasiliy Shvakin (orbisnull) zen4dev@gmail.com
 */

namespace Pages\Model;


use Attach\Model\Worker\FileWorkerTrait;
use DeltaDb\EntityInterface;
use DeltaPhp\Operator\Command\RelationLoadCommand;
use DeltaPhp\Operator\Entity\ContentEntity;
use DeltaPhp\Operator\Entity\ContentEntityInterface;
use DeltaPhp\Operator\DelegatingInterface;
use DeltaPhp\Operator\DelegatingTrait;

/**
 * Class Page
 * @package Pages
 */
class Page extends ContentEntity implements ContentEntityInterface, EntityInterface, DelegatingInterface
{
    use DelegatingTrait;

    protected $url;
    protected $images;

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function isUntrusted()
    {
        // TODO: Implement isUntrusted() method.
    }

    public function setUntrusted($untrusted = true)
    {
        // TODO: Implement setUntrusted() method.
    }

    public function getFieldsList()
    {
        // TODO: Implement getFieldsList() method.
    }

    public function getImages()
    {
        if (null === $this->images) {
            $command = new RelationLoadCommand(PageImageRelation::class, $this);
            $this->images = $this->delegate($command);
        }
        return $this->images;
    }
}
