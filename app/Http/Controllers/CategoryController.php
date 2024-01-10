<?php

namespace App\Http\Controllers;

use App\Http\Requests\book\edit;
use App\Http\Requests\category\create;
use App\Models\Cateogry;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{

    public function index()
    {
    }

    public function create()
    {
        return view('pages.category.create');
    }

    public function store(create $request)
    {
        DB::beginTransaction();
        try {
            $category = Cateogry::create(
                [
                    'name' => $request->name,
                    'description' => $request->description
                ]
            );
            if ($category) {
                \App\Helpers\LogActivity::addToLog('Create Category');
                DB::commit();
                return redirect()->route('category.list')->with(['messages', 'Category created sucessfully.']);
            }
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
        }
    }
}
