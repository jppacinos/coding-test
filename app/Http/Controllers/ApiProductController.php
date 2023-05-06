<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;

class ApiProductController extends Controller
{
    public function __construct(protected ProductService $productService)
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json(
            $this->productService->paginate($request->query('per_page', 15))
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:255|string',
            'description' => 'required|min:3|string',
            'price' => 'required|numeric|min:1|max:99999999|decimal:0,2',
        ]);

        $product = $this->productService->create($validated);

        return response()->json([
            'message' => 'Success',
            'data' => [
                'product' => $product,
            ],
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {
        $product = $this->productService->find($product);

        if (!$product) {
            return \abort(404, 'Resource not found!');
        }

        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product)
    {
        $validated = $request->validate([
            'name' => 'min:3|max:255|string',
            'description' => 'min:3|string',
            'price' => 'numeric|min:1|max:99999999|decimal:0,2',
        ]);

        $this->productService->update($product, $validated);

        return response('', 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($product)
    {
        $result = $this->productService->delete($product);

        if (\is_null($result)) {
            return \abort(404, 'Resource not found!');
        }

        return response('', 204);
    }
}
