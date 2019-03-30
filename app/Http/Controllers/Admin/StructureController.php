<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\TypeService;
use App\Services\StructureService;
use App\Services\SectionService;
use App\Services\LocaleService;
use Session;
use Redirect;

class StructureController extends Controller
{
    protected $typeservice;
    protected $structureservice;
    protected $elementsservice;
    protected $localeservice;

    public function __construct(
        TypeService $typeservice,
        StructureService $structureservice,
        SectionService $elementsservice,
        LocaleService $localeservice
        ) {
        $this->structureservice     = $structureservice;
        $this->typeservice          = $typeservice;
        $this->elementsservice      = $elementsservice;
        $this->localeservice        = $localeservice;
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
        $params     = $request->All();
        $type       = $this->typeservice->show($params['type']);

        $locale = isset($params['locale']) ? $params['locale'] : null;
        if (!$locale) {
            $locale = Session::get('locale');
        }

        if (isset($params['entity_id'])) {
            $entity = $this->elementsservice->show($params['entity_id']);
            $params = (array) json_decode($entity->data, true);
        }

        if (isset($params[$locale])) {
            $params = $params[$locale];
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

        $locale = isset($params['locale']) ? $params['locale'] : Session::get('locale');
        // $locale     = Session::get('locale');

        // $locale     = $this->localeservice->index();

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
            'locale'        => $locale
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

        $locale     = isset($params['locale']) ? $params['locale'] : Session::get('locale');

        $entity            = $this->elementsservice->show($params['entity_id']);

        if (!$entity) {
            throw new \Exception("no se encontro el elemento en la base de datos");
        }

        unset($params['_token']);
        unset($params['entity_id']);
        $propertieparams=[];
        $propertieparams[$locale] = $params;

        $entitydata             = $entity->array_data;
        $entitydata[$locale]    = $params;
        // $propertieparams = array_merge($propertieparams, $entity->array_data);
        // $aentity = $entity->array_data;

        if ($request->isMethod('post')) {
            $update     = $this->elementsservice->updateProperties($entity->id, $entitydata);
            if ($update) {
                return response("ok", 200);
            }
        }
    }
}
