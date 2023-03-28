<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExport implements FromQuery, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Order::with('order_items');
    }

    public function headings(): array
    {
        return [
            'ID',
            'User',
            'Runner',
            'Customer',
            'Total Amount',
            'Status',
            'Order Date',
            'Delivery Date',
            'Area',
            'Note',
            'Order Items'
        ];
    }

    public function map($order): array
    {
        $orderItems = $order->order_items->map(function ($item) {
            return '(Item: ' . $item->item->item . ', Item Type : ' . $item->item->item_type . ', Item Note : ' . $item->item->item_note . ', Quantity: ' . $item->quantity . ', Rate: ' . $item->rate . ', Unit: ' . $item->unit .  ', Packing: ' . $item->packing . ')';
        })->implode("\n");

        return [
            $order->id,
            $order->user->name,
            $order->runner->runner,
            $order->customer->customer,
            number_format($order->total, 2, '.', ','),
            $order->status,
            $order->order_date,
            $order->delivery_date,
            $order->area,
            $order->note,
            $orderItems
        ];
    }
}
