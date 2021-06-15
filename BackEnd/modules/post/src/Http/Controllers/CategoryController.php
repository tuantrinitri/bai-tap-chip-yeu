<?php

namespace Modules\Post\Http\Controllers;

use Core\Supports\Controllers\BaseController;
use Illuminate\Http\Request;
use Modules\Post\Http\Requests\CategoryRequest;
use Modules\Post\Repositories\Interfaces\CategoryInterface;
use Modules\Post\Repositories\Interfaces\PostInterface;

class CategoryController extends BaseController
{
    protected $postRepository;
    protected $categoryRepository;

    function __construct(
        CategoryInterface $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }

    public function getList()
    {
        $categories = $this->categoryRepository->all();
        return view('post::admin.category.list', compact('categories'));
    }
    public function postAdd(CategoryRequest $request)
    {
        $this->categoryRepository->createNewCategory($request);
        return redirect()->route('category.admin.list')->with('flash_data', ['type' => 'success', 'message' => trans('post::notification.create_success')]);
    }
    public function getEdit($id)
    {
        $data['category_edit'] = $this->categoryRepository->findOrfail($id);
        if ($data['category_edit']) {
            $data['categories'] = $this->categoryRepository->all();
            return view('post::admin.category.edit', $data);
        }
        return redirect()->route('category.admin.list')->with('flash_data', ['type' => 'error', 'message' => 'post::notification.no_category']);
    }
    public function postEdit(CategoryRequest $request)
    {
        $this->categoryRepository->updateCategory($request);
        return redirect()->route('category.admin.list')->with('flash_data', ['type' => 'success', 'message' => trans('post::notification.update_success')]);
    }
    public function getDelete($id)
    {
        $this->categoryRepository->deleteAllCategory($id);
        return redirect()->route('category.admin.list')->with('flash_data', ['type' => 'success', 'message' => trans('post::notification.delete_success')]);
    }
    public function status(Request $request)
    {
        try {
            $this->categoryRepository->update([
                'status' => $request->status,
            ], $request->id);
            return response()->json(['status' => true, 'msg' => trans('post::notification.update_status')]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'msg' => trans('post::notification.error')]);
        }
    }
    public function order(Request $request)
    {
        $id = $request->id;
        $order = $request->order;
        $this->categoryRepository->update(['order' => $order], $id);
        $request->session()->flash('flash_data', ['type' => 'success', 'message' => trans('post::notification.update_status')]);
        return response()->json([
            'status' => true,
            'message' => trans('post::notification.update_status')
        ]);
    }
}
