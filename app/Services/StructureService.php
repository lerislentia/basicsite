<?php

namespace App\Services;

use App\Definitions\Elements\Card;
use App\Definitions\Elements\Box;
use App\Definitions\Elements\carrousel;
use View;
use Session;

class StructureService
{
    public function __construct()
    {
    }

    public function getStructureByType($type)
    {
        switch ($type) {
            case 'Card':
                return new Card();
                break;
            case 'Box':
                return new Box();
                break;
            case 'Carrousel':
            return new carrousel();
                break;
            default:
                return new Card();
        }
    }

    public function getHtmlForm(){
        $view = View::make("layouts.front.html.elements.{$definition}Form");
        $contents = (string) $view;
        // or
        $contents = $view->render();
        return $contents;        
    }

    // public function parseSections($sections, $data = []){
    //     $html= [];
        
    //     foreach ($sections as $key => $section) {
            
    //         $html[$section->order] = $this->parseSection($section, $data);
    //     }
    //     $caca = 1;
    //     return $html;
    // }

    // public function parseSection($section, $data = []){
    //     $html       = [];

    //     $childssections = $section->sections()->get();
    //         if(count($childssections)>0){
    //             $data['sections'] = $this->parseSections($childssections, $data);
    //         }
        

    //     $elements   = $section->elements()->get();
    //         foreach ($elements as $key => $element) {
    //             $elementdata = isset($element->data) ? json_decode($element->data, true) : [];
    //             $data['elements'][$element->order] = $this->parseHtml($element, array_merge($elementdata, $data));
    //         }
    //     $sectiondata = isset($section->data) ? json_decode($section->data, true) : [];
    //     $html = $this->parseHtml($section, array_merge($sectiondata, $data));

    //     return $html;
    // }



    public function parseHtml($element, $data = []){
        $type = $element->type()->first();
        if(isset($type->definition)){
            return $this->getHtml($type->definition, $data);
            
        }

    }

    public function getHtml($definition, $data = [])
    {
        $view = View::make("layouts.front.html.elements.{$definition}.template", $data);
        $contents = (string) $view;
        // or
        $contents = $view->render();
        return $contents;
    }

    public function getHtmlProperties($definition, $data = []){

        $view = View::make("layouts.front.html.elements.{$definition}.properties", $data);
        // $contents = (string) $view;
        // or
        $contents = $view->render();
        return $contents;
    }



    /**
     * prueba 
     * 
     * 
     */


    
    public function parseEntity($entity, $data = []){
        $html       = [];

        $childs = $entity->childrens()->get();
            if(count($childs)>0){
                $data['childs'] = $this->parse($childs, $data);
            }

        $entitydata = isset($entity->data) ? json_decode($entity->data, true) : [];

        $html = $this->parseHtml($entity, array_merge($entitydata, $data));

        return $html;
    }

    public function parse($entities, $data = []){
        $html= [];

        foreach ($entities as $key => $entity) {
            
            $html[$entity->order] = $this->parseEntity($entity, $data);
        }
        $caca = 1;
        return $html;
    }
}
