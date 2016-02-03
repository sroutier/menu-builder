<?php
/**
 * This file is part of the Laravel package: Menu-Builder,
 * a menu and breadcrumb trails management solution for Laravel.
 *
 * @license GPLv3
 * @author Sebastien Routier (sroutier@gmail.com)
 * @package Sroutier\MenuBuilder
 */


//    Call this database seeder from your main `database/seeds/DatabaseSeeder.php` file using the code below.
//
//          $this->call('ProductionSeeder');
//
//


use Illuminate\Database\Seeder;
use Sroutier\MenuBuilder\Models\Menu;

class MenuBuilderProdSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        ////////////////////////////////////
        // Create menu: root
        $menuRoot = Menu::create([
            'name'          => 'root',
            'label'         => 'Root',
            'icon'          => null,         // No point setting this as root is not visible.
            'separator'     => false,
            'url'           => null,         // No URL, root is not rendered or visible.
            'enabled'       => true,         // Must be enabled or sub-menus will not be available.
            'position'      => 0,
        ]);
        // Force root parent to itself.
        $menuRoot->parent_id = $menuRoot->id;
        $menuRoot->save();

        // Two examples provided to get you started!
//        // Create Home menu
//        $menuHome = Menu::create([
//            'name'          => 'home',
//            'label'         => 'Home',
//            'icon'          => 'fa fa-home fa-colour-green',
//            'separator'     => false,
//            'url'           => '/',
//            'enabled'       => true,
//            'position'      => 0,
//            'parent_id'     => $menuRoot->id,       // Parent is root.
//        ]);
//        // Create Dashboard menu
//        $menuDashboard = Menu::create([
//            'name'          => 'dashboard',
//            'label'         => 'Dashboard',
//            'icon'          => 'fa fa-dashboard',
//            'separator'     => false,
//            'url'           => '/dashboard',
//            'enabled'       => true,
//            'position'      => 0,
//            'parent_id'     => $menuHome->id,       // Parent is home.
//        ]);

    }
}