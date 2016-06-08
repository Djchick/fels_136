<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Http\Requests\CategoryRequest;
use Illuminate\Pagination\Paginator;

class CategoryController extends Controller {

    /**
     * The category repository instance.
     */
    
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }

    public function index(Request $request) {
        $categories = $this->categoryRepository->get();
        $page = $request->get("page");
        $lastPage = $categories->lastPage();
        if($page && $page > $lastPage) {
            Paginator::currentPageResolver(function () use ($lastPage) {
                return $lastPage;
            });
            $categories = $this->categoryRepository->get();
        }
        $this->viewData['categories'] = $categories;
        return view('category.list', $this->viewData);
    }

    public function create() {
        return view('category.add');
    }

    public function store(CategoryRequest $request) {
        $input = $request->only([
            'name',
        ]);
        if(!$this->categoryRepository->create($input)) {
            return redirect()->route('admin.category.create')->withErrors(trans('category/messages.common_error'));
        }
        return redirect()->route('category.index')->withMessage(trans('category/messages.create_complete'));
    }
    
    public function destroy($id) {
        $category = $this->categoryRepository->find($id);
        if($category && $category->delete()) {
            return redirect()->route('category.index')->withMessage(trans('category/messages.delete_complete'));
        }
        return redirect()->route('category.index')->withErrors(trans('category/messages.common_error'));
    }

    public function update(CategoryRequest $request, $id) {
        $category = $this->categoryRepository->find($id);
        $category->update($request->only(['name']));
        if($category) {
            return redirect()->route('admin.category.edit', $id)->withMessage(trans('category/messages.update_complete'));
        }
        return redirect()->route('admin.category.edit', $id)->withErrors(trans('category/messages.common_error'));
    }

    public function edit($id) {
        $category = $this->categoryRepository->find($id);
        $this->viewData = [
            'category' => $category,
        ];
        return view('category.edit', $this->viewData);
    }
}