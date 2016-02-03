<?php namespace Sroutier\MenuBuilder\Controllers;
/**
 * This file is part of the Laravel package: Menu-Builder,
 * a menu and breadcrumb trails management solution for Laravel.
 *
 * @license GPLv3
 * @author Sebastien Routier (sroutier@gmail.com)
 * @package Sroutier\MenuBuilder
 */

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class MenusDemoController extends Controller {

    /**
     * @return \Illuminate\View\View
     */
    public function demo()
    {
        return view('menu-builder::menu-builder-demo');
    }

}