<?php

namespace App\Filament\Pages;

use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Project;
use App\Models\Stock;
use Filament\Pages\Page;
use Illuminate\Support\Carbon;

class ReportsPage extends Page
{
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-chart-bar';

    protected static \UnitEnum|string|null $navigationGroup = 'الأنظمة والتقارير';

    protected static ?string $navigationLabel = 'التقارير الشاملة';

    protected static ?string $title = 'مركز التقارير والتصدير الشامل';

    protected string $view = 'filament.pages.reports-page';

    public $activeTab = 'financial';

    public function getFinancialDataProperty()
    {
        return [
            'total_invoiced' => Invoice::sum('total'),
            'total_paid' => Payment::sum('amount'),
            'total_expenses' => Expense::sum('amount'),
            'net_profit' => Payment::sum('amount') - Expense::sum('amount'),
            'invoices' => Invoice::with('customer')->latest()->take(10)->get(),
            'expenses' => Expense::latest()->take(10)->get(),
        ];
    }

    public function getSalesDataProperty()
    {
        return [
            'total_orders' => Order::count(),
            'completed_orders' => Order::where('status', 'completed')->count(),
            'total_revenue' => Order::sum('total'),
            'orders' => Order::with('customer')->latest()->take(10)->get(),
        ];
    }

    public function getInventoryDataProperty()
    {
        return [
            'total_items' => Stock::sum('quantity'),
            'low_stock_count' => Stock::where('quantity', '<', 10)->count(),
            'stocks' => Stock::with(['product', 'warehouse'])->take(15)->get(),
        ];
    }

    public function exportCsv($type)
    {
        $filename = "report_{$type}_" . date('Y-m-d') . ".csv";

        $headers = [
            "Content-type" => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename={$filename}",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function () use ($type) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF)); // UTF-8 BOM for Arabic

            if ($type === 'financial') {
                fputcsv($file, ['رقم الفاتورة', 'العميل', 'التاريخ', 'الإجمالي', 'المدفوع', 'الحالة']);
                foreach (Invoice::with('customer')->get() as $inv) {
                    fputcsv($file, [$inv->invoice_number, $inv->customer->name ?? '', $inv->issue_date, $inv->total, $inv->paid, $inv->status]);
                }
            } elseif ($type === 'sales') {
                fputcsv($file, ['رقم الطلب', 'العميل', 'الحالة', 'الإجمالي', 'التاريخ']);
                foreach (Order::with('customer')->get() as $ord) {
                    fputcsv($file, [$ord->order_number, $ord->customer->name ?? '', $ord->status, $ord->total, $ord->created_at]);
                }
            } elseif ($type === 'inventory') {
                fputcsv($file, ['المنتج', 'SKU', 'المستودع', 'الكمية الحالية']);
                foreach (Stock::with(['product', 'warehouse'])->get() as $stk) {
                    fputcsv($file, [$stk->product->name ?? '', $stk->product->sku ?? '', $stk->warehouse->name ?? '', $stk->quantity]);
                }
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
