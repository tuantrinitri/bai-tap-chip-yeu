<?php

namespace Modules\Banner\Repositories\Eloquents;

use Core\Supports\Repositories\Eloquents\BaseRepository;
use Modules\Banner\Models\Banner;
use Modules\Banner\Repositories\Interfaces\BannerInterface;

class BannerRepository extends BaseRepository implements BannerInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return Banner::class;
    }

    public function store($request)
    {
        $begin_time = null;
        $expired_time = null;
        if ($request->available_time) {
            $arr_time = explode(" - ", $request->available_time);
            $begin_time = \Carbon\Carbon::createFromFormat('d/m/Y', $arr_time[0])->format('Y-m-d');
            $expired_time = \Carbon\Carbon::createFromFormat('d/m/Y', $arr_time[1])->format('Y-m-d');
        }
        $this->create([
            'title' => $request->title,
            'file_src' => $request->file_src,
            'link' => $request->link,
            'begin_time' => $begin_time ? $begin_time : null,
            'expired_time' => $expired_time ? $expired_time : null
        ]);
    }
    public function updateBanner($request, $id)
    {
        $begin_time = null;
        $expired_time = null;
        if ($request->available_time) {
            $arr_time = explode(" - ", $request->available_time);
            $begin_time = \Carbon\Carbon::createFromFormat('d/m/Y', $arr_time[0])->format('Y-m-d');
            $expired_time = \Carbon\Carbon::createFromFormat('d/m/Y', $arr_time[1])->format('Y-m-d');
        }
        $this->update([
            'title' => $request->title,
            'file_src' => $request->file_src,
            'link' => $request->link,
            'begin_time' => $begin_time ? $begin_time : null,
            'expired_time' => $expired_time ? $expired_time : null
        ], $id);
    }
}