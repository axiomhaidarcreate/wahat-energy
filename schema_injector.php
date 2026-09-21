<?php

$schemas = [
    "Customer" => [
        "\$table->string('name');",
        "\$table->string('email')->nullable()->unique();",
        "\$table->string('phone')->nullable();",
        "\$table->string('company_name')->nullable();",
        "\$table->string('tax_number')->nullable();",
        "\$table->enum('type', ['individual', 'corporate'])->default('individual');",
        "\$table->softDeletes();"
    ],
    "CustomerAddress" => [
        "\$table->foreignId('customer_id')->constrained()->cascadeOnDelete();",
        "\$table->string('address_line_1');",
        "\$table->string('address_line_2')->nullable();",
        "\$table->string('city');",
        "\$table->string('state')->nullable();",
        "\$table->string('zip_code')->nullable();",
        "\$table->boolean('is_primary')->default(false);"
    ],
    "Lead" => [
        "\$table->foreignId('customer_id')->nullable()->constrained()->nullOnDelete();",
        "\$table->string('title');",
        "\$table->text('description')->nullable();",
        "\$table->enum('status', ['new', 'contacted', 'qualified', 'lost', 'converted'])->default('new');",
        "\$table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();",
        "\$table->softDeletes();"
    ],
    "LeadActivity" => [
        "\$table->foreignId('lead_id')->constrained()->cascadeOnDelete();",
        "\$table->foreignId('user_id')->constrained()->cascadeOnDelete();",
        "\$table->string('type');",
        "\$table->text('notes')->nullable();"
    ],
    "Category" => [
        "\$table->string('name');",
        "\$table->string('slug')->unique();",
        "\$table->foreignId('parent_id')->nullable()->constrained('categories')->nullOnDelete();",
        "\$table->boolean('is_active')->default(true);"
    ],
    "Brand" => [
        "\$table->string('name');",
        "\$table->string('slug')->unique();",
        "\$table->string('logo')->nullable();",
        "\$table->boolean('is_active')->default(true);"
    ],
    "Product" => [
        "\$table->string('name');",
        "\$table->string('slug')->unique();",
        "\$table->string('sku')->unique();",
        "\$table->text('description')->nullable();",
        "\$table->foreignId('category_id')->constrained()->restrictOnDelete();",
        "\$table->foreignId('brand_id')->nullable()->constrained()->nullOnDelete();",
        "\$table->decimal('price', 10, 2);",
        "\$table->decimal('cost', 10, 2)->nullable();",
        "\$table->boolean('is_active')->default(true);",
        "\$table->softDeletes();"
    ],
    "ProductImage" => [
        "\$table->foreignId('product_id')->constrained()->cascadeOnDelete();",
        "\$table->string('image_path');",
        "\$table->boolean('is_primary')->default(false);"
    ],
    "ProductSpecification" => [
        "\$table->foreignId('product_id')->constrained()->cascadeOnDelete();",
        "\$table->string('key');",
        "\$table->string('value');"
    ],
    "Warehouse" => [
        "\$table->string('name');",
        "\$table->string('location')->nullable();",
        "\$table->boolean('is_active')->default(true);"
    ],
    "Stock" => [
        "\$table->foreignId('product_id')->constrained()->restrictOnDelete();",
        "\$table->foreignId('warehouse_id')->constrained()->restrictOnDelete();",
        "\$table->integer('quantity')->default(0);",
        "\$table->unique(['product_id', 'warehouse_id']);"
    ],
    "StockMovement" => [
        "\$table->foreignId('product_id')->constrained()->cascadeOnDelete();",
        "\$table->foreignId('warehouse_id')->constrained()->cascadeOnDelete();",
        "\$table->enum('type', ['purchase', 'sale', 'installation', 'return', 'adjustment', 'damage']);",
        "\$table->integer('quantity');",
        "\$table->string('reference_type')->nullable();",
        "\$table->unsignedBigInteger('reference_id')->nullable();",
        "\$table->foreignId('user_id')->constrained()->restrictOnDelete();"
    ],
    "Supplier" => [
        "\$table->string('name');",
        "\$table->string('contact_person')->nullable();",
        "\$table->string('email')->nullable();",
        "\$table->string('phone')->nullable();",
        "\$table->text('address')->nullable();"
    ],
    "PurchaseOrder" => [
        "\$table->string('po_number')->unique();",
        "\$table->foreignId('supplier_id')->constrained()->restrictOnDelete();",
        "\$table->enum('status', ['draft', 'ordered', 'received', 'cancelled'])->default('draft');",
        "\$table->decimal('total_amount', 12, 2)->default(0);",
        "\$table->date('expected_delivery_date')->nullable();",
        "\$table->softDeletes();"
    ],
    "PurchaseItem" => [
        "\$table->foreignId('purchase_order_id')->constrained()->cascadeOnDelete();",
        "\$table->foreignId('product_id')->constrained()->restrictOnDelete();",
        "\$table->integer('quantity');",
        "\$table->decimal('unit_price', 10, 2);",
        "\$table->decimal('total', 12, 2);"
    ],
    "Quotation" => [
        "\$table->string('quotation_number')->unique();",
        "\$table->foreignId('customer_id')->constrained()->restrictOnDelete();",
        "\$table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();",
        "\$table->enum('status', ['draft', 'sent', 'approved', 'rejected', 'converted'])->default('draft');",
        "\$table->decimal('subtotal', 12, 2)->default(0);",
        "\$table->decimal('discount', 12, 2)->default(0);",
        "\$table->decimal('tax', 12, 2)->default(0);",
        "\$table->decimal('installation_fee', 10, 2)->default(0);",
        "\$table->decimal('transport_fee', 10, 2)->default(0);",
        "\$table->decimal('total', 12, 2)->default(0);",
        "\$table->date('valid_until')->nullable();",
        "\$table->softDeletes();"
    ],
    "QuotationItem" => [
        "\$table->foreignId('quotation_id')->constrained()->cascadeOnDelete();",
        "\$table->foreignId('product_id')->constrained()->restrictOnDelete();",
        "\$table->integer('quantity');",
        "\$table->decimal('unit_price', 10, 2);",
        "\$table->decimal('total', 12, 2);"
    ],
    "Order" => [
        "\$table->string('order_number')->unique();",
        "\$table->foreignId('customer_id')->constrained()->restrictOnDelete();",
        "\$table->foreignId('quotation_id')->nullable()->constrained()->nullOnDelete();",
        "\$table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])->default('pending');",
        "\$table->decimal('total', 12, 2)->default(0);",
        "\$table->softDeletes();"
    ],
    "OrderItem" => [
        "\$table->foreignId('order_id')->constrained()->cascadeOnDelete();",
        "\$table->foreignId('product_id')->constrained()->restrictOnDelete();",
        "\$table->integer('quantity');",
        "\$table->decimal('unit_price', 10, 2);",
        "\$table->decimal('total', 12, 2);"
    ],
    "Invoice" => [
        "\$table->string('invoice_number')->unique();",
        "\$table->foreignId('order_id')->nullable()->constrained()->nullOnDelete();",
        "\$table->foreignId('customer_id')->constrained()->restrictOnDelete();",
        "\$table->date('issue_date');",
        "\$table->date('due_date')->nullable();",
        "\$table->decimal('total', 12, 2)->default(0);",
        "\$table->decimal('paid', 12, 2)->default(0);",
        "\$table->enum('status', ['unpaid', 'partial', 'paid', 'cancelled'])->default('unpaid');",
        "\$table->softDeletes();"
    ],
    "InvoiceItem" => [
        "\$table->foreignId('invoice_id')->constrained()->cascadeOnDelete();",
        "\$table->string('description');",
        "\$table->integer('quantity');",
        "\$table->decimal('unit_price', 10, 2);",
        "\$table->decimal('total', 12, 2);"
    ],
    "Payment" => [
        "\$table->string('transaction_id')->nullable();",
        "\$table->foreignId('invoice_id')->constrained()->cascadeOnDelete();",
        "\$table->foreignId('customer_id')->constrained()->restrictOnDelete();",
        "\$table->decimal('amount', 12, 2);",
        "\$table->enum('payment_method', ['cash', 'bank_transfer', 'credit_card', 'cheque']);",
        "\$table->date('payment_date');"
    ],
    "Expense" => [
        "\$table->string('reference')->nullable();",
        "\$table->string('category');",
        "\$table->decimal('amount', 10, 2);",
        "\$table->date('expense_date');",
        "\$table->text('description')->nullable();"
    ],
    "Project" => [
        "\$table->string('project_code')->unique();",
        "\$table->string('name');",
        "\$table->foreignId('customer_id')->constrained()->restrictOnDelete();",
        "\$table->foreignId('order_id')->nullable()->constrained()->nullOnDelete();",
        "\$table->enum('status', ['site_survey', 'design', 'procurement', 'installation', 'testing', 'commissioning', 'completed'])->default('site_survey');",
        "\$table->date('start_date')->nullable();",
        "\$table->date('end_date')->nullable();",
        "\$table->softDeletes();"
    ],
    "ProjectTask" => [
        "\$table->foreignId('project_id')->constrained()->cascadeOnDelete();",
        "\$table->string('name');",
        "\$table->text('description')->nullable();",
        "\$table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');",
        "\$table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();"
    ],
    "SiteSurvey" => [
        "\$table->foreignId('project_id')->constrained()->cascadeOnDelete();",
        "\$table->date('survey_date')->nullable();",
        "\$table->foreignId('engineer_id')->nullable()->constrained('users')->nullOnDelete();",
        "\$table->text('notes')->nullable();",
        "\$table->string('document_path')->nullable();"
    ],
    "Installation" => [
        "\$table->foreignId('project_id')->constrained()->cascadeOnDelete();",
        "\$table->date('scheduled_date')->nullable();",
        "\$table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');",
        "\$table->text('notes')->nullable();"
    ],
    "TechnicianAssignment" => [
        "\$table->foreignId('installation_id')->constrained()->cascadeOnDelete();",
        "\$table->foreignId('technician_id')->constrained('users')->cascadeOnDelete();"
    ],
    "MaintenanceTicket" => [
        "\$table->string('ticket_number')->unique();",
        "\$table->foreignId('customer_id')->constrained()->restrictOnDelete();",
        "\$table->foreignId('solar_system_id')->nullable();",
        "\$table->string('subject');",
        "\$table->text('description');",
        "\$table->enum('status', ['open', 'assigned', 'on_the_way', 'in_progress', 'resolved', 'closed'])->default('open');",
        "\$table->foreignId('technician_id')->nullable()->constrained('users')->nullOnDelete();",
        "\$table->softDeletes();"
    ],
    "MaintenanceTask" => [
        "\$table->foreignId('maintenance_ticket_id')->constrained()->cascadeOnDelete();",
        "\$table->string('description');",
        "\$table->boolean('is_completed')->default(false);"
    ],
    "Warranty" => [
        "\$table->string('warranty_code')->unique();",
        "\$table->foreignId('customer_id')->constrained()->restrictOnDelete();",
        "\$table->foreignId('project_id')->nullable()->constrained()->nullOnDelete();",
        "\$table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();",
        "\$table->date('start_date');",
        "\$table->date('end_date');",
        "\$table->enum('status', ['active', 'expired', 'voided'])->default('active');"
    ],
    "SolarSystem" => [
        "\$table->foreignId('customer_id')->constrained()->restrictOnDelete();",
        "\$table->foreignId('project_id')->nullable()->constrained()->nullOnDelete();",
        "\$table->string('name');",
        "\$table->decimal('capacity_kw', 8, 2)->nullable();",
        "\$table->date('installation_date')->nullable();"
    ],
    "SolarComponent" => [
        "\$table->foreignId('solar_system_id')->constrained()->cascadeOnDelete();",
        "\$table->foreignId('product_id')->constrained()->restrictOnDelete();",
        "\$table->string('serial_number')->nullable();"
    ],
    "SolarReading" => [
        "\$table->foreignId('solar_system_id')->constrained()->cascadeOnDelete();",
        "\$table->dateTime('reading_time');",
        "\$table->decimal('energy_produced_kwh', 10, 2);",
        "\$table->decimal('current_power_w', 10, 2)->nullable();"
    ],
    "AuditLog" => [
        "\$table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();",
        "\$table->string('action');",
        "\$table->string('model_type')->nullable();",
        "\$table->unsignedBigInteger('model_id')->nullable();",
        "\$table->json('old_values')->nullable();",
        "\$table->json('new_values')->nullable();",
        "\$table->string('ip_address')->nullable();"
    ],
    "Setting" => [
        "\$table->string('key')->unique();",
        "\$table->text('value')->nullable();",
        "\$table->string('group')->default('general');"
    ]
];

require __DIR__.'/vendor/autoload.php';
use Illuminate\Support\Str;

$files = scandir(__DIR__.'/database/migrations');

foreach ($schemas as $model => $fields) {
    $tableName = Str::snake(Str::pluralStudly($model));
    if ($model == 'Category') { $tableName = 'categories'; }
    if ($model == 'Inventory') { $tableName = 'inventory'; }
    if ($model == 'CustomerAddress') { $tableName = 'customer_addresses'; }

    $migrationFile = null;
    foreach ($files as $file) {
        if (str_ends_with($file, 'create_'.$tableName.'_table.php')) {
            $migrationFile = $file;
            break;
        }
    }

    if ($migrationFile) {
        $path = __DIR__.'/database/migrations/'.$migrationFile;
        $content = file_get_contents($path);
        
        $replacement = "\$table->id();\n            " . implode("\n            ", $fields);
        $content = preg_replace('/\$table->id\(\);\s*/', $replacement."\n", $content);
        
        file_put_contents($path, $content);
        echo "Updated $migrationFile\n";
    } else {
        echo "Migration for $model ($tableName) not found!\n";
    }
}
?>
