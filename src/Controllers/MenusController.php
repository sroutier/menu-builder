<?php namespace Sroutier\MenuBuilder\Controllers;
/**
 * This file is part of the Laravel package: Menu-Builder,
 * a menu and breadcrumb trails management solution for Laravel.
 *
 * @license GPLv3
 * @author Sebastien Routier (sroutier@gmail.com)
 * @package Sroutier\MenuBuilder
 */

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Sroutier\MenuBuilder\Models\Menu;

class MenusController extends Controller {

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Load all menus ordered by Parent (asc), Position (asc), Label (asc) and finally ID (asc).
        $menus = Menu::orderBy('parent_id', 'ASC')->orderBy('position', 'ASC')->orderBy('label', 'ASC')->orderBy('id', 'ASC')->get();
        // Convert menu query result to JSON for JSTree
        $menusJson = $this->menusOrmToJsTreeJson($menus);
        
        // List label and id of all menus ordered by Label (asc). 
        $parents = Menu::orderBy('label', 'ASC')->orderBy('id', 'ASC')->get();
        // Convert to array.
        $parents = $parents->toArray();

        // Return view
        return view('menu-builder::admin-menus', compact('menus', 'menusJson', 'parents'));
    }

    /**
     * @param array $menusCol
     * @return string
     */
    private function menusOrmToJsTreeJson(Collection $menusCol)
    {
        $jsTreeCol = $menusCol->map(function ($item, $key) {
            $id             = $item->id;
            $parent_id      = $item->parent_id;
            $label          = $item->label;
            $icon           = $item->icon;
            // Fix attribute of root item for JSTree
            if ( ($id == $parent_id) && ('Root' == $label) ) {
                $parent_id = '#';
            }

             return collect(['id' => $id, 'parent' => $parent_id, 'text' => $label, 'icon' => $icon]);
        });

        $menusJson = $jsTreeCol->toJson();

        return $menusJson;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function save(Request $request)
    {
        $msg = "";
        $attributes = $request->all();

        $id = $attributes['id'];

        if ($id) { // If $id is not null or blank we must be editing.
            // Locate existing menu item.
            $menuItem = Menu::find($id);

            if (!$menuItem->isEditable())
            {
                $msg = trans('menu-builder::menu-builder.update-failed-cant-be-edited', ['id' => $menuItem->id, 'label' => $menuItem->label]);
            }
            else
            {
                // validate attributes.
                $this->validate($request, array(    'name' => 'required|unique:menus,id,' . $id,
                                                    'label' => 'required',
                ));
                // Update menu item.
                $menuItem->update($attributes);

                $msg = trans('menu-builder::menu-builder.update-success');
            }

        }
        else { // else creating new menu item.
            // First unset/remove blank 'id' element from the array, otherwise the insert SQL statement will not
            // include an incremented value for the identity column, but instead the value of id which is
            // blank: ''.
            unset($attributes['id']);
            // Validate attributes.
            $this->validate($request, array(    'name' => 'required|unique:menus',
                                                'label' => 'required',
            ));
            // Create new menu item.
            $menuItem = Menu::create($attributes);

            $msg = trans('menu-builder::menu-builder.create-success');
        }

        return redirect('/admin/menus')->with('status_message', $msg);
    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);

        if (!$menu->isDeletable())
        {
            $msg = trans('menu-builder::menu-builder.delete-failed-cant-be-deleted', ['id' => $menu->id, 'label' => $menu->label]);
        }
        else
        {
            $menu->delete($id);

            $msg = trans('menu-builder::menu-builder.delete-success');
        }

        return redirect('/admin/menus')->with('status_message', $msg);
    }

    /**
     * Delete Confirm
     *
     * @param   int   $id
     * @return  View
     */
    public function getModalDelete($id)
    {
        $error = null;

        $menu = Menu::find($id);

        if (!$menu->isDeletable())
        {
            $modal_title = trans('menu-builder::menu-builder.modal-delete-title-cant-be-deleted');
            $modal_message  = trans('menu-builder::menu-builder.modal-delete-message-cant-be-deleted', ['id' => $menu->id, 'label' => $menu->label]);
            // Force a redirect to the index page if the user clicks on OK.
            $modal_route = route('admin.menus.index');
        }
        else
        {
            $modal_title = trans('menu-builder::menu-builder.modal-delete-title');
            $modal_message  = trans('menu-builder::menu-builder.modal-delete-message', ['id' => $menu->id, 'label' => $menu->label]);

            $modal_route = route('admin.menus.delete', array('id' => $menu->id));
        }

        return view('menu-builder::modal_confirmation', compact('error', 'modal_route', 'modal_title', 'modal_message'));

    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getData(Request $request)
    {
        $id = $request->input('id');
        $menuItem = Menu::with('parent')->find($id);

        return $menuItem;
    }

}