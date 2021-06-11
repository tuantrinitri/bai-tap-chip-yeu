<?php

use Modules\Post\Models\Category;

app()->getLocale();
$categories = Category::get();
$menuitem = [];
foreach ($categories as $category) {
   $menuitem[] = [
      'title_vi' => isset($category->translate('vi', true)->title) ? $category->translate('vi', true)->title : '',
      'title_en' => isset($category->translate('en', true)->title) ? $category->translate('en', true)->title : '',
      'link' => 'danh-muc/' . $category['slug']
   ];
}
