<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\SectionService;
use App\Services\StateService;
use App\Services\LocaleService;
use App\Services\CategoryService;

use App\Models\Section;
use App\Models\Categorie;

class IndexController extends Controller
{
    protected $sectionservice;
    protected $stateservice;
    protected $localeservice;
    protected $categoryservice;

    public function __construct(StateService $stateservice, SectionService $sectionservice, CategoryService $categoryservice){
        $this->stateservice     = $stateservice;
        $this->sectionservice   = $sectionservice;
        $this->categoryservice  = $categoryservice;
    }
    public function index(){
        // $states = $this->stateservice->index();
        $state = $this->stateservice->show(2);
        // $state->name = 'activo';
        // $state->save();
        // dd($state->toArray());

        // $sections = $this->sectionservice->index();
        // $categories = $this->categoryservice->index();
        // dd($sections->toArray());

        // $section = $sections->first();
        
        // ;

        // $params = [
        //     Section::NAME 			=> 'about',
        //     Section::DESCRIPTION 	=> 'about descirption',
        //     Section::STATE			=> $state->id,
        //     Section::URL			=> 'about',
        //     Section::TAGS 			=> 'about',
        // ];
        // $section->fill($params);
        // $section->save();
        
        // $sections = $this->sectionservice->store($params);
        
        // $params = [
        //     'name'  => 'inactive'
        // ];

        // $state = $this->stateservice->store($params);

        // $params = [
        //     'id'            => 'en',
        //     'description'   => 'english'
        // ];

        // $locale = $this->localeservice->store($params);

   
        // $params = [
        //     Categorie::NAME 		=> 'about',
        //     Categorie::DESCRIPTION 	=> 'about description',
        //     Categorie::URL			=> 'about',
        //     Categorie::TAGS			=> 'about',
        //     Categorie::FATHER 		=> null,
        //     Categorie::STATE 		=> $state->id,
        // ];
        // $category = $this->categoryservice->store($params);
        // $params = [
        //     Categorie::NAME 		=> 'home',
        //     Categorie::DESCRIPTION 	=> 'home description',
        //     Categorie::URL			=> 'home',
        //     Categorie::TAGS			=> 'home',
        //     Categorie::FATHER 		=> null,
        //     Categorie::STATE 		=> $state->id,
        // ];
        // dd($category->toArray());

        // $categories = $this->categoryservice->findBy(['id' => 9]);
        // $categories->name           = 'inicio';
        // $categories->description    = 'descripcion de inicio';
        // $categories->save();

        // dd($categories->toArray());

        // $categories = $this->categoryservice->index();
        $categories = $this->categoryservice->getParents();
        // dd($categories->toArray());
        $data = ['categories' => $categories->toArray()];
        return view('welcome', $data);
    }
}
