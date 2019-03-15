<?php

namespace App\Services;

use App\Services\StateService;
use App\Services\LayoutService;

use App\Definitions\Elements\Card;
use App\Definitions\Elements\Box;
use App\Definitions\Elements\carrousel;
use View;
use Session;
use Config;

class StructureService
{
    const ENTITY = 'layout';

    protected $layout;

    public function __construct(StateService $stateservice, LayoutService $layoutsservice)
    {
        $this->stateservice     = $stateservice;
        $this->layoutsservice   = $layoutsservice;

        $states = $this->stateservice->index(self::ENTITY);
        $active = Config::get('app.default.DB_STATE_ACTIVE');
        foreach ($states as $key => $state) {
            if ($state->value == $active) {
                $stateactiveid = $state->id;
            }
        }
        $layout = $this->layoutsservice->getByState($stateactiveid);

        $this->setLayout($layout);
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

    /**
     * Undocumented function
     *
     * @param  Section $element
     * @param  array   $data
     * @return void
     */
    public function parseHtml($element, $data = [])
    {
        $type = $element->type()->first();
        if (isset($type->definition)) {
            return $this->getHtml($type->definition, $data);
        }
    }

    /**
     * Undocumented function
     *
     * @param  string $definition
     * @param  array  $data
     * @return void
     */
    public function getHtml($definition, $data = [])
    {
        $view = View::make("layouts.{$this->layout->name}.html.elements.{$definition}.template", $data);
        $contents = (string) $view;
        // or
        $contents = $view->render();
        return $contents;
    }






    public function getHtmlProperties($definition, $data = [])
    {
        $view = View::make("layouts.{$this->layout->name}.html.elements.{$definition}.properties", $data);
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



    public function parseEntity($entity, $data = [])
    {
        $html       = [];

        $childs = $entity->childrens()->get();
        if (count($childs)>0) {
            $data['childs'] = $this->parse($childs, $data);
        }

        $entitydata = isset($entity->data) ? json_decode($entity->data, true) : [];

        $html = $this->parseHtml($entity, array_merge($entitydata, $data));

        return $html;
    }

    public function parse($entities, $data = [])
    {
        $html= [];

        foreach ($entities as $key => $entity) {
            $html[] = $this->parseEntity($entity, $data);
        }

        return $html;
    }

    /**
     * Set the value of layout
     *
     * @return self
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;

        return $this;
    }

    /**
     * Get the value of layout
     */
    public function getLayout()
    {
        return $this->layout;
    }
}
