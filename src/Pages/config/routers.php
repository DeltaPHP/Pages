<?php

return [
    ["/pages", ["index", "list"]],
    ["reg::/pages/([a-zA-Z0-9]+)$", ["index", "view"]],

    ["/admin/pages", ["admin", "list"]],
    ["/admin/pages/add", ["admin", "form"]],
    ["/admin/pages/edit", ["admin", "form"]],
    ["/admin/pages/save", ["admin", "save"]],
    ["/admin/pages/rm", ["admin", "rm"]],

];