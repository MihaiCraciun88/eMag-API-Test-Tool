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
        $query = Order::where('mkt_id', Auth::id());
        $this->_filter($request, $query);
        $this->_limit($request, $query);
        return EmagService::response($query->get());
    }

    public function orderCount(Request $request)
    {
        $query = Order::where('mkt_id', Auth::id());
        $this->_filter($request, $query);

        $itemsPerPage = $this->_getItemsPerPage($request);
        $total = $query->count();
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
        $itemsPerPage = $this->_getItemsPerPage($request);
        abort_if($itemsPerPage > 100, 400, 'Reading products is limited to maximum 100 elements');

        $query = Product::where('mkt_id', Auth::id());
        $this->_filter($request, $query);
        $this->_limit($request, $query);
        return EmagService::response($query->get());
    }

    public function productOfferCount(Request $request)
    {
        $query = Product::where('mkt_id', Auth::id());
        $this->_filter($request, $query);

        $itemsPerPage = $this->_getItemsPerPage($request);
        $total = $query->count();
        return EmagService::responseCount($total, $itemsPerPage);
    }

    public function productOfferStock(Request $request, Product $product)
    {
        abort_if($product->mkt_id !== Auth::id(), 403);
        abort_if(!is_numeric($request->stock), 400);

        $product->stock = $request->stock;
        $product->save();

        return response('', 204);
    }

    private function _filter(Request $request, $query)
    {
        $data = $request->data;
        $data['createdBefore'] = $data['createdBefore'] ?? now();
        $data['modifiedBefore'] = $data['modifiedBefore'] ?? now();
        if (isset($data['id'])) {
            $query->where('id', $data['id']);
        }
        if (isset($data['status'])) {
            $query->where('status', $data['status']);
        }
        if (isset($data['createdAfter']) && isset($data['createdBefore'])) {
            $query->whereBetween('created', [$data['createdAfter'], $data['createdBefore']]);
        }
        if (isset($data['modifiedAfter']) && isset($data['modifiedBefore'])) {
            $query->whereBetween('modified', [$data['modifiedAfter'], $data['modifiedBefore']]);
        }
    }

    private function _limit(Request $request, $query)
    {
        $itemsPerPage = $this->_getItemsPerPage($request);
        $currentPage = $this->_getCurrentPage($request);
        $query->limit($itemsPerPage);
        $query->offset(($currentPage - 1) * $itemsPerPage);
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
