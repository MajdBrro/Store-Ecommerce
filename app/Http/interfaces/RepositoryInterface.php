<?php

namespace App\Http\interfaces;

interface RepositoryInterface
{
    public function all();

    public function create();

    public function update();

    public function delete();

    public function show();
}
