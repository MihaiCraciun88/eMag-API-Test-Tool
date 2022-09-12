<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderAttachment;
use App\Services\EmagService;
use Illuminate\Support\Facades\Auth;

class EmagController extends Controller
{
    public function orderRead(Request $request)
    {
        $orders = Order::where('mkt_id', Auth::id());
        $this->_filter($request, $orders);
        $this->_limit($request, $orders);
        return EmagService::response($orders->get());
    }

    public function orderCount(Request $request)
    {
        $orders = Order::where('mkt_id', Auth::id());
        $this->_filter($request, $orders);

        $itemsPerPage = $this->_getItemsPerPage($request);
        $total = $orders->count();
        return EmagService::responseCount($total, $itemsPerPage);
    }

    public function orderAttachmentsSave(Request $request)
    {
        $data = $request->all();
        $attachment = OrderAttachment::create($data[0]);
        return EmagService::response($attachment);
    }

    public function vatRead()
    {
        return EmagService::response();
    }
    
    public function handlingTimeRead()
    {
        return EmagService::response([
            ['id' => 0],
            ['id' => 1],
            ['id' => 2],
            ['id' => 3],
            ['id' => 6],
            ['id' => 9],
            ['id' => 30],
            ['id' => 60],
            ['id' => 90],
        ]);
    }

    public function productOfferRead(Request $request)
    {
        $product = Product::where('mkt_id', Auth::id());
        $this->_filter($request, $product);
        $this->_limit($request, $product);
        return EmagService::response($product->get());
    }

    public function productOfferCount(Request $request)
    {
        $product = Product::where('mkt_id', Auth::id());
        $this->_filter($request, $product);

        $itemsPerPage = $this->_getItemsPerPage($request);
        $total = $product->count();
        return EmagService::responseCount($total, $itemsPerPage);
    }

    public function productOfferStock(Request $request, Product $product)
    {
        if ($product->mkt_id !== Auth::id()) {
            abort(403);
        }
        $stock = $request->stock;
        if (!is_numeric($stock)) {
            abort(400);
        }
        $product->stock = $stock;
        $product->save();

        return $stock;
    }

    private function _filter(Request $request, $model)
    {
        $data = $request->data;
        $data['createdBefore'] = $data['createdBefore'] ?? now();
        $data['modifiedBefore'] = $data['modifiedBefore'] ?? now();
        if (isset($data['id'])) {
            $model->where('id', $data['id']);
        }
        if (isset($data['status'])) {
            $model->where('status', $data['status']);
        }
        if (isset($data['createdAfter']) && isset($data['createdBefore'])) {
            $model->whereBetween('created', [$data['createdAfter'], $data['createdBefore']]);
        }
        if (isset($data['modifiedAfter']) && isset($data['modifiedBefore'])) {
            $model->whereBetween('modified', [$data['modifiedAfter'], $data['modifiedBefore']]);
        }
    }

    private function _limit(Request $request, $model)
    {
        $itemsPerPage = $this->_getItemsPerPage($request);
        $currentPage = $this->_getCurrentPage($request);
        $model->limit($itemsPerPage);
        $model->offset(($currentPage - 1) * $itemsPerPage);
    }

    private function _getItemsPerPage(Request $request)
    {
        $data = $request->data;
        $itemsPerPage = $data['itemsPerPage'] ?? 100;
        if ($itemsPerPage > 250) {
            $itemsPerPage = 250;
        }
        return $itemsPerPage;
    }

    private function _getCurrentPage(Request $request)
    {
        $data = $request->data;
        $currentPage = $data['currentPage'] ?? 1;
        if ($currentPage < 1) {
            $currentPage = 1;
        }
        return $currentPage;
    }
}
