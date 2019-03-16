<?php


namespace App\Repositories;

use App\Repositories\BaseRepository;

use App\Models\Locale;
use DB;

class LocaleRepository extends BaseRepository
{
    protected $locale;

    public function __construct(Locale $locale)
    {
        $this->locale = $locale;
    }

    public function index()
    {
        return $this->locale->All();
    }

    public function show($id)
    {
        return $this->locale->find($id);
    }
    public function store($params)
    {
        try {
            DB::beginTransaction();
            $newloc = $this->locale->create($params);
            DB::commit();
            return $newloc;
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
        return $this->locale->create($params);
    }

    public function update($id, $params)
    {
        try {
            DB::beginTransaction();
            $loc = $this->locale->find($id);
            $loc->fill($params);
            $loc->save();
            DB::commit();
            return $loc;
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
        return $this->locale->create($params);
    }
}
