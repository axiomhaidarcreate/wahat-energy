<?php

$resourcesDir = __DIR__ . '/app/Filament/Resources';
if (!is_dir($resourcesDir)) {
    mkdir($resourcesDir, 0755, true);
}

// Map resources and their properties
$resources = [
    'UserResource' => [
        'model' => 'User',
        'group' => 'إدارة النظام والأمان',
        'label' => 'مستخدم',
        'plural' => 'المستخدمين',
        'icon' => 'heroicon-o-users',
        'form' => <<<PHP
            Forms\Components\TextInput::make('name')->label('الاسم')->required(),
            Forms\Components\TextInput::make('email')->label('البريد الإلكتروني')->email()->required()->unique(ignoreRecord: true),
            Forms\Components\TextInput::make('password')->label('كلمة المرور')->password()->dehydrated(fn (\$state) => filled(\$state))->required(fn (string \$context): bool => \$context === 'create'),
            Forms\Components\Select::make('roles')->label('الأدوار')->relationship('roles', 'name')->multiple()->preload(),
PHP,
        'table' => <<<PHP
            Tables\Columns\TextColumn::make('name')->label('الاسم')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('email')->label('البريد الإلكتروني')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('roles.name')->label('الأدوار')->badge()->color('amber'),
            Tables\Columns\TextColumn::make('created_at')->label('تاريخ الإنشاء')->dateTime('Y-m-d H:i')->sortable(),
PHP,
    ],

    'RoleResource' => [
        'model' => 'Spatie\Permission\Models\Role',
        'group' => 'إدارة النظام والأمان',
        'label' => 'دور',
        'plural' => 'الأدوار والصلاحيات',
        'icon' => 'heroicon-o-shield-check',
        'form' => <<<PHP
            Forms\Components\TextInput::make('name')->label('اسم الدور')->required()->unique(ignoreRecord: true),
            Forms\Components\Select::make('permissions')->label('الصلاحيات')->relationship('permissions', 'name')->multiple()->preload(),
PHP,
        'table' => <<<PHP
            Tables\Columns\TextColumn::make('name')->label('اسم الدور')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('permissions_count')->label('عدد الصلاحيات')->counts('permissions'),
            Tables\Columns\TextColumn::make('created_at')->label('تاريخ الإنشاء')->dateTime('Y-m-d'),
PHP,
    ],

    'PermissionResource' => [
        'model' => 'Spatie\Permission\Models\Permission',
        'group' => 'إدارة النظام والأمان',
        'label' => 'صلاحية',
        'plural' => 'قائمة الصلاحيات',
        'icon' => 'heroicon-o-key',
        'form' => <<<PHP
            Forms\Components\TextInput::make('name')->label('اسم الصلاحية')->required()->unique(ignoreRecord: true),
PHP,
        'table' => <<<PHP
            Tables\Columns\TextColumn::make('name')->label('اسم الصلاحية')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('created_at')->label('تاريخ الإنشاء')->dateTime('Y-m-d'),
PHP,
    ],

    'CustomerResource' => [
        'model' => 'Customer',
        'group' => 'المبيعات والعملاء',
        'label' => 'عميل',
        'plural' => 'العملاء',
        'icon' => 'heroicon-o-user-group',
        'form' => <<<PHP
            Forms\Components\TextInput::make('name')->label('اسم العميل')->required(),
            Forms\Components\TextInput::make('email')->label('البريد الإلكتروني')->email(),
            Forms\Components\TextInput::make('phone')->label('رقم الهاتف')->tel(),
            Forms\Components\TextInput::make('company_name')->label('اسم الشركة'),
            Forms\Components\TextInput::make('tax_number')->label('الرقم الضريبي'),
            Forms\Components\Select::make('type')->label('نوع العميل')->options([
                'individual' => 'فردي',
                'corporate' => 'شركات',
            ])->default('individual')->required(),
PHP,
        'table' => <<<PHP
            Tables\Columns\TextColumn::make('name')->label('اسم العميل')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('company_name')->label('الشركة')->searchable(),
            Tables\Columns\TextColumn::make('phone')->label('الهاتف')->searchable(),
            Tables\Columns\TextColumn::make('email')->label('البريد')->searchable(),
            Tables\Columns\BadgeColumn::make('type')->label('النوع')->formatStateUsing(fn (\$state) => \$state === 'corporate' ? 'شركة' : 'فرد'),
            Tables\Columns\TextColumn::make('created_at')->label('تاريخ التسجيل')->date('Y-m-d'),
PHP,
    ],

    'LeadResource' => [
        'model' => 'Lead',
        'group' => 'المبيعات والعملاء',
        'label' => 'عميل محتمل',
        'plural' => 'المبيعات المحتملة (Leads)',
        'icon' => 'heroicon-o-funnel',
        'form' => <<<PHP
            Forms\Components\Select::make('customer_id')->label('العميل المرتبط')->relationship('customer', 'name')->searchable(),
            Forms\Components\TextInput::make('title')->label('عنوان الفرصة')->required(),
            Forms\Components\Textarea::make('description')->label('التفاصيل'),
            Forms\Components\Select::make('status')->label('الحالة')->options([
                'new' => 'جديد',
                'contacted' => 'تم التواصل',
                'qualified' => 'مؤهل',
                'lost' => 'مفقود',
                'converted' => 'تم التحويل',
            ])->default('new')->required(),
            Forms\Components\Select::make('assigned_to')->label('المسؤول')->relationship('assignedTo', 'name')->searchable(),
PHP,
        'table' => <<<PHP
            Tables\Columns\TextColumn::make('title')->label('العنوان')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('customer.name')->label('العميل')->searchable(),
            Tables\Columns\BadgeColumn::make('status')->label('الحالة')->colors([
                'info' => 'new',
                'warning' => 'contacted',
                'success' => 'converted',
                'danger' => 'lost',
            ]),
            Tables\Columns\TextColumn::make('assignedTo.name')->label('المسؤول'),
            Tables\Columns\TextColumn::make('created_at')->label('التاريخ')->date('Y-m-d'),
PHP,
    ],

    'ProductResource' => [
        'model' => 'Product',
        'group' => 'المستودعات والمنتجات',
        'label' => 'منتج',
        'plural' => 'المنتجات',
        'icon' => 'heroicon-o-cube',
        'form' => <<<PHP
            Forms\Components\TextInput::make('name')->label('اسم المنتج')->required(),
            Forms\Components\TextInput::make('slug')->label('الرابط المباشر (Slug)')->required(),
            Forms\Components\TextInput::make('sku')->label('رمز المنتج (SKU)')->required()->unique(ignoreRecord: true),
            Forms\Components\Select::make('category_id')->label('القسم')->relationship('category', 'name')->required()->searchable(),
            Forms\Components\Select::make('brand_id')->label('العلامة التجارية')->relationship('brand', 'name')->searchable(),
            Forms\Components\TextInput::make('price')->label('سعر البيع')->numeric()->prefix('SAR')->required(),
            Forms\Components\TextInput::make('cost')->label('التكلفة')->numeric()->prefix('SAR'),
            Forms\Components\Toggle::make('is_active')->label('نشط')->default(true),
            Forms\Components\Textarea::make('description')->label('الوصف')->columnSpanFull(),
PHP,
        'table' => <<<PHP
            Tables\Columns\TextColumn::make('name')->label('اسم المنتج')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('sku')->label('SKU')->searchable(),
            Tables\Columns\TextColumn::make('category.name')->label('القسم')->sortable(),
            Tables\Columns\TextColumn::make('brand.name')->label('العلامة التجارية'),
            Tables\Columns\TextColumn::make('price')->label('سعر البيع')->money('SAR')->sortable(),
            Tables\Columns\IconColumn::make('is_active')->label('نشط')->boolean(),
PHP,
    ],

    'CategoryResource' => [
        'model' => 'Category',
        'group' => 'المستودعات والمنتجات',
        'label' => 'قسم',
        'plural' => 'أقسام المنتجات',
        'icon' => 'heroicon-o-tag',
        'form' => <<<PHP
            Forms\Components\TextInput::make('name')->label('اسم القسم')->required(),
            Forms\Components\TextInput::make('slug')->label('Slug')->required(),
            Forms\Components\Select::make('parent_id')->label('القسم الرئيسي')->relationship('parent', 'name'),
            Forms\Components\Toggle::make('is_active')->label('مفعل')->default(true),
PHP,
        'table' => <<<PHP
            Tables\Columns\TextColumn::make('name')->label('الاسم')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('parent.name')->label('القسم الرئيسي'),
            Tables\Columns\IconColumn::make('is_active')->label('نشط')->boolean(),
PHP,
    ],

    'BrandResource' => [
        'model' => 'Brand',
        'group' => 'المستودعات والمنتجات',
        'label' => 'علامة تجارية',
        'plural' => 'العلامات التجارية',
        'icon' => 'heroicon-o-sparkles',
        'form' => <<<PHP
            Forms\Components\TextInput::make('name')->label('اسم العلامة')->required(),
            Forms\Components\TextInput::make('slug')->label('Slug')->required(),
            Forms\Components\FileUpload::make('logo')->label('الشعار')->image()->directory('brands'),
            Forms\Components\Toggle::make('is_active')->label('نشط')->default(true),
PHP,
        'table' => <<<PHP
            Tables\Columns\ImageColumn::make('logo')->label('الشعار'),
            Tables\Columns\TextColumn::make('name')->label('اسم العلامة')->searchable()->sortable(),
            Tables\Columns\IconColumn::make('is_active')->label('نشط')->boolean(),
PHP,
    ],

    'WarehouseResource' => [
        'model' => 'Warehouse',
        'group' => 'المستودعات والمنتجات',
        'label' => 'مستودع',
        'plural' => 'المستودعات',
        'icon' => 'heroicon-o-building-storefront',
        'form' => <<<PHP
            Forms\Components\TextInput::make('name')->label('اسم المستودع')->required(),
            Forms\Components\TextInput::make('location')->label('الموقع / المدينة'),
            Forms\Components\Toggle::make('is_active')->label('نشط')->default(true),
PHP,
        'table' => <<<PHP
            Tables\Columns\TextColumn::make('name')->label('اسم المستودع')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('location')->label('الموقع'),
            Tables\Columns\IconColumn::make('is_active')->label('نشط')->boolean(),
PHP,
    ],

    'StockResource' => [
        'model' => 'Stock',
        'group' => 'المستودعات والمنتجات',
        'label' => 'مخزون',
        'plural' => 'جرد المخزون',
        'icon' => 'heroicon-o-archive-box',
        'form' => <<<PHP
            Forms\Components\Select::make('product_id')->label('المنتج')->relationship('product', 'name')->required()->searchable(),
            Forms\Components\Select::make('warehouse_id')->label('المستودع')->relationship('warehouse', 'name')->required(),
            Forms\Components\TextInput::make('quantity')->label('الكمية المتاحة')->numeric()->required()->default(0),
PHP,
        'table' => <<<PHP
            Tables\Columns\TextColumn::make('product.name')->label('المنتج')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('product.sku')->label('SKU')->searchable(),
            Tables\Columns\TextColumn::make('warehouse.name')->label('المستودع')->sortable(),
            Tables\Columns\TextColumn::make('quantity')->label('الكمية الحالية')->sortable()->badge()->color(fn (\$state) => \$state < 10 ? 'danger' : 'success'),
PHP,
    ],

    'StockMovementResource' => [
        'model' => 'StockMovement',
        'group' => 'المستودعات والمنتجات',
        'label' => 'حركة مخزون',
        'plural' => 'حركات المخزون',
        'icon' => 'heroicon-o-arrows-right-left',
        'form' => <<<PHP
            Forms\Components\Select::make('product_id')->label('المنتج')->relationship('product', 'name')->required(),
            Forms\Components\Select::make('warehouse_id')->label('المستودع')->relationship('warehouse', 'name')->required(),
            Forms\Components\Select::make('type')->label('نوع الحركة')->options([
                'purchase' => 'شراء (إدخال)',
                'sale' => 'بيع (إخراج)',
                'installation' => 'تركيب مشروع',
                'return' => 'إرجاع',
                'adjustment' => 'تسوية مخزنية',
                'damage' => 'تالف',
            ])->required(),
            Forms\Components\TextInput::make('quantity')->label('الكمية')->numeric()->required(),
            Forms\Components\Select::make('user_id')->label('بواسطة')->relationship('user', 'name')->required(),
PHP,
        'table' => <<<PHP
            Tables\Columns\TextColumn::make('created_at')->label('التاريخ')->dateTime('Y-m-d H:i')->sortable(),
            Tables\Columns\TextColumn::make('product.name')->label('المنتج')->searchable(),
            Tables\Columns\TextColumn::make('warehouse.name')->label('المستودع'),
            Tables\Columns\BadgeColumn::make('type')->label('نوع الحركة'),
            Tables\Columns\TextColumn::make('quantity')->label('الكمية')->sortable(),
            Tables\Columns\TextColumn::make('user.name')->label('المستخدم'),
PHP,
    ],

    'SupplierResource' => [
        'model' => 'Supplier',
        'group' => 'المشتريات والموردين',
        'label' => 'مورد',
        'plural' => 'الموردين',
        'icon' => 'heroicon-o-truck',
        'form' => <<<PHP
            Forms\Components\TextInput::make('name')->label('اسم المورد')->required(),
            Forms\Components\TextInput::make('contact_person')->label('الشخص المسؤول'),
            Forms\Components\TextInput::make('email')->label('البريد الإلكتروني')->email(),
            Forms\Components\TextInput::make('phone')->label('الهاتف'),
            Forms\Components\Textarea::make('address')->label('العنوان'),
PHP,
        'table' => <<<PHP
            Tables\Columns\TextColumn::make('name')->label('اسم المورد')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('contact_person')->label('المسؤول')->searchable(),
            Tables\Columns\TextColumn::make('phone')->label('الهاتف'),
            Tables\Columns\TextColumn::make('email')->label('البريد'),
PHP,
    ],

    'PurchaseOrderResource' => [
        'model' => 'PurchaseOrder',
        'group' => 'المشتريات والموردين',
        'label' => 'أمر شراء',
        'plural' => 'أوامر الشراء',
        'icon' => 'heroicon-o-shopping-cart',
        'form' => <<<PHP
            Forms\Components\TextInput::make('po_number')->label('رقم أمر الشراء')->required()->unique(ignoreRecord: true),
            Forms\Components\Select::make('supplier_id')->label('المورد')->relationship('supplier', 'name')->required(),
            Forms\Components\Select::make('status')->label('الحالة')->options([
                'draft' => 'مسودة',
                'ordered' => 'تم الطلب',
                'received' => 'تم الاستلام',
                'cancelled' => 'ملغى',
            ])->default('draft')->required(),
            Forms\Components\TextInput::make('total_amount')->label('المبلغ الإجمالي')->numeric()->prefix('SAR'),
            Forms\Components\DatePicker::make('expected_delivery_date')->label('تاريخ التسليم المتوقع'),
PHP,
        'table' => <<<PHP
            Tables\Columns\TextColumn::make('po_number')->label('رقم الطلب')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('supplier.name')->label('المورد')->searchable(),
            Tables\Columns\BadgeColumn::make('status')->label('الحالة')->colors([
                'gray' => 'draft',
                'warning' => 'ordered',
                'success' => 'received',
                'danger' => 'cancelled',
            ]),
            Tables\Columns\TextColumn::make('total_amount')->label('الإجمالي')->money('SAR')->sortable(),
            Tables\Columns\TextColumn::make('expected_delivery_date')->label('تاريخ التسليم المتوقع')->date('Y-m-d'),
PHP,
    ],

    'QuotationResource' => [
        'model' => 'Quotation',
        'group' => 'المبيعات والعملاء',
        'label' => 'عرض سعر',
        'plural' => 'عروض الأسعار',
        'icon' => 'heroicon-o-document-text',
        'form' => <<<PHP
            Forms\Components\TextInput::make('quotation_number')->label('رقم عرض السعر')->required()->unique(ignoreRecord: true),
            Forms\Components\Select::make('customer_id')->label('العميل')->relationship('customer', 'name')->required()->searchable(),
            Forms\Components\Select::make('user_id')->label('معد العرض')->relationship('user', 'name'),
            Forms\Components\Select::make('status')->label('الحالة')->options([
                'draft' => 'مسودة',
                'sent' => 'تم الإرسال',
                'approved' => 'موافق عليه',
                'rejected' => 'مرفوض',
                'converted' => 'محول إلى طلب',
            ])->default('draft')->required(),
            Forms\Components\TextInput::make('subtotal')->label('المجموع الفرعي')->numeric()->prefix('SAR'),
            Forms\Components\TextInput::make('discount')->label('الخصم')->numeric()->prefix('SAR')->default(0),
            Forms\Components\TextInput::make('tax')->label('الضريبة (15%)')->numeric()->prefix('SAR')->default(0),
            Forms\Components\TextInput::make('installation_fee')->label('رسوم التركيب')->numeric()->prefix('SAR')->default(0),
            Forms\Components\TextInput::make('transport_fee')->label('رسوم النقل')->numeric()->prefix('SAR')->default(0),
            Forms\Components\TextInput::make('total')->label('الإجمالي النهائي')->numeric()->prefix('SAR')->required(),
            Forms\Components\DatePicker::make('valid_until')->label('صالح حتى'),
PHP,
        'table' => <<<PHP
            Tables\Columns\TextColumn::make('quotation_number')->label('رقم العرض')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('customer.name')->label('العميل')->searchable(),
            Tables\Columns\BadgeColumn::make('status')->label('الحالة')->colors([
                'gray' => 'draft',
                'info' => 'sent',
                'success' => 'approved',
                'danger' => 'rejected',
                'amber' => 'converted',
            ]),
            Tables\Columns\TextColumn::make('total')->label('الإجمالي')->money('SAR')->sortable(),
            Tables\Columns\TextColumn::make('valid_until')->label('صالح حتى')->date('Y-m-d'),
PHP,
    ],

    'OrderResource' => [
        'model' => 'Order',
        'group' => 'المبيعات والعملاء',
        'label' => 'طلب مبيعات',
        'plural' => 'طلبات المبيعات',
        'icon' => 'heroicon-o-shopping-bag',
        'form' => <<<PHP
            Forms\Components\TextInput::make('order_number')->label('رقم الطلب')->required()->unique(ignoreRecord: true),
            Forms\Components\Select::make('customer_id')->label('العميل')->relationship('customer', 'name')->required()->searchable(),
            Forms\Components\Select::make('quotation_id')->label('عرض السعر المرتبط')->relationship('quotation', 'quotation_number')->searchable(),
            Forms\Components\Select::make('status')->label('الحالة')->options([
                'pending' => 'قيد الانتظار',
                'processing' => 'قيد التجهيز',
                'completed' => 'مكتمل',
                'cancelled' => 'ملغى',
            ])->default('pending')->required(),
            Forms\Components\TextInput::make('total')->label('المبلغ الإجمالي')->numeric()->prefix('SAR')->required(),
PHP,
        'table' => <<<PHP
            Tables\Columns\TextColumn::make('order_number')->label('رقم الطلب')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('customer.name')->label('العميل')->searchable(),
            Tables\Columns\BadgeColumn::make('status')->label('الحالة')->colors([
                'warning' => 'pending',
                'info' => 'processing',
                'success' => 'completed',
                'danger' => 'cancelled',
            ]),
            Tables\Columns\TextColumn::make('total')->label('الإجمالي')->money('SAR')->sortable(),
            Tables\Columns\TextColumn::make('created_at')->label('التاريخ')->dateTime('Y-m-d H:i'),
PHP,
    ],

    'InvoiceResource' => [
        'model' => 'Invoice',
        'group' => 'المالية والحسابات',
        'label' => 'فاتورة',
        'plural' => 'الفواتير',
        'icon' => 'heroicon-o-receipt-percent',
        'form' => <<<PHP
            Forms\Components\TextInput::make('invoice_number')->label('رقم الفاتورة')->required()->unique(ignoreRecord: true),
            Forms\Components\Select::make('customer_id')->label('العميل')->relationship('customer', 'name')->required()->searchable(),
            Forms\Components\Select::make('order_id')->label('الطلب المرتبط')->relationship('order', 'order_number')->searchable(),
            Forms\Components\DatePicker::make('issue_date')->label('تاريخ الإصدار')->required()->default(now()),
            Forms\Components\DatePicker::make('due_date')->label('تاريخ الاستحقاق'),
            Forms\Components\TextInput::make('total')->label('إجمالي الفاتورة')->numeric()->prefix('SAR')->required(),
            Forms\Components\TextInput::make('paid')->label('المبلغ المدفوع')->numeric()->prefix('SAR')->default(0),
            Forms\Components\Select::make('status')->label('حالة الفاتورة')->options([
                'unpaid' => 'غير مدفوعة',
                'partial' => 'مدفوعة جزئياً',
                'paid' => 'مدفوعة بالكامل',
                'cancelled' => 'ملغاة',
            ])->default('unpaid')->required(),
PHP,
        'table' => <<<PHP
            Tables\Columns\TextColumn::make('invoice_number')->label('رقم الفاتورة')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('customer.name')->label('العميل')->searchable(),
            Tables\Columns\BadgeColumn::make('status')->label('الحالة')->colors([
                'danger' => 'unpaid',
                'warning' => 'partial',
                'success' => 'paid',
                'gray' => 'cancelled',
            ]),
            Tables\Columns\TextColumn::make('total')->label('الإجمالي')->money('SAR')->sortable(),
            Tables\Columns\TextColumn::make('paid')->label('المدفوع')->money('SAR'),
            Tables\Columns\TextColumn::make('issue_date')->label('تاريخ الإصدار')->date('Y-m-d'),
PHP,
    ],

    'PaymentResource' => [
        'model' => 'Payment',
        'group' => 'المالية والحسابات',
        'label' => 'دفعة مالية',
        'plural' => 'سندات القبض والمدفوعات',
        'icon' => 'heroicon-o-banknotes',
        'form' => <<<PHP
            Forms\Components\TextInput::make('transaction_id')->label('رقم المعاملة / التحويل'),
            Forms\Components\Select::make('invoice_id')->label('الفاتورة')->relationship('invoice', 'invoice_number')->required()->searchable(),
            Forms\Components\Select::make('customer_id')->label('العميل')->relationship('customer', 'name')->required()->searchable(),
            Forms\Components\TextInput::make('amount')->label('المبلغ المدفوع')->numeric()->prefix('SAR')->required(),
            Forms\Components\Select::make('payment_method')->label('طريقة الدفع')->options([
                'cash' => 'نقداً (Cash)',
                'bank_transfer' => 'تحويل بنكي',
                'credit_card' => 'بطاقة ائتمان',
                'cheque' => 'شيك بنكي',
            ])->required(),
            Forms\Components\DatePicker::make('payment_date')->label('تاريخ الدفع')->required()->default(now()),
PHP,
        'table' => <<<PHP
            Tables\Columns\TextColumn::make('transaction_id')->label('رقم المعاملة')->searchable(),
            Tables\Columns\TextColumn::make('customer.name')->label('العميل')->searchable(),
            Tables\Columns\TextColumn::make('invoice.invoice_number')->label('رقم الفاتورة'),
            Tables\Columns\TextColumn::make('amount')->label('المبلغ')->money('SAR')->sortable(),
            Tables\Columns\BadgeColumn::make('payment_method')->label('الطريقة'),
            Tables\Columns\TextColumn::make('payment_date')->label('التاريخ')->date('Y-m-d')->sortable(),
PHP,
    ],

    'ExpenseResource' => [
        'model' => 'Expense',
        'group' => 'المالية والحسابات',
        'label' => 'مصروف',
        'plural' => 'المصروفات',
        'icon' => 'heroicon-o-currency-dollar',
        'form' => <<<PHP
            Forms\Components\TextInput::make('reference')->label('الرقم المرجعي / السند'),
            Forms\Components\TextInput::make('category')->label('فئة المصروف')->required(),
            Forms\Components\TextInput::make('amount')->label('المبلغ')->numeric()->prefix('SAR')->required(),
            Forms\Components\DatePicker::make('expense_date')->label('تاريخ المصروف')->required()->default(now()),
            Forms\Components\Textarea::make('description')->label('التفاصيل'),
PHP,
        'table' => <<<PHP
            Tables\Columns\TextColumn::make('reference')->label('المرجع')->searchable(),
            Tables\Columns\TextColumn::make('category')->label('الفئة')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('amount')->label('المبلغ')->money('SAR')->sortable(),
            Tables\Columns\TextColumn::make('expense_date')->label('التاريخ')->date('Y-m-d')->sortable(),
PHP,
    ],

    'ProjectResource' => [
        'model' => 'Project',
        'group' => 'المشاريع والصيانة',
        'label' => 'مشروع',
        'plural' => 'المشاريع الهندسية',
        'icon' => 'heroicon-o-briefcase',
        'form' => <<<PHP
            Forms\Components\TextInput::make('project_code')->label('كود المشروع')->required()->unique(ignoreRecord: true),
            Forms\Components\TextInput::make('name')->label('اسم المشروع')->required(),
            Forms\Components\Select::make('customer_id')->label('العميل')->relationship('customer', 'name')->required()->searchable(),
            Forms\Components\Select::make('order_id')->label('طلب المبيعات المرتبط')->relationship('order', 'order_number')->searchable(),
            Forms\Components\Select::make('status')->label('مرحلة المشروع')->options([
                'site_survey' => 'معاينة الموقع',
                'design' => 'التصميم والتخطيط',
                'procurement' => 'تجهيز المواد',
                'installation' => 'التركيب والربط',
                'testing' => 'الفحص والاختبار',
                'commissioning' => 'التشغيل والتسليم',
                'completed' => 'مكتمل بنجاح',
            ])->default('site_survey')->required(),
            Forms\Components\DatePicker::make('start_date')->label('تاريخ البدء'),
            Forms\Components\DatePicker::make('end_date')->label('تاريخ الانتهاء'),
PHP,
        'table' => <<<PHP
            Tables\Columns\TextColumn::make('project_code')->label('كود المشروع')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('name')->label('اسم المشروع')->searchable(),
            Tables\Columns\TextColumn::make('customer.name')->label('العميل')->searchable(),
            Tables\Columns\BadgeColumn::make('status')->label('المرحلة')->colors([
                'gray' => 'site_survey',
                'info' => 'design',
                'warning' => 'installation',
                'success' => 'completed',
            ]),
            Tables\Columns\TextColumn::make('start_date')->label('البدء')->date('Y-m-d'),
PHP,
    ],

    'SiteSurveyResource' => [
        'model' => 'SiteSurvey',
        'group' => 'المشاريع والصيانة',
        'label' => 'معاينة موقع',
        'plural' => 'معاينات المواقع',
        'icon' => 'heroicon-o-clipboard-document-check',
        'form' => <<<PHP
            Forms\Components\Select::make('project_id')->label('المشروع')->relationship('project', 'name')->required()->searchable(),
            Forms\Components\Select::make('engineer_id')->label('المهندس المعاين')->relationship('engineer', 'name')->required(),
            Forms\Components\DatePicker::make('survey_date')->label('تاريخ المعاينة')->default(now()),
            Forms\Components\Textarea::make('notes')->label('ملاحظات وقراءات المعاينة'),
            Forms\Components\FileUpload::make('document_path')->label('تقرير المعاينة (PDF/Image)')->directory('surveys'),
PHP,
        'table' => <<<PHP
            Tables\Columns\TextColumn::make('project.name')->label('المشروع')->searchable(),
            Tables\Columns\TextColumn::make('engineer.name')->label('المهندس المعاين'),
            Tables\Columns\TextColumn::make('survey_date')->label('تاريخ المعاينة')->date('Y-m-d'),
PHP,
    ],

    'InstallationResource' => [
        'model' => 'Installation',
        'group' => 'المشاريع والصيانة',
        'label' => 'عملية تركيب',
        'plural' => 'جدولة التركيبات',
        'icon' => 'heroicon-o-wrench-screwdriver',
        'form' => <<<PHP
            Forms\Components\Select::make('project_id')->label('المشروع')->relationship('project', 'name')->required(),
            Forms\Components\DatePicker::make('scheduled_date')->label('التاريخ المحدد للتركيب'),
            Forms\Components\Select::make('status')->label('الحالة')->options([
                'pending' => 'قيد الانتظار',
                'in_progress' => 'جاري التركيب',
                'completed' => 'تم التركيب',
            ])->default('pending')->required(),
            Forms\Components\Select::make('technicians')->label('الفنيين المكلفين')->relationship('technicians', 'name')->multiple()->preload(),
            Forms\Components\Textarea::make('notes')->label('ملاحظات التركيب'),
PHP,
        'table' => <<<PHP
            Tables\Columns\TextColumn::make('project.name')->label('المشروع')->searchable(),
            Tables\Columns\TextColumn::make('scheduled_date')->label('التاريخ')->date('Y-m-d')->sortable(),
            Tables\Columns\BadgeColumn::make('status')->label('الحالة')->colors([
                'warning' => 'pending',
                'info' => 'in_progress',
                'success' => 'completed',
            ]),
PHP,
    ],

    'TechnicianAssignmentResource' => [
        'model' => 'TechnicianAssignment',
        'group' => 'المشاريع والصيانة',
        'label' => 'تكليف فني',
        'plural' => 'تكليفات الفنيين',
        'icon' => 'heroicon-o-identification',
        'form' => <<<PHP
            Forms\Components\Select::make('installation_id')->label('مهمة التركيب')->relationship('installation', 'id')->required(),
            Forms\Components\Select::make('technician_id')->label('الفني')->relationship('technician', 'name')->required(),
PHP,
        'table' => <<<PHP
            Tables\Columns\TextColumn::make('installation.project.name')->label('المشروع'),
            Tables\Columns\TextColumn::make('technician.name')->label('اسم الفني')->searchable(),
            Tables\Columns\TextColumn::make('created_at')->label('تاريخ التكليف')->dateTime('Y-m-d H:i'),
PHP,
    ],

    'MaintenanceTicketResource' => [
        'model' => 'MaintenanceTicket',
        'group' => 'المشاريع والصيانة',
        'label' => 'تذكرة صيانة',
        'plural' => 'تذاكر الصيانة',
        'icon' => 'heroicon-o-wrench',
        'form' => <<<PHP
            Forms\Components\TextInput::make('ticket_number')->label('رقم التذكرة')->required()->unique(ignoreRecord: true),
            Forms\Components\Select::make('customer_id')->label('العميل')->relationship('customer', 'name')->required()->searchable(),
            Forms\Components\Select::make('solar_system_id')->label('النظام الشمس المرتبط')->relationship('solarSystem', 'name')->searchable(),
            Forms\Components\TextInput::make('subject')->label('موضوع البلاغ / المشكلة')->required(),
            Forms\Components\Textarea::make('description')->label('تفاصيل العطل')->required(),
            Forms\Components\Select::make('status')->label('حالة التذكرة')->options([
                'open' => 'مفتوحة',
                'assigned' => 'تم تعيين فني',
                'on_the_way' => 'الفني في الطريق',
                'in_progress' => 'قيد الإصلاح',
                'resolved' => 'تم حل المشكلة',
                'closed' => 'مغلقة',
            ])->default('open')->required(),
            Forms\Components\Select::make('technician_id')->label('الفني المسؤول')->relationship('technician', 'name')->searchable(),
PHP,
        'table' => <<<PHP
            Tables\Columns\TextColumn::make('ticket_number')->label('رقم التذكرة')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('customer.name')->label('العميل')->searchable(),
            Tables\Columns\TextColumn::make('subject')->label('الموضوع')->searchable(),
            Tables\Columns\BadgeColumn::make('status')->label('الحالة')->colors([
                'danger' => 'open',
                'warning' => 'assigned',
                'info' => 'in_progress',
                'success' => 'resolved',
                'gray' => 'closed',
            ]),
            Tables\Columns\TextColumn::make('technician.name')->label('الفني'),
PHP,
    ],

    'WarrantyResource' => [
        'model' => 'Warranty',
        'group' => 'المشاريع والصيانة',
        'label' => 'شهادة ضمان',
        'plural' => 'شهادات الضمان',
        'icon' => 'heroicon-o-academic-cap',
        'form' => <<<PHP
            Forms\Components\TextInput::make('warranty_code')->label('رقم شهادة الضمان')->required()->unique(ignoreRecord: true),
            Forms\Components\Select::make('customer_id')->label('العميل')->relationship('customer', 'name')->required()->searchable(),
            Forms\Components\Select::make('project_id')->label('المشروع')->relationship('project', 'name')->searchable(),
            Forms\Components\Select::make('product_id')->label('المنتج المشمول')->relationship('product', 'name')->searchable(),
            Forms\Components\DatePicker::make('start_date')->label('تاريخ بداية الضمان')->required(),
            Forms\Components\DatePicker::make('end_date')->label('تاريخ نهاية الضمان')->required(),
            Forms\Components\Select::make('status')->label('حالة الضمان')->options([
                'active' => 'ساري',
                'expired' => 'منتهي',
                'voided' => 'ملغى',
            ])->default('active')->required(),
PHP,
        'table' => <<<PHP
            Tables\Columns\TextColumn::make('warranty_code')->label('كود الضمان')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('customer.name')->label('العميل')->searchable(),
            Tables\Columns\TextColumn::make('product.name')->label('المنتج'),
            Tables\Columns\TextColumn::make('start_date')->label('البداية')->date('Y-m-d'),
            Tables\Columns\TextColumn::make('end_date')->label('النهاية')->date('Y-m-d'),
            Tables\Columns\BadgeColumn::make('status')->label('الحالة')->colors([
                'success' => 'active',
                'danger' => 'expired',
                'gray' => 'voided',
            ]),
PHP,
    ],

    'SolarSystemResource' => [
        'model' => 'SolarSystem',
        'group' => 'الأنظمة والتقارير',
        'label' => 'نظام طاقة شمسية',
        'plural' => 'الأنظمة الشمسية المنفذة',
        'icon' => 'heroicon-o-sun',
        'form' => <<<PHP
            Forms\Components\TextInput::make('name')->label('اسم المحطة / النظام')->required(),
            Forms\Components\Select::make('customer_id')->label('المالك / العميل')->relationship('customer', 'name')->required()->searchable(),
            Forms\Components\Select::make('project_id')->label('المشروع المنفذ')->relationship('project', 'name')->searchable(),
            Forms\Components\TextInput::make('capacity_kw')->label('قدرة النظام (كيلوواط Peak)')->numeric()->suffix('kW'),
            Forms\Components\DatePicker::make('installation_date')->label('تاريخ التشغيل'),
PHP,
        'table' => <<<PHP
            Tables\Columns\TextColumn::make('name')->label('اسم النظام')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('customer.name')->label('العميل')->searchable(),
            Tables\Columns\TextColumn::make('capacity_kw')->label('السعة (kW)')->sortable(),
            Tables\Columns\TextColumn::make('installation_date')->label('تاريخ التشغيل')->date('Y-m-d'),
PHP,
    ],

    'SettingResource' => [
        'model' => 'Setting',
        'group' => 'إدارة النظام والأمان',
        'label' => 'إعداد',
        'plural' => 'إعدادات النظام',
        'icon' => 'heroicon-o-cog-6-tooth',
        'form' => <<<PHP
            Forms\Components\TextInput::make('key')->label('مفتاح الإعداد')->required()->unique(ignoreRecord: true),
            Forms\Components\TextInput::make('group')->label('المجموعة')->default('general')->required(),
            Forms\Components\Textarea::make('value')->label('القيمة'),
PHP,
        'table' => <<<PHP
            Tables\Columns\TextColumn::make('key')->label('المفتاح')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('group')->label('المجموعة')->sortable(),
            Tables\Columns\TextColumn::make('value')->label('القيمة')->limit(50),
PHP,
    ],

    'AuditLogResource' => [
        'model' => 'AuditLog',
        'group' => 'إدارة النظام والأمان',
        'label' => 'سجل تدقيق',
        'plural' => 'سجلات التدقيق والأمان',
        'icon' => 'heroicon-o-document-magnifying-glass',
        'form' => <<<PHP
            Forms\Components\Select::make('user_id')->label('المستخدم')->relationship('user', 'name'),
            Forms\Components\TextInput::make('action')->label('الحدث / الإجراء'),
            Forms\Components\TextInput::make('model_type')->label('نوع الكائن'),
            Forms\Components\TextInput::make('ip_address')->label('عنوان IP'),
PHP,
        'table' => <<<PHP
            Tables\Columns\TextColumn::make('created_at')->label('التاريخ والوقت')->dateTime('Y-m-d H:i:s')->sortable(),
            Tables\Columns\TextColumn::make('user.name')->label('المستخدم')->searchable(),
            Tables\Columns\BadgeColumn::make('action')->label('الإجراء')->color('amber'),
            Tables\Columns\TextColumn::make('model_type')->label('الكائن'),
            Tables\Columns\TextColumn::make('ip_address')->label('IP Address'),
PHP,
    ],
];

