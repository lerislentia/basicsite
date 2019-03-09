<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\TypeService;
use App\Services\StructureService;
use App\Services\SectionService;
use Session;
use Redirect;

class StructureController extends Controller
{
    protected $typeservice;
    protected $structureservice;
    protected $elementsservice;

    public function __construct(
        TypeService $typeservice,
        StructureService $structureservice,
        SectionService $elementsservice
        ) {
        $this->structureservice = $structureservice;
        $this->typeservice      = $typeservice;
        $this->elementsservice      = $elementsservice;
    }

    /**
     * AJAX
     *
     * @param  Request $request
     * @return void
     */
    public function show(Request $request)
    {
        $params     = $request->All();
        $type       = $this->typeservice->show($params['type']);
        $params     = $this->structureservice->getStructureByType($type['definition']);

        return response()->json(
            isset($params)    ? $params                : []
            );
    }

    /**
     * AJAX
     *
     * @param  Request $request
     * @return void
     */
    public function preview(Request $request)
    {
        $params = $request->All();
        $type       = $this->typeservice->show($params['type']);

        if (isset($params['entity_id'])) {
            $entity = $this->elementsservice->show($params['entity_id']);
            $params = (array) json_decode($entity->data);
        }


        $html       = $this->structureservice->getHtml($type['definition'], $params);
        return response($html);
    }


    /**
     * AJAX
     *
     * @param  Request $request
     * @return void
     */
    public function getproperties(Request $request)
    {
        $params     = $request->All();

        $locale     = Session::get('locale');


        if (isset($params['entity_id'])) {
            $entity            = $this->elementsservice->show($params['entity_id']);
            if (!$entity) {
                throw new \Exception("no se encontro el elemento en la base de datos");
            }
            $type = $entity->type()->first();
        } else {
            $type       = $this->typeservice->show($params['type']);
        }

        $definition = isset($type->definition) ? $type->definition : null;

        if (!$definition) {
            throw new \Exception("error en getproperties, el campo 'definition' no esta informado");
        }

        $data = [
            'element'       => $entity->toArray(),
            'locale'        => Session::get('locale')
        ];

        $html       = $this->structureservice->getHtmlProperties($definition, $data);
        return response($html);
    }



    /**
     * AJAX
     *
     * @param  Request $request
     * @return void
     */
    public function updateproperties(Request $request, $locale = null)
    {
        $params     = $request->All();

        if (!$locale) {
            $locale             = Session::get('locale');
        }

        $entity            = $this->elementsservice->show($params['entity_id']);

        if (!$entity) {
            throw new \Exception("no se encontro el elemento en la base de datos");
        }

        unset($params['_token']);
        unset($params['entity_id']);

        $params[$locale] = $params;

        if ($request->isMethod('post')) {
            $update     = $this->elementsservice->updateProperties($entity->id, $params);
            if ($update) {
                return response("ok", 200);
            }
        }
    }
}
