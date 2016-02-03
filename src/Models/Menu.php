<?php namespace Sroutier\MenuBuilder\Models;
/**
 * This file is part of the Laravel package: Menu-Builder,
 * a menu and breadcrumb trails management solution for Laravel.
 *
 * @license GPLv3
 * @author Sebastien Routier (sroutier@gmail.com)
 * @package Sroutier\MenuBuilder
 */

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * @var array
     */
    protected $fillable = [ /*'id',*/ 'name', 'label', 'position', 'icon', 'separator', 'url',
                            'enabled', 'parent_id'];

    public function children() {

        // Root is the parent of itself therefore also a child of itself.
        // This can create an infinite loop so we must forcibly filter
        // out that entry here.
        $kids = $this->hasMany('Sroutier\MenuBuilder\Models\Menu','parent_id')
            ->where('name', '!=', 'root')
            ->orderBy('position', 'ASC')
            ->orderBy('label', 'ASC')
            ->orderBy('id', 'ASC');

        return  $kids;
    }

    public function parent() {
        $dad = $this->belongsTo('Sroutier\MenuBuilder\Models\Menu','parent_id');
        return $dad;
    }

    /**
     * @return string
     */
    public function getTextAttribute()
    {
        return $this->label;
    }

    /**
     * @return bool
     */
    public function isDeletable()
    {
        // Protect the root menu from deletion
        if ( ('root' == $this->name) ) {
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function isEditable()
    {
        // Protect the root menu from edition
        if ( ('root' == $this->name) ) {
            return false;
        }

        return true;
    }


}
