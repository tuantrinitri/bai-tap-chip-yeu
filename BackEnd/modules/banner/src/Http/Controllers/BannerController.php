<?php

namespace Modules\Banner\Http\Controllers;

use Core\Supports\Controllers\BaseController;
use Illuminate\Http\Request;
use Modules\Banner\Http\Requests\BannerRequest;
use Modules\Banner\Repositories\Interfaces\BannerInterface;
use Modules\Banner\Repositories\Interfaces\WidgetInterface;

class BannerController extends BaseController
{
    /**
     * BannerController Constructor
     *
     * @param BannerInterface $bannerRepository
     */
    public   function __construct(
        BannerInterface $bannerRepository,
        WidgetInterface $widgetRepository
    ) {
        $this->bannerRepository = $bannerRepository;
        $this->widgetRepository = $widgetRepository;
    }

    public function index()
    {
        page_title()->setTitle(trans('banner::admin.list_banner'));
        $banners = $this->bannerRepository->orderBy('id', 'desc')->paginate(20);
        return view('banner::admin.banner.list', compact('banners'));
    }

    public function create()
    {
        page_title()->setTitle(trans('banner::admin.create_banner'));
        // $widgets = $this->widget();
        return view('banner::admin.banner.create', compact('widgets'));
    }

    public function store(BannerRequest $request)
    {
        $this->bannerRepository->store($request);
        return redirect()->route('banner.admin.index')->with('flash_data', ['type' => 'success', 'message' => 'Đã thêm dữ liệu']);
    }


    public function edit($id)
    {
        $banner = $this->bannerRepository->find($id);
        // $widgets = $this->widget();
        return view('banner::admin.banner.edit', compact('banner', 'widgets'));
    }

    public function update(BannerRequest $request, $id)
    {
        $this->bannerRepository->updateBanner($request, $id);
        return redirect()->route('banner.admin.index')->with('flash_data', ['type' => 'success', 'message' => 'Đã cập nhật dữ liệu']);
    }

    public function delete($id)
    {
        $this->bannerRepository->delete($id);
        return redirect()->route('banner.admin.index')->with('flash_data', ['type' => 'success', 'message' => 'Đã xóa dữ liệu']);
    }
    function widget()
    {
        return $this->widgetRepository->get();
    }
}