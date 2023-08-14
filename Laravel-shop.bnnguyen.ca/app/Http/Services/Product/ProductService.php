<?php


namespace App\Http\Services\Product;


use App\Models\Product;

class ProductService
{
    const LIMIT = 16;

    public function get($page = null)
    {
        return Product::select('id', 'name', 'price', 'price_sale', 'thumb')
            ->orderBy('id')
            ->when($page != null, function ($query) use ($page) {
                $query->offset($page * self::LIMIT);
            })
            ->limit(self::LIMIT)
            ->get();
    }

    public function show($id)
    {
        return Product::where('id', $id)
            ->where('active', 1)
            ->with('menu')
            ->firstOrFail();
    }

    public function more($id, $menuId)
    {
        return Product::select('id', 'name', 'price', 'price_sale', 'thumb')
            ->where('active', 1)
            ->where('id', '!=', $id)
            ->where('menu_id', $menuId)
            ->orderByDesc('id')
            ->limit(8)
            ->get();
    }

    public function getAll($request)
    {
        $query = Product::select('id', 'name', 'price', 'price_sale', 'thumb')
            ->where('active', 1);

        if ($request->input('cat') != null) {
            $query->where('menu_id', $request->input('cat'));
        }

        if ($request->input('search') != null && $request->input('search') != '') {
            $query->where('name', 'like', '%'.$request->input('search').'%');
        }

        if ($request->input('price-from') != null && $request->input('price-to') != null) {
            
            $query->where('price', '>=', $request->input('price-from'));
            $query->where('price', '<=', $request->input('price-to'));
        }

        if ($request->input('price') != null) {
            $query->orderBy('price', $request->input('price'));
        }

        return $query
            ->orderBy('id')
            ->paginate(12)
            ->withQueryString();
    }
}
