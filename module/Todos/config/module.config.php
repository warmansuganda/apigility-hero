<?php
return [
    'controllers' => [
        'factories' => [
            'Todos\\V1\\Rpc\\Ping\\Controller' => \Todos\V1\Rpc\Ping\PingControllerFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'todos.rpc.ping' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/ping',
                    'defaults' => [
                        'controller' => 'Todos\\V1\\Rpc\\Ping\\Controller',
                        'action' => 'ping',
                    ],
                ],
            ],
            'todos.rest.todo' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/todo[/:todo_id]',
                    'defaults' => [
                        'controller' => 'Todos\\V1\\Rest\\Todo\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'todos.rpc.ping',
            1 => 'todos.rest.todo',
        ],
    ],
    'zf-rpc' => [
        'Todos\\V1\\Rpc\\Ping\\Controller' => [
            'service_name' => 'Ping',
            'http_methods' => [
                0 => 'GET',
            ],
            'route_name' => 'todos.rpc.ping',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'Todos\\V1\\Rpc\\Ping\\Controller' => 'Json',
            'Todos\\V1\\Rest\\Todo\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'Todos\\V1\\Rpc\\Ping\\Controller' => [
                0 => 'application/vnd.todos.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'Todos\\V1\\Rest\\Todo\\Controller' => [
                0 => 'application/vnd.todos.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'Todos\\V1\\Rpc\\Ping\\Controller' => [
                0 => 'application/vnd.todos.v1+json',
                1 => 'application/json',
            ],
            'Todos\\V1\\Rest\\Todo\\Controller' => [
                0 => 'application/vnd.todos.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'zf-content-validation' => [
        'Todos\\V1\\Rpc\\Ping\\Controller' => [
            'input_filter' => 'Todos\\V1\\Rpc\\Ping\\Validator',
        ],
        'Todos\\V1\\Rest\\Todo\\Controller' => [
            'input_filter' => 'Todos\\V1\\Rest\\Todo\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'Todos\\V1\\Rpc\\Ping\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'ack',
            ],
        ],
        'Todos\\V1\\Rest\\Todo\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'description',
                'error_message' => 'the description is required',
            ],
            1 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'status',
                'error_message' => 'status is required',
            ],
            2 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'timestamp',
            ],
        ],
    ],
    'service_manager' => [
        'factories' => [
            \Todos\V1\Rest\Todo\TodoResource::class => \Todos\V1\Rest\Todo\TodoResourceFactory::class,
        ],
    ],
    'zf-rest' => [
        'Todos\\V1\\Rest\\Todo\\Controller' => [
            'listener' => \Todos\V1\Rest\Todo\TodoResource::class,
            'route_name' => 'todos.rest.todo',
            'route_identifier_name' => 'todo_id',
            'collection_name' => 'todo',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'TodoLibEntity',
            'collection_class' => 'TodoLibCollection',
            'service_name' => 'Todo',
        ],
    ],
    'zf-hal' => [
        'metadata_map' => [
            \Todos\V1\Rest\Todo\TodoEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'todos.rest.todo',
                'route_identifier_name' => 'todo_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \Todos\V1\Rest\Todo\TodoCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'todos.rest.todo',
                'route_identifier_name' => 'todo_id',
                'is_collection' => true,
            ],
            'TodoLibEntity' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'todos.rest.todo',
                'route_identifier_name' => 'todo_id',
                'hydrator' => \Zend\Hydrator\ObjectProperty::class,
            ],
            'TodoLibCollection' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'todos.rest.todo',
                'route_identifier_name' => 'todo_id',
                'is_collection' => true,
            ],
        ],
    ],
];
