<?php
use Pages\Model\Page;
use DeltaPhp\Operator\Command\CommandInterface;
use DeltaPhp\Operator\Worker\WorkerInterface;
use Pages\Model\PageImageRelation;
use DeltaPhp\Operator\Command\RelationLoadCommand;
use Attach\Model\ImageFileEntity;

return [
    "PageWorker" => [
        function ($s) {
            $w = new \Pages\Model\PageWorker();
            $adapter = $s->getOperator()->getDependency("dbAdapter");
            $w->setAdapter($adapter);
            return $w;
        },
        WorkerInterface::PARAM_TABLEID => 12,
        WorkerInterface::PARAM_ACTIONS_MAP => [
            CommandInterface::COMMAND_FIND => Page::class,
            CommandInterface::COMMAND_GET => Page::class,
            CommandInterface::COMMAND_COUNT => Page::class,
            CommandInterface::COMMAND_SAVE => Page::class,
            CommandInterface::COMMAND_DELETE => Page::class,
            CommandInterface::COMMAND_LOAD => Page::class,
            CommandInterface::COMMAND_RESERVE => Page::class,
            CommandInterface::COMMAND_GENERATE_ID => Page::class,
            \DeltaPhp\Operator\Worker\TranslatorObjectToDataWorker::COMMAND_BEFORE_DELETE => [Page::class => -10],
            CommandInterface::COMMAND_WORKER_INFO => Page::class,
        ],
    ],

    "PageFilesWorker" => [
        function ($s) {
            $worker = new \DeltaPhp\Operator\Worker\RelationsWorker(Page::class, ImageFileEntity::class, PageImageRelation::class, "page_image_relations");
            $adapter = $s->getOperator()->getDependency("dbAdapter");
            $worker->setAdapter($adapter);
            return $worker;
        },
        WorkerInterface::PARAM_TABLEID => 101,
        WorkerInterface::PARAM_ACTIONS_MAP => [
            RelationLoadCommand::COMMAND_RELATION_LOAD => PageImageRelation::class,
            CommandInterface::COMMAND_FIND => PageImageRelation::class,
            CommandInterface::COMMAND_LOAD => PageImageRelation::class,
            CommandInterface::COMMAND_RESERVE => PageImageRelation::class,
            CommandInterface::COMMAND_GENERATE_ID => PageImageRelation::class,
            CommandInterface::COMMAND_GET => PageImageRelation::class,
            CommandInterface::COMMAND_COUNT => PageImageRelation::class,
            CommandInterface::COMMAND_SAVE => PageImageRelation::class,
            CommandInterface::COMMAND_DELETE => PageImageRelation::class,
            \DeltaPhp\Operator\Command\RelationParamsCommand::COMMAND_RELATION_PARAMS => PageImageRelation::class,
            CommandInterface::COMMAND_WORKER_INFO => PageImageRelation::class,
        ],
    ],
];
