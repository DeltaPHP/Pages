<?php

return [
    [
        "methods" => [\DeltaRouter\Route::METHOD_GET],
        "patterns" => [
            "part" => \DeltaRouter\RoutePattern::PART_PATH,
            "type" => \DeltaRouter\RoutePattern::TYPE_REGEXP,
            "value" => "^/pages/(?P<name>\w+)$",
        ],
        "action" => ["index", "view"],
    ],
    ["/admin/pages", ["admin", "list"]],
    ["/admin/pages/add", ["admin", "form"]],
    ["/admin/pages/edit", ["admin", "form"]],
    ["/admin/pages/save", ["admin", "save"]],
    ["/admin/pages/rm", ["admin", "rm"]],

];