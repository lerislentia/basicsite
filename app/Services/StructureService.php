<?php

namespace App\Services;

use App\Definitions\Elements\Card;
use App\Definitions\Elements\Box;
use App\Definitions\Elements\carrousel;
use View;

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
        $view = View::make("html.elements.{$definition}Form");
        $contents = (string) $view;
        // or
        $contents = $view->render();
        return $contents;        
    }

    public function parseSections($sections, $data = []){
        $html= [];
        
        foreach ($sections as $key => $section) {
            
            $html[$section->order] = $this->parseSection($section, $data);
        }
        $caca = 1;
        return $html;
    }

    public function parseSection($section, $data = []){
        $html       = [];

        $childssections = $section->sections()->get();
            if(count($childssections)>0){
                $data['sections'] = $this->parseSections($childssections, $data);
            }
        

        $elements   = $section->elements()->get();
            foreach ($elements as $key => $element) {
                $html['elements'][$element->order] = $this->parseHtml($element, array_merge(json_decode($element->data, true), $data));
            }

        $html = $this->parseHtml($section, array_merge($data, ['attrId' => 'idsection']));

        return $html;
    }



    public function parseHtml($element, $data = []){
        $type = $element->type()->first();
        if(isset($type->definition)){
            return $this->getHtml($type->definition, $data);
            
        }

    }

    public function getHtml($definition, $data = [])
    {
        $view = View::make("html.elements.{$definition}", $data);
        $contents = (string) $view;
        // or
        $contents = $view->render();
        return $contents;
    }
}
