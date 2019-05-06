<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ProductsService;
use App\Services\LocaleService;
use App\Services\EntityStateService;
use App\Services\StructureService;
use App\Services\SitesService;
use Storage;
use Redirect;
use Config;
use Session;
use App;

class ProductsController extends Controller
{
    const ENTITY = 'product';

    protected $productsservice;
    protected $localeservice;
    protected $entityservice;
    protected $structureservice;
    protected $sitesservice;

    public function __construct(
        ProductsService $productsservice,
        LocaleService $localeservice,
        EntityStateService $entityservice,
        StructureService $structureservice,
        SitesService $sitesservice
        ) {
        $this->productsservice = $productsservice;
        $this->localeservice = $localeservice;
        $this->entityservice = $entityservice;
        $this->structureservice = $structureservice;
        $this->sitesservice = $sitesservice;
    }

    public function index(Request $request)
    {
        $site       = $this->sitesservice->getActiveSite();

        if (!$site) {
            throw new \Exception('no sites active available');
        }


        $products = $site->products()->show()->get();
        $locales = $this->localeservice->index();
        // $locale             = App::getLocale();
        $locale             = App::getLocale();

        $arrayproducts  = $products->toArray();
        $jsonproducts = json_encode($arrayproducts);
        $baseurl = Config::get('app.url');
        $savecontent = str_replace($baseurl, $site[$site::URL], $jsonproducts);
        Storage::disk('public')->put("products.json", $savecontent);
        // public_path("products.json", $savecontent);

        $data = [
            'products'      => $products->toArray(),
            'locales'       => $locales->toArray(),
            'locale'        => $locale,
            ];

        return view('admin.products.index', $data);
    }

    public function new(Request $request)
    {
        try {
            $products           = $this->productsservice->index();
            $locales            = $this->localeservice->index();
            $states             = $this->entityservice->index(self::ENTITY);
            $sites              = $this->sitesservice->index();
            // $locale             = App::getLocale();
            $locale             = App::getLocale();

            $data = [
                'product'       => null,
                'products'      => $products->toArray(),
                'states'        => $states->toArray(),
                'locales'       => $locales->toArray(),
                'sites'         => $sites->toArray(),
                'locale'        => $locale
            ];

            if ($request->isMethod('post')) {
                $params       = $request->All();
                $newproduct   = $this->productsservice->create($params);
                if ($newproduct) {
                    return Redirect::route('admin.products');
                }
            }

            // dd($data);
            return view('admin.products.forms.new', $data);
        } catch (\Throwable $e) {
            return view('admin.products.forms.new', $data);
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $currentproduct     = $this->productsservice->show($id);
            $products           = $this->productsservice->index();
            $sites              = $this->sitesservice->index();
            // $locale             = App::getLocale();
            $locales            = $this->localeservice->index();
            $locale             = App::getLocale();

            if ($request->isMethod('post')) {
                $params                 = $request->All();
                $currentproduct         = $this->productsservice->update($id, $params);
                return Redirect::route('admin.products');
            }
            // dd($sections->toArray());
            $data = [
            'currentproduct'    => $currentproduct->toArray(),
            'products'          => $products->toArray(),
            'locales'           => $locales->toArray(),
            'sites'             => $sites->toArray(),
            'locale'            => $locale
        ];

            return view('admin.products.forms.edit', $data);
        } catch (\Throwable $e) {
            return view('admin.products.forms.edit', $data);
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $currentproduct          = $this->productsservice->delete($id);
            return Redirect::route('admin.products');
        } catch (\Throwable $e) {
            // return view('admin.products.forms.edit', $data);
        }
    }

    public function preview(Request $request)
    {
        $params     = $request->All();

        $locale = isset($params['locale']) ? $params['locale'] : null;
        if (!$locale) {
            $locale = App::getLocale();
        }

        if (isset($params['entity_id'])) {
            $product    = $this->productsservice->show($params['entity_id']);
            // $params     = (array) json_decode($product->data, true);
            $data     = $product->toArray();
        }

        $data['locale'] = $locale;
        // if (isset($params[$locale])) {
        //     $locale = $params[$locale];
        // }

        $html       = $this->structureservice->getHtml(self::ENTITY, $data);
        return response($html);
    }

    public function properties(Request $request)
    {
        $params     = $request->All();
        $locale = isset($params['locale']) ? $params['locale'] : App::getLocale();
        if (isset($params['entity_id'])) {
            $entity            = $this->productsservice->show($params['entity_id']);

            if (!$entity) {
                throw new \Exception("no se encontro el elemento en la base de datos");
            }

            $definition = 'product';

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

    }


    public function updateproperties(Request $request)
    {
        $params     = $request->All();
        $locale = isset($params['locale']) ? $params['locale'] : App::getLocale();
        if (isset($params['entity_id'])) {

            if ($request->isMethod('post')) {
                $params                 = $request->All();
                $updated         = $this->productsservice->update($params['entity_id'], $params);

                if ($updated) {
                    return response("ok", 200);
                }
            }
        } 
    }

    
}
