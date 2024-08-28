<?php
namespace App\Services;

use App\Models\User;
use App\Models\UserIp;
use App\Models\Order;
use App\Models\OrderAttachment;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class EmagService {
    public static function response($results = [], $message = '', $isError = false)
    {
        return [
            'isError'  => $isError,
            'messages' => [$message],
            'results'  => $results
        ];
    }

    public static function responseCount($total, $itemsPerPage)
    {
        return self::response([
            'noOfItems'    => (string) $total,
            'noOfPages'    => (string) ceil($total / $itemsPerPage),
            'itemsPerPage' => (string) $itemsPerPage
        ]);
    }

    public static function seeder(User $user, $productCount = 50, $orderCount = 10)
    {
        $productNumber = Product::select('id', 'sale_price')
            ->where('mkt_id', $user->id)
            ->count();
        if ($productNumber === 0) {
            $productCount = 50;
        }
        Product::factory()
            ->count($productCount)
            ->user($user)
            ->create();

        $ips = ['127.0.0.1'];
        foreach ($ips as $ip) {
            $userIp = UserIp::where('user_id', $user->id)
                ->where('ip', ip2long($ip))
                ->first();
            if (!$userIp) {
                UserIp::create([
                    'user_id'   => $user->id,
                    'ip'        => ip2long($ip), // svn
                ]);
            }
        }

        $customers = Customer::factory()
            ->count($orderCount)
            ->user($user)
            ->create();

        foreach ($customers as $customer) {
            $orders = Order::factory()
                ->count(1)
                ->user($user)
                ->customer($customer)
                ->create();
            foreach ($orders as $order) {
                if ($order->delivery_mode === 'pickup') {
                    OrderAttachment::create([
                        'name'      => sprintf("_K-MKTP%s.pdf", rand(2000, 10000)),
                        'url'       => 'https://marketplace.emag.ro/shitty-shipping-invoice',
                        'type'      => 13,
                        'order_id'  => $order->id
                    ]);
                }
                for ($i = 0; $i < rand(1, 3); $i++) {
                    $product = Product::query()
                        ->inRandomOrder()
                        ->where('mkt_id', $user->id)
                        ->first();
                    DB::table('order_products')->insert([
                        'order_id'          => $order->id,
                        'product_id'        => $product->id,
                        'quantity'          => rand(1, 3),
                        'name'              => $product->name,
                        'ext_part_number'   => $product->part_number,
                        'part_number_key'   => $product->part_number_key,
                        'currency'          => $product->currency,
                        'sale_price'        => $product->sale_price,
                        'original_price'    => $product->original_price,
                        'vat'               => $product->vat,
                        'status'            => $product->status,
                        'created'           => date('Y-m-d H:i:s'),
                        'modified'          => date('Y-m-d H:i:s'),
                    ]);
                }
            }
        }
    }
}