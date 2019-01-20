<?php

namespace App\Services;

use App\Definitions\Elements\Card;
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
            case label:
                break;
            case label:
                break;
            default:
        }
    }

    public function getHtml($definition)
    {
        $view = View::make("html.elements.{$definition}");
        $contents = (string) $view;
        // or
        $contents = $view->render();
        return $contents;
    }
}
