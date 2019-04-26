<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ProductsService;
use App\Services\LocaleService;
use App\Services\EntityStateService;
use App\Services\StructureService;
use Redirect;
use Session;
use App;


class ProductsController extends Controller
{
    const ENTITY = 'product';

    protected $productsservice;
    protected $localeservice;
    protected $entityservice;
    protected $structureservice;

    public function __construct(
        ProductsService $productsservice, 
        LocaleService $localeservice,
        EntityStateService $entityservice,
        StructureService $structureservice
        )
    {
        $this->productsservice = $productsservice;
        $this->localeservice = $localeservice;
        $this->entityservice = $entityservice;
        $this->structureservice = $structureservice;
    }

    public function index(Request $request)
    {
        $products = $this->productsservice->index();
        $locales = $this->localeservice->index();
        // $locale             = Session::get('locale');
        $locale             = App::getLocale();

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
            // $locale             = Session::get('locale');
            $locale             = App::getLocale();

            $data = [
                'product'       => null,
                'products'      => $products->toArray(),
                'states'        => $states->toArray(),
                'locales'       => $locales->toArray(),
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
            $currentproduct          = $this->productsservice->show($id);

            $products           = $this->productsservice->index();
            // $locale             = Session::get('locale');
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
            'locale'            => $locale
        ];

            return view('admin.products.forms.edit', $data);
        } catch (\Throwable $e) {
            return view('admin.products.forms.edit', $data);
        }
    }

    public function delete(Request $request, $id){
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
            $locale = Session::get('locale');
        }

        if (isset($params['entity_id'])) {
            $product    = $this->productsservice->show($params['entity_id']);
            // $params     = (array) json_decode($product->data, true);
            $params     = $product->toArray();
        }

        if (isset($params[$locale])) {
            $params = $params[$locale];
        }

        $html       = $this->structureservice->getHtml(self::ENTITY, $params);
        return response($html);
    }

    public function properties(){

    }

    
}
