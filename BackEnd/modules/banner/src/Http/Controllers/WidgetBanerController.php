<?php

namespace Modules\Banner\Http\Controllers;

use Core\Supports\Controllers\BaseController;
use Modules\Banner\Repositories\Interfaces\WidgetInterface;

class WidgetBanerController extends BaseController
{
   /**
    * BannerController Constructor
    *
    * @param WidgetInterface $WidgetBanerRepository
    */

   function __construct(
      WidgetInterface $widgetRepository
   ) {
      $this->widgetRepository = $widgetRepository;
   }

   public function index()
   {
      page_title()->setTitle('Danh sách Widget baner');
      $widgets = $this->widgetRepository->orderBy('id', 'desc')->paginate(20);
      dd($widgets);
      return view('banner::admin.banner.list', compact('banners'));
   }
}
