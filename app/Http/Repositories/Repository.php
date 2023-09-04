<?php

namespace App\Http\Repositories;

use App\Http\interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\AssignOp\Mod;

class Repository implements RepositoryInterface
{
    protected $model;
    public function __construct(Model $model)
    {
        $this ->model=$model;
    }

    public function all()
    {
        // TODO: Implement all() method.
    }

    public function create()
    {
        // TODO: Implement create() method.
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }

    public function show()
    {
        // TODO: Implement show() method.
    }
}
