<?php

namespace App\Repositories;

use App\Models\Layout;
use DB;

class LayoutRepository
{
    protected $layout;

    public function __construct(Layout $layout)
    {
        $this->layout = $layout;
    }

    public function index()
    {
        return $this->layout->All();
    }

    public function show($id)
    {
        return $this->layout->find($id);
    }

    public function store($params)
    {
        return $this->layout->create($params);
    }

    public function update($id, $params)
    {
        try {
            DB::beginTransaction();
            $ent =  $this->layout->find($id);
            $ent->fill($params);
            $ent->save();
            DB::commit();
            return $ent;
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }
}
