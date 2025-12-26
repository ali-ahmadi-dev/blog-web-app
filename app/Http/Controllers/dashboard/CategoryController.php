<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\dashboard\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CategoryController extends Controller
{

    public function index():View
    {
        $categories = Category::withCount('articles')->orderBy('id', 'desc')->paginate(3);
        $categoryCount = Category::count();
        return view('backend.partials.news.category' , compact(['categories', 'categoryCount']));
    }


    public function store(Request $request) :RedirectResponse
    {



        $data = $request->validate([
            'name' => ['required', 'string', 'max:50', 'unique:categories,name'],
            'slug' => ['required', 'string', 'max:50', 'unique:categories,slug' , 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/'],
            'description' => ['nullable', 'string'],
            'icon' => ['required'],
        ], [
            'name.required' => 'برای دسته بندی نام انتخاب نمایید.',
            'name.max' => 'نام حداکثر می تواند شامل ۵۰ حرف باشد.',
            'name.unique' => 'این نام قبلا ثبت شده است نام دیگری انتخاب نمایید.',
            'slug.required' => 'برای دسته بندی شناسه لاتین انتخاب نمایید.',
            'slug.max' => 'نام حداکثر می تواند شامل ۵۰ حرف باشد.',
            'slug.unique' => 'شناسه ای با این نام قبلا ثبت شده است نام دیگری انتخاب نمایید.',
            'slug.slug' => 'فرمت شناسه صحیح نمی باشد اگر شناسه بیش از یک بخش دارد هر بخش را با ( - ) از هم جدا نمایید.',
            'icon.required' => 'برای دسته بندی آیکون انتخاب نمایید.'
        ]);


        try {
            Category::create($data);

            return redirect()
                ->back()
                ->with('success', 'دسته بندی با موفقیت ایجاد شد');

        } catch (QueryException $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'خطایی در ثبت دسته بندی رخ داد!');
        }
    }
}
