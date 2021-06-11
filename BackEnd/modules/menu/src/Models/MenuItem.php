<?php

namespace Modules\Menu\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class MenuItem extends Model implements TranslatableContract
{
   use Translatable;
   public $translatedAttributes = ['title'];
   /**
    * The database table used by the model.
    *
    * @var string
    */
   protected $table = 'menu_items';

   /**
    * @var array
    */
   protected $fillable = [
      'id',
      'menu_id',
      'parent_id',
      'link',
      'order',
      'module',
      'target',
      'status',
   ];

   public function itemTranstion()
   {
      return $this->hasMany(MenuItemTranslation::class, 'item_id');
   }

   public function menus()
   {
      return $this->belongsTo(Menu::class, 'menu_id');
   }

   function children()
   {
      return $this->hasMany(Menuitem::class, 'parent_id');
   }
}
