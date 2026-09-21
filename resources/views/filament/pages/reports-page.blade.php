<x-filament-panels::page>
    <div class="space-y-6" dir="rtl">
        <!-- Tab Header -->
        <div class="flex border-b border-gray-200 dark:border-gray-700 gap-4 mb-6">
            <button wire:click="$set('activeTab', 'financial')" class="py-2 px-4 font-semibold border-b-2 {{ $activeTab === 'financial' ? 'border-amber-500 text-amber-600' : 'border-transparent text-gray-500' }}">
                التقرير المالي (الفواتير والمدفوعات)
            </button>
            <button wire:click="$set('activeTab', 'sales')" class="py-2 px-4 font-semibold border-b-2 {{ $activeTab === 'sales' ? 'border-amber-500 text-amber-600' : 'border-transparent text-gray-500' }}">
                تقرير المبيعات والطلبات
            </button>
            <button wire:click="$set('activeTab', 'inventory')" class="py-2 px-4 font-semibold border-b-2 {{ $activeTab === 'inventory' ? 'border-amber-500 text-amber-600' : 'border-transparent text-gray-500' }}">
                تقرير المخزون والمنتجات
            </button>
        </div>

        @if($activeTab === 'financial')
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow border border-gray-100 dark:border-gray-700">
                        <div class="text-sm text-gray-500">إجمالي الفواتير الصادرة</div>
                        <div class="text-2xl font-bold text-amber-600 mt-1">{{ number_format($this->financialData['total_invoiced'], 2) }} ر.س</div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow border border-gray-100 dark:border-gray-700">
                        <div class="text-sm text-gray-500">التحصيلات الفعلية</div>
                        <div class="text-2xl font-bold text-emerald-600 mt-1">{{ number_format($this->financialData['total_paid'], 2) }} ر.س</div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow border border-gray-100 dark:border-gray-700">
                        <div class="text-sm text-gray-500">إجمالي المصروفات</div>
                        <div class="text-2xl font-bold text-rose-600 mt-1">{{ number_format($this->financialData['total_expenses'], 2) }} ر.س</div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow border border-gray-100 dark:border-gray-700">
                        <div class="text-sm text-gray-500">صافي التدفق المالي</div>
                        <div class="text-2xl font-bold text-blue-600 mt-1">{{ number_format($this->financialData['net_profit'], 2) }} ر.س</div>
                    </div>
                </div>

                <div class="flex justify-between items-center bg-gray-50 dark:bg-gray-800/50 p-4 rounded-lg">
                    <h3 class="font-bold text-lg">أحدث الفواتير المسجلة</h3>
                    <div class="flex gap-2">
                        <x-filament::button wire:click="exportCsv('financial')" color="warning" icon="heroicon-o-document-arrow-down">
                            تصدير CSV / Excel
                        </x-filament::button>
                        <x-filament::button onclick="window.print()" color="gray" icon="heroicon-o-printer">
                            طباعة PDF
                        </x-filament::button>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden">
                    <table class="w-full text-right text-sm">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                            <tr>
                                <th class="p-3">رقم الفاتورة</th>
                                <th class="p-3">العميل</th>
                                <th class="p-3">تاريخ الإصدار</th>
                                <th class="p-3">المبلغ الإجمالي</th>
                                <th class="p-3">المدفوع</th>
                                <th class="p-3">الحالة</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @foreach($this->financialData['invoices'] as $inv)
                                <tr>
                                    <td class="p-3 font-semibold">{{ $inv->invoice_number }}</td>
                                    <td class="p-3">{{ $inv->customer->name ?? '-' }}</td>
                                    <td class="p-3">{{ $inv->issue_date ? $inv->issue_date->format('Y-m-d') : '-' }}</td>
                                    <td class="p-3 font-semibold text-amber-600">{{ number_format($inv->total, 2) }} ر.س</td>
                                    <td class="p-3 text-emerald-600">{{ number_format($inv->paid, 2) }} ر.س</td>
                                    <td class="p-3"><span class="px-2 py-1 bg-amber-100 text-amber-800 rounded-full text-xs font-semibold">{{ $inv->status }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @elseif($activeTab === 'sales')
            <div class="space-y-6">
                <div class="flex justify-between items-center bg-gray-50 dark:bg-gray-800/50 p-4 rounded-lg">
                    <h3 class="font-bold text-lg">أحدث الطلبات المنفذة</h3>
                    <div class="flex gap-2">
                        <x-filament::button wire:click="exportCsv('sales')" color="warning" icon="heroicon-o-document-arrow-down">
                            تصدير CSV / Excel
                        </x-filament::button>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden">
                    <table class="w-full text-right text-sm">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                            <tr>
                                <th class="p-3">رقم الطلب</th>
                                <th class="p-3">العميل</th>
                                <th class="p-3">الحالة</th>
                                <th class="p-3">الإجمالي</th>
                                <th class="p-3">التاريخ</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @foreach($this->salesData['orders'] as $ord)
                                <tr>
                                    <td class="p-3 font-semibold">{{ $ord->order_number }}</td>
                                    <td class="p-3">{{ $ord->customer->name ?? '-' }}</td>
                                    <td class="p-3"><span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold">{{ $ord->status }}</span></td>
                                    <td class="p-3 font-semibold text-emerald-600">{{ number_format($ord->total, 2) }} ر.س</td>
                                    <td class="p-3">{{ $ord->created_at->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @elseif($activeTab === 'inventory')
            <div class="space-y-6">
                <div class="flex justify-between items-center bg-gray-50 dark:bg-gray-800/50 p-4 rounded-lg">
                    <h3 class="font-bold text-lg">تقرير جرد المخزون في المستودعات</h3>
                    <div class="flex gap-2">
                        <x-filament::button wire:click="exportCsv('inventory')" color="warning" icon="heroicon-o-document-arrow-down">
                            تصدير CSV / Excel
                        </x-filament::button>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden">
                    <table class="w-full text-right text-sm">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                            <tr>
                                <th class="p-3">اسم المنتج</th>
                                <th class="p-3">SKU</th>
                                <th class="p-3">المستودع</th>
                                <th class="p-3">الكمية الحالية</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @foreach($this->inventoryData['stocks'] as $stk)
                                <tr>
                                    <td class="p-3 font-semibold">{{ $stk->product->name ?? '-' }}</td>
                                    <td class="p-3">{{ $stk->product->sku ?? '-' }}</td>
                                    <td class="p-3">{{ $stk->warehouse->name ?? '-' }}</td>
                                    <td class="p-3 font-bold {{ $stk->quantity < 10 ? 'text-rose-600' : 'text-emerald-600' }}">{{ $stk->quantity }} قطعة</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</x-filament-panels::page>
