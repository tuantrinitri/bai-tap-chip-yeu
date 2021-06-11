<?php

namespace Modules\Post\Http\Controllers;

use Core\Supports\Controllers\BaseController;
use Illuminate\Http\Request;
use Modules\Post\Http\Requests\PostRequest;
use Modules\Post\Models\Category;
use Modules\Post\Models\PostTranslation;
use Modules\Post\Repositories\Interfaces\CategoryInterface;
use Modules\Post\Repositories\Interfaces\CategoryTranslationInterface;
use Modules\Post\Repositories\Interfaces\PostInterface;
use Modules\Post\Repositories\Interfaces\PostTranlastionInterface;

class PostController extends BaseController
{

    protected $postRepository;
    protected $categoryRepository;
    protected $transtionRepository;
    protected $categoryTranslationRepository;

    function __construct(
        PostInterface $postRepository,
        PostTranlastionInterface $transtionRepository,
        CategoryInterface $categoryRepository,
        CategoryTranslationInterface $categoryTranslationRepository
    ) {
        $this->postRepository = $postRepository;
        $this->transtionRepository = $transtionRepository;
        $this->categoryRepository = $categoryRepository;
        $this->categoryTranslationRepository = $categoryTranslationRepository;
    }
    /** 
     * GET List Posts
     */
    public function index(Request $request)
    {
        $data = $this->postRepository->index($request);
        return view('post::admin.post.list', $data);
    }

    /**
     * GET Add a new post
     */
    public function create(Request $request)
    {
        if (Category::count() == 0) {
            return redirect()->route('category.admin.index')->with('flash_data', ['type' => 'warning', 'message' => trans('post::notification.first_category')]);
        }
        $oldPost = $request->all();
        $data = [];
        if (!empty($oldPost)) {
            $oldPostCheck = $this->postRepository->with('postTranlastion')->find($oldPost['post_id'])->toArray();
            $data['slug'] = $oldPostCheck['slug'];
            $data['content'] = $oldPostCheck['content'];
            $data['lang'] = $oldPost['lang'];
            $data['post_id'] = $oldPost['post_id'];
        }
        return view('post::admin.post.add', compact('data'));
    }

    public function store(PostRequest $request)
    {
        $this->postRepository->store($request);
        return redirect()->route('post.admin.index')->with('flash_data', ['type' => 'success', 'message' => trans('core::notification.create_success')]);
    }

    public function edit(Request $request, int $id)
    {
        $data['post'] = $this->postRepository->with('postTranlastion')->findOrfail($id);
        if ($data['post']) {
            $data['transtion'] = $this->transtionRepository->where('post_id', $id)->where('locale', $request->lang)->first();
        }
        return view('post::admin.post.edit', $data);
    }

    /**
     * post add post
     */
    public function update(PostRequest $request, $id)
    {
        $this->postRepository->updatePost($request, $id);
        return redirect()->route('post.admin.index')->with('flash_data', ['type' => 'success', 'message' => trans('core::notification.update_success')]);
    }

    /**
     * delete post
     */
    public function delete($id)
    {
        $postTranlastion = $this->transtionRepository->where('id', $id)->first();
        $checkDelete = $this->transtionRepository->where('post_id', $postTranlastion['post_id'])->get()->count();
        if ($checkDelete == 2) {
            $this->transtionRepository->delete($id);
        } else {
            $this->transtionRepository->delete($id);
            $this->postRepository->where('id', $postTranlastion['post_id'])->delete();
        }
        return redirect()->route('post.admin.index')->with('flash_data', ['type' => 'success', 'message' => trans('core::notification.delete_success')]);
    }

    public function status(Request $request)
    {
        try {
            $this->postRepository->update([
                'status' => $request->status,
            ], $request->id);
            return response()->json(['status' => true, 'msg' => trans('post::notification.update_status')]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'msg' => trans('post::notification.error')]);
        }
    }

    public function langue(Request $request)
    {
        try {
            $data = $this->categoryTranslationRepository->where('locale', $request->lang)->with('categories')->get()->toArray();
            return response()->json([
                'data' => $data,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'msg' => 'Đã xảy ra lỗi'
            ]);
        }
    }
}
