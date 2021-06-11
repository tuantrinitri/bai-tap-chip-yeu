<?php

namespace Modules\Post\Http\Controllers;

use Core\Supports\Controllers\BaseController;
use Illuminate\Http\Request;
use League\CommonMark\HtmlRenderer;
use Modules\Post\Http\Requests\CategoryRequest;
use Modules\Post\Repositories\Interfaces\CategoryInterface;
use Modules\Post\Repositories\Interfaces\CategoryTranslationInterface;
use Modules\Post\Repositories\Interfaces\PostInterface;

class CategoryController extends BaseController
{
    protected $postRepository;
    protected $categoryRepository;

    function __construct(
        CategoryInterface $categoryRepository,
        CategoryTranslationInterface $transtionRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->transtionRepository = $transtionRepository;
    }

    public function index(Request $request)
    {
        $categories = $this->categoryRepository->with('categoryTranstion')->get();
        return view('post::admin.category.list', compact('categories'));
    }

    public function create(Request $request)
    {
        $oldCategory = $request->all();
        if (isset($oldCategory)) {
            $data['slug'] = $this->categoryRepository->with('categoryTranstion')->find($oldCategory['category_id'])->toArray()['slug'];;
            $data['lang'] = $oldCategory['lang'];
            $data['category_id'] = $oldCategory['category_id'];
            $data['categories'] = $this->categoryRepository->all();
        }
        return view('post::admin.category.create', $data);
    }

    public function store(CategoryRequest $request)
    {
        $this->categoryRepository->createCategory($request);
        return redirect()->route('category.admin.index')->with('flash_data', ['type' => 'success', 'message' => trans('post::notification.create_success')]);
    }

    public function edit(Request $request, $id)
    {
        $data['category_edit'] = $this->categoryRepository->with('categoryTranstion')->findOrfail($id);
        if ($data['category_edit']) {
            $data['transtion'] = $this->transtionRepository->where('category_id', $id)->where('locale', $request->lang)->first();
            $data['categories'] = $this->categoryRepository->all();
            return view('post::admin.category.edit', $data);
        }
        return redirect()->route('category.admin.index')->with('flash_data', ['type' => 'error', 'message' => 'post::notification.no_category']);
    }

    public function update(CategoryRequest $request)
    {
        $this->categoryRepository->updateCategory($request);
        return redirect()->route('category.admin.index')->with('flash_data', ['type' => 'success', 'message' => trans('post::notification.update_success')]);
    }

    public function delete($id)
    {
        $this->categoryRepository->deleteAllCategory($id);
        return redirect()->route('category.admin.index')->with('flash_data', ['type' => 'success', 'message' => trans('post::notification.delete_success')]);
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
