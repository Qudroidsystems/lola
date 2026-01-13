<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExport implements FromCollection, WithHeadings, WithMapping
{
    protected $orders;

    public function __construct($orders)
    {
        $this->orders = $orders;
    }

    public function collection()
    {
        return $this->orders;
    }

    public function headings(): array
    {
        return [
            'Order ID',
            'Customer Name',
            'Email',
            'Phone',
            'Total',
            'Status',
            'Items Count',
            'Created At',
        ];
    }

    public function map($order): array
    {
        return [
            '#' . str_pad($order->id, 6, '0', STR_PAD_LEFT),
            $order->name ?? $order->user?->name ?? 'Guest',
            $order->email,
            $order->phone,
            'RM ' . number_format($order->total, 2),
            ucfirst($order->status),
            $order->items->count(),
            $order->created_at->format('d M Y H:i'),
        ];
    }
}
