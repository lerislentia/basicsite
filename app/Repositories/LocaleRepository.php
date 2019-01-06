<?php


namespace App\Repositories;

use App\Repositories\BaseRepository;

use App\Models\Locale;

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
        return $this->locale->create($params);
    }
}
