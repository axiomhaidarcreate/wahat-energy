<?php

namespace App\Filament\Widgets;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\MaintenanceTicket;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Project;
use App\Models\Quotation;
use App\Models\Stock;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalSales = Order::sum('total');
        $revenue = Payment::sum('amount');
        $customersCount = Customer::count();
        $ordersCount = Order::count();
        $pendingQuotations = Quotation::whereIn('status', ['draft', 'sent'])->count();
        $activeProjects = Project::whereNotIn('status', ['completed'])->count();
        $openTickets = MaintenanceTicket::whereIn('status', ['open', 'assigned', 'on_the_way', 'in_progress'])->count();
        $lowStockCount = Stock::where('quantity', '<', 10)->count();
        
        $outstandingPayments = Invoice::whereIn('status', ['unpaid', 'partial'])
            ->get()
            ->sum(fn ($inv) => $inv->total - $inv->paid);

        return [
            Stat::make('إجمالي المبيعات', number_format($totalSales, 2) . ' ر.س')
                ->description('إجمالي قيمة الطلبات')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('success'),

            Stat::make('الإيرادات المحصلة', number_format($revenue, 2) . ' ر.س')
                ->description('المدفوعات المستلمة فعلياً')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('emerald'),

            Stat::make('عدد العملاء', $customersCount)
                ->description('إجمالي المسجلين')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info'),

            Stat::make('إجمالي الطلبات', $ordersCount)
                ->description('طلبات المبيعات المنفذة')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color('primary'),

            Stat::make('عروض الأسعار المعلقة', $pendingQuotations)
                ->description('في انتظار اعتماد العميل')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('amber'),

            Stat::make('المشاريع النشطة', $activeProjects)
                ->description('قيد التخطيط أو التركيب')
                ->descriptionIcon('heroicon-m-briefcase')
                ->color('warning'),

            Stat::make('تذاكر الصيانة المفتوحة', $openTickets)
                ->description('تتطلب التدخل والتكليف')
                ->descriptionIcon('heroicon-m-wrench')
                ->color('rose'),

            Stat::make('منتجات منخفضة المخزون', $lowStockCount)
                ->description('الكمية أقل من 10 وحدات')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('danger'),

            Stat::make('المبالغ المستحقة غير المدفوعة', number_format($outstandingPayments, 2) . ' ر.س')
                ->description('الفواتير غير المسددة')
                ->descriptionIcon('heroicon-m-clock')
                ->color('orange'),
        ];
    }
}
