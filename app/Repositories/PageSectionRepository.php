<?php

namespace App\Repositories;

use App\Models\PageSection;
use DB;

class PageSectionRepository
{
    protected $pagesectionmodel;

    public function __construct(PageSection $pagesectionmodel)
    {
        $this->pagesectionmodel = $pagesectionmodel;
    }

    public function index()
    {
        return $this->pagesectionmodel->select('*')->orderBy(PageSection::ORDER);
    }

    public function show($id)
    {
        return $this->pagesectionmodel->find($id);
    }

    public function store($params)
    {
        try {
            DB::beginTransaction();

            $new = $this->pagesectionmodel->create($params);

            $new->save();
            DB::commit();
            return $new;
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    public function delete($id){
        try {
            DB::beginTransaction();

            $ps = $this->pagesectionmodel->find($id);

            $deleted = $ps->delete();
            DB::commit();
            return $deleted;
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }
}
