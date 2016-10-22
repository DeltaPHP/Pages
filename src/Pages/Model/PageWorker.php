<?php


namespace Pages\Model;


use DeltaPhp\Operator\Command\DeleteCommand;
use DeltaPhp\Operator\Command\FindCommand;
use DeltaPhp\Operator\DelegatingInterface;
use DeltaPhp\Operator\DelegatingTrait;
use DeltaPhp\Operator\Entity\EntityInterface;
use DeltaPhp\Operator\Worker\PostgresWorker;
use DeltaPhp\Operator\Command\PreCommandInterface;
use DeltaPhp\Operator\Command\CommandInterface;

class PageWorker extends PostgresWorker implements DelegatingInterface
{
    use DelegatingTrait;

    public function __construct()
    {
        $this->setTable("pages");
        $this->addFields(["title", "description", "content", "url"]);
    }

    public function deleteImages(EntityInterface $entity)
    {
        //удалить файлы
        $command = new FindCommand(PageImageRelation::class, null, null, null, null, ["entity" => $entity]);
        $relations = $this->delegate($command);

        foreach ($relations as $relation) {
            $command = new DeleteCommand($relation, ["currentLinkedEntity" => $entity]);
            $this->delegate($command);
        }
    }

    public function execute(CommandInterface $command)
    {
        switch ($command->getName()) {
            case PreCommandInterface::PREFIX_COMMAND_PRE . CommandInterface::COMMAND_DELETE:
                $entity = $command->getParams("entity");
                return $this->deleteImages($entity);
            default:
                return parent::execute($command);
        }
    }
}
