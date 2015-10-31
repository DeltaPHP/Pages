<?php

return [
    "pages_view" =>
        [
            "methods" => [\DeltaRouter\Route::METHOD_GET],
            "patterns" => [
                "type" => \DeltaRouter\RoutePattern::TYPE_REGEXP,
                "value" => "^/pages/(?P<name>\w+)$",
            ],
            "action" => ["index", "view"],
        ],
    "pages_list" => ["/admin/pages", ["admin", "list"]],
    "pages_add" => ["/admin/pages/add", ["admin", "form"]],
    "pages_edit" =>
        [
            "methods" => [\DeltaRouter\Route::METHOD_GET],
            "patterns" => [
                "type" => \DeltaRouter\RoutePattern::TYPE_REGEXP,
                "value" => "^/admin/pages/edit/(?P<id>\w+)$",
            ],
            "action" => ["admin", "form"],
        ],
    "pages_save" =>
        [
            "methods" => [\DeltaRouter\Route::METHOD_POST],
            "patterns" => [
                "value" => "/admin/pages/save",
            ],
            "action" => ["admin", "save"],
        ],
    "pages_rm" =>
        [
            "methods" => [\DeltaRouter\Route::METHOD_GET],
            "patterns" => [
                "type" => \DeltaRouter\RoutePattern::TYPE_REGEXP,
                "value" => "^/admin/pages/rm/(?P<id>\w+)$",
            ],
            "action" => ["admin", "rm"],
        ],
];
