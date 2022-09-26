<?php

namespace App\Repositories;

interface BaseRepositoryInterface
{

    function index(int $per_page);

    function show(int $id);

    function delete(int $id);

}