foreach ($resources as $resClass => $cfg) {
    $code = <<<PHP
<?php

namespace App\Filament\Resources;

use App\Filament\Resources\\{$resClass}\Pages;
use App\Models\\{$cfg['model']};
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class {$resClass} extends Resource
{
    protected static ?string \$model = \\App\\Models\\{$cfg['model']}::class;

    protected static string | \BackedEnum | null \$navigationIcon = '{$cfg['icon']}';

    protected static \UnitEnum|string|null \$navigationGroup = '{$cfg['group']}';

    protected static ?string \$modelLabel = '{$cfg['label']}';

    protected static ?string \$pluralModelLabel = '{$cfg['plural']}';

    public static function form(Schema \$schema): Schema
    {
        return \$schema->schema([
{$cfg['form']}
        ]);
    }

    public static function table(Table \$table): Table
    {
        return \$table
            ->columns([
{$cfg['table']}
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\List{$resClass}::route('/'),
            'create' => Pages\Create{$resClass}::route('/create'),
            'edit' => Pages\Edit{$resClass}::route('/{record}/edit'),
        ];
    }
}
PHP;

    file_put_contents("{$resourcesDir}/{$resClass}.php", $code);

    // Create directory for pages
    $pagesDir = "{$resourcesDir}/{$resClass}/Pages";
    if (!is_dir($pagesDir)) {
        mkdir($pagesDir, 0755, true);
    }

    // List Page
    file_put_contents("{$pagesDir}/List{$resClass}.php", <<<PHP
<?php

namespace App\Filament\Resources\\{$resClass}\Pages;

use App\Filament\Resources\\{$resClass};
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class List{$resClass} extends ListRecords
{
    protected static string \$resource = {$resClass}::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
PHP
    );

    // Create Page
    file_put_contents("{$pagesDir}/Create{$resClass}.php", <<<PHP
<?php

namespace App\Filament\Resources\\{$resClass}\Pages;

use App\Filament\Resources\\{$resClass};
use Filament\Resources\Pages\CreateRecord;

class Create{$resClass} extends CreateRecord
{
    protected static string \$resource = {$resClass}::class;
}
PHP
    );

    // Edit Page
    file_put_contents("{$pagesDir}/Edit{$resClass}.php", <<<PHP
<?php

namespace App\Filament\Resources\\{$resClass}\Pages;

use App\Filament\Resources\\{$resClass};
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class Edit{$resClass} extends EditRecord
{
    protected static string \$resource = {$resClass}::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
PHP
    );

    echo "Generated {$resClass}\n";
}

echo "All 24 Filament Resources generated successfully!\n";
