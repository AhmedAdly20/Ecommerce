<?php

use Carbon\Carbon;

function setActiveCategory($category, $output = 'active')
{
    return request()->category == $category ? $output : '';
}

function productImage($path)
{
    return $path && file_exists('storage/'.$path) ? asset('storage/'.$path) : asset('img/not-found.jpg');
}

function getNumbers(){
    $tax = config('cart.tax') / 100;
    $discount = session()->get('coupon')['discount'] ?? 0;
    $oldSubTotal = Cart::subtotal();
    $newSubtotal = (int)$oldSubTotal - (int)$discount;
    if($newSubtotal < 0){
        $newSubtotal = 0;
    }
    $newTax = $newSubtotal * $tax;
    $newTotal = $newSubtotal * (1 + $tax);

    return collect([
        'tax' => $tax,
        'discount' => $discount,
        'newSubtotal' => $newSubtotal,
        'newTax' => $newTax,
        'newTotal' => $newTotal,
    ]);
}

function getStockLevel($quantity)
{
    if ($quantity > setting('site.stock_threshold')) {
        $stockLevel = '<div class="badge badge-success">In Stock</div>';
    } elseif ($quantity <= setting('site.stock_threshold') && $quantity > 0) {
        $stockLevel = '<div class="badge badge-warning">Low Stock</div>';
    } else {
        $stockLevel = '<div class="badge badge-danger">Not available</div>';
    }

    return $stockLevel;
}

function presentDate($date)
{
    return Carbon::parse($date)->format('M d, Y');
}