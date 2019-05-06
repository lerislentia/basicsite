<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;

use App\Models\Site;
use DB;

class SiteRepository extends BaseRepository
{
    protected $site;

    public function __construct(Site $site)
    {
        $this->site = $site;
    }

    public function index($entity = null)
    {
        // $query = $this->site->select('site.*');
        return $this->site->select('site.*');
        // if ($entity) {
        //     $query->join('entity_type as et', 'et.type_id', '=', 'type.id');
        //     $query->join('entity as en', 'entity_id', '=', 'en.id');
        //     $query->where('en.name', '=', $entity);
        // }
        // return $query;
    }

    public function show($id)
    {
        return $this->site->find($id);
    }

    public function getActiveSite()
    {
        return $this->site->select('site.*')->where(Site::STATE, '=', Site::STATE_ACTIVE);
    }


    public function store($params)
    {
        try {
            DB::beginTransaction();

            $typparams = [
                'name'          => $params['name'],
                'url'           => $params['url'],
            ];

            $typ = $this->site->create($typparams);

            $typ->save();
            DB::commit();
            return $typ;
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    public function update($id, $params)
    {
        try {
            DB::beginTransaction();

            $typ =  $this->site->find($id);

            $typparams = [
                'name'          => $params['name'],
                'url'           => isset($params['url']) ? $params['url'] : null
            ];

            $typ->fill($typparams);
            $typ->save();
            DB::commit();
            return $typ;
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }
}
