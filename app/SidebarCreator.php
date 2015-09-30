<?php
/**
 * Created by PhpStorm.
 * User: nilsenj
 * Date: 9/21/2015
 * Time: 5:21 AM
 */

namespace itway;

use Itway\Components\Sidebar\SidebarInterface;
use Itway\Components\Sidebar\SidebarTrait;


class SidebarCreator implements SidebarInterface
{
    use SidebarTrait;


    public function create($view) {

        return $view->with("sidebar", $this->formLastModelsCollection());

    }





}