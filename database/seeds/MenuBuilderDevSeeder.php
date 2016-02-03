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
//                  if( App::environment() === 'development' )
//                  {
//                      $this->call('MenuBuilderDevSeeder');
//                  }


use Illuminate\Database\Seeder;
use Sroutier\MenuBuilder\Models\Menu;

class MenuBuilderDevSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /////////
        // Find root menu.
        $menuRoot = Menu::where('name', 'root')->first();

        // Create Demo container.
        $menuPackageHome = Menu::create([
            'name'          => 'package-home',
            'label'         => 'sroutier/menu-builder',
            'icon'          => 'fa fa-github',
            'separator'     => false,
            'url'           => "https://github.com/sroutier/menu-builder",
            'enabled'       => true,
            'position'      => 0,
            'parent_id'     => $menuRoot->id,       // Parent is root.
        ]);
        $menuHome = Menu::create([
            'name'          => 'home',
            'label'         => 'Home',
            'icon'          => 'fa fa-home',
            'separator'     => false,
            'url'           => "/",
            'enabled'       => true,
            'position'      => 1,
            'parent_id'     => $menuRoot->id,       // Parent is root.
        ]);
        $menuDemo = Menu::create([
            'name'          => 'demo',
            'label'         => 'Demo',
            'icon'          => 'fa fa-book fa-colour-blue',
            'separator'     => false,
            'url'           => "/menu-builder-demo/home",
            'enabled'       => true,
            'position'      => 2,
            'parent_id'     => $menuRoot->id,       // Parent is root.
        ]);
        // Create Sub menu 1 container.
        $menuDemoSub1 = Menu::create([
            'name'          => 'sub-menu-1',
            'label'         => 'Sub menu 1',
            'icon'          => 'fa fa-bookmark',
            'separator'     => false,
            'url'           => "/menu-builder-demo/one",
            'enabled'       => true,
            'position'      => 0,
            'parent_id'     => $menuDemo->id,       // Parent is demo.
        ]);
        // Create Sub menu 2 container.
        $menuDemoSub2 = Menu::create([
            'name'          => 'sub-menu-2',
            'label'         => 'Sub menu 2',
            'icon'          => 'fa fa-bookmark-o',
            'separator'     => false,
            'url'           => "/menu-builder-demo/two",
            'enabled'       => true,
            'position'      => 1,
            'parent_id'     => $menuDemo->id,       // Parent is demo.
        ]);


        // Create Admin container.
        $menuAdmin = Menu::create([
            'name'          => 'admin',
            'label'         => 'Admin',
            'icon'          => 'fa fa-cog fa-colour-red',
            'separator'     => false,
            'url'           => null,                // No url.
            'enabled'       => true,
            'position'      => 999,                 // Artificially high number to ensure that it is rendered last.
            'parent_id'     => $menuRoot->id,       // Parent is root.
        ]);
        // Create Menus sub-menu
        $menuMenus = Menu::create([
            'name'          => 'menus',
            'label'         => 'Menus',
            'icon'          => 'fa fa-bars',
            'separator'     => false,
            'url'           => "/admin/menus",
            'enabled'       => true,
            'position'      => 0,
            'parent_id'     => $menuAdmin->id,      // Parent is admin.
        ]);

    }
}