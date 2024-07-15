<?php
$map = ['create', 'read', 'update', 'delete'];
return [
    'groups' =>
    [
        'main' => [
            'users' => $map,
            'roles' => $map,
            'projects' => $map,
            'tasks' => $map,
        ]
    ],
];
