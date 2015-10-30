<?php

return [
    "page_view" =>
        [
            "methods" => [\DeltaRouter\Route::METHOD_GET],
            "patterns" => [
                "type" => \DeltaRouter\RoutePattern::TYPE_REGEXP,
                "value" => "^/pages/(?P<name>\w+)$",
            ],
            "action" => ["index", "view"],
        ],
    ["/admin/pages", ["admin", "list"]],
    ["/admin/pages/add", ["admin", "form"]],
    "page_edit" =>
        [
            "methods" => [\DeltaRouter\Route::METHOD_GET],
            "patterns" => [
                "type" => \DeltaRouter\RoutePattern::TYPE_REGEXP,
                "value" => "^/admin/pages/edit/(?P<id>\w+)$",
            ],
            "action" => ["admin", "form"],
        ],
    "page_save" =>
        [
            "methods" => [\DeltaRouter\Route::METHOD_POST],
            "patterns" => [
                "value" => "/admin/pages/save",
            ],
            "action" => ["admin", "save"],
        ],
    "page_delete" =>
        [
            "methods" => [\DeltaRouter\Route::METHOD_GET],
            "patterns" => [
                "type" => \DeltaRouter\RoutePattern::TYPE_REGEXP,
                "value" => "^/admin/pages/rm/(?P<id>\w+)$",
            ],
            "action" => ["admin", "rm"],
        ],
];