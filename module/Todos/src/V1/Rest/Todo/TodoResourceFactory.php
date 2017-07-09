<?php
namespace Todos\V1\Rest\Todo;
use StatusLib\Mapper;

class TodoResourceFactory
{
    public function __invoke($services)
    {
        // return new TodoResource();
        return new TodoResource($services->get(Mapper::class));
    }
}
