<?php

namespace Modules\Menu\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItemTranslation extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'menu_item_transtion';

    protected $fillable = [
        'id',
        'title',
        'locale',
        'content',
        'menu_item_id',
    ];
    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class, 'menu_item_id');
    }
}
