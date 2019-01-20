<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\TypeService;
use App\Services\StructureService;
use Session;
use Redirect;

class StructureController extends Controller
{
    protected $typeservice;
    protected $structureservice;

    public function __construct(TypeService $typeservice, StructureService $structureservice)
    {
        $this->structureservice = $structureservice;
        $this->typeservice      = $typeservice;
    }

    public function show(Request $request)
    {
        $params     = $request->All();
        $type       = $this->typeservice->show($params['type']);
        $params     = $this->structureservice->getStructureByType($type['definition']);

        return response()->json(
            isset($params)    ? $params                : []
            );
    }

    public function preview(Request $request)
    {
        $params     = $request->All();
        $type       = $this->typeservice->show($params['type']);
        $html     = $this->structureservice->getHtml($type['definition']);
        return response($html);
    }
}
