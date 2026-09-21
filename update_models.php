<?php

$models = [
    'Customer' => <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'email', 'phone', 'company_name', 'tax_number', 'type'
    ];

    public function addresses() { return $this->hasMany(CustomerAddress::class); }
    public function leads() { return $this->hasMany(Lead::class); }
    public function quotations() { return $this->hasMany(Quotation::class); }
    public function orders() { return $this->hasMany(Order::class); }
    public function invoices() { return $this->hasMany(Invoice::class); }
    public function payments() { return $this->hasMany(Payment::class); }
    public function projects() { return $this->hasMany(Project::class); }
    public function maintenanceTickets() { return $this->hasMany(MaintenanceTicket::class); }
    public function warranties() { return $this->hasMany(Warranty::class); }
    public function solarSystems() { return $this->hasMany(SolarSystem::class); }
}
PHP,

    'CustomerAddress' => <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    protected $fillable = [
        'customer_id', 'address_line_1', 'address_line_2', 'city', 'state', 'zip_code', 'is_primary'
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    public function customer() { return $this->belongsTo(Customer::class); }
}
PHP,

    'Lead' => <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'customer_id', 'title', 'description', 'status', 'assigned_to'
    ];

    public function customer() { return $this->belongsTo(Customer::class); }
    public function assignedTo() { return $this->belongsTo(User::class, 'assigned_to'); }
    public function activities() { return $this->hasMany(LeadActivity::class); }
}
PHP,

    'LeadActivity' => <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadActivity extends Model
{
    protected $fillable = [
        'lead_id', 'user_id', 'type', 'notes'
    ];

    public function lead() { return $this->belongsTo(Lead::class); }
    public function user() { return $this->belongsTo(User::class); }
}
PHP,

    'Category' => <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'slug', 'parent_id', 'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function parent() { return $this->belongsTo(Category::class, 'parent_id'); }
    public function children() { return $this->hasMany(Category::class, 'parent_id'); }
    public function products() { return $this->hasMany(Product::class); }
}
PHP,

    'Brand' => <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name', 'slug', 'logo', 'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function products() { return $this->hasMany(Product::class); }
}
PHP,

    'Product' => <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'sku', 'description', 'category_id', 'brand_id', 'price', 'cost', 'is_active'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'cost' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function category() { return $this->belongsTo(Category::class); }
    public function brand() { return $this->belongsTo(Brand::class); }
    public function images() { return $this->hasMany(ProductImage::class); }
    public function specifications() { return $this->hasMany(ProductSpecification::class); }
    public function stocks() { return $this->hasMany(Stock::class); }
    public function stockMovements() { return $this->hasMany(StockMovement::class); }
    
    public function getTotalStockAttribute()
    {
        return $this->stocks()->sum('quantity');
    }
}
PHP,

    'ProductImage' => <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = [
        'product_id', 'image_path', 'is_primary'
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    public function product() { return $this->belongsTo(Product::class); }
}
PHP,

    'ProductSpecification' => <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSpecification extends Model
{
    protected $fillable = [
        'product_id', 'key', 'value'
    ];

    public function product() { return $this->belongsTo(Product::class); }
}
PHP,

    'Warehouse' => <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $fillable = [
        'name', 'location', 'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function stocks() { return $this->hasMany(Stock::class); }
    public function stockMovements() { return $this->hasMany(StockMovement::class); }
}
PHP,

    'Stock' => <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'product_id', 'warehouse_id', 'quantity'
    ];

    public function product() { return $this->belongsTo(Product::class); }
    public function warehouse() { return $this->belongsTo(Warehouse::class); }
}
PHP,

    'StockMovement' => <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    protected $fillable = [
        'product_id', 'warehouse_id', 'type', 'quantity', 'reference_type', 'reference_id', 'user_id'
    ];

    public function product() { return $this->belongsTo(Product::class); }
    public function warehouse() { return $this->belongsTo(Warehouse::class); }
    public function user() { return $this->belongsTo(User::class); }
}
PHP,

    'Supplier' => <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name', 'contact_person', 'email', 'phone', 'address'
    ];

    public function purchaseOrders() { return $this->hasMany(PurchaseOrder::class); }
}
PHP,

    'PurchaseOrder' => <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrder extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'po_number', 'supplier_id', 'status', 'total_amount', 'expected_delivery_date'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'expected_delivery_date' => 'date',
    ];

    public function supplier() { return $this->belongsTo(Supplier::class); }
    public function items() { return $this->hasMany(PurchaseItem::class); }
}
PHP,

    'PurchaseItem' => <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    protected $fillable = [
        'purchase_order_id', 'product_id', 'quantity', 'unit_price', 'total'
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function purchaseOrder() { return $this->belongsTo(PurchaseOrder::class); }
    public function product() { return $this->belongsTo(Product::class); }
}
PHP,

    'Quotation' => <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quotation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quotation_number', 'customer_id', 'user_id', 'status', 'subtotal',
        'discount', 'tax', 'installation_fee', 'transport_fee', 'total', 'valid_until'
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'discount' => 'decimal:2',
        'tax' => 'decimal:2',
        'installation_fee' => 'decimal:2',
        'transport_fee' => 'decimal:2',
        'total' => 'decimal:2',
        'valid_until' => 'date',
    ];

    public function customer() { return $this->belongsTo(Customer::class); }
    public function user() { return $this->belongsTo(User::class); }
    public function items() { return $this->hasMany(QuotationItem::class); }
    public function orders() { return $this->hasMany(Order::class); }
}
PHP,

    'QuotationItem' => <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuotationItem extends Model
{
    protected $fillable = [
        'quotation_id', 'product_id', 'quantity', 'unit_price', 'total'
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function quotation() { return $this->belongsTo(Quotation::class); }
    public function product() { return $this->belongsTo(Product::class); }
}
PHP,

    'Order' => <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'order_number', 'customer_id', 'quotation_id', 'status', 'total'
    ];

    protected $casts = [
        'total' => 'decimal:2',
    ];

    public function customer() { return $this->belongsTo(Customer::class); }
    public function quotation() { return $this->belongsTo(Quotation::class); }
    public function items() { return $this->hasMany(OrderItem::class); }
    public function invoices() { return $this->hasMany(Invoice::class); }
    public function projects() { return $this->hasMany(Project::class); }
}
PHP,

    'OrderItem' => <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id', 'product_id', 'quantity', 'unit_price', 'total'
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function order() { return $this->belongsTo(Order::class); }
    public function product() { return $this->belongsTo(Product::class); }
}
PHP,

    'Invoice' => <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'invoice_number', 'order_id', 'customer_id', 'issue_date', 'due_date', 'total', 'paid', 'status'
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'paid' => 'decimal:2',
        'issue_date' => 'date',
        'due_date' => 'date',
    ];

    public function order() { return $this->belongsTo(Order::class); }
    public function customer() { return $this->belongsTo(Customer::class); }
    public function items() { return $this->hasMany(InvoiceItem::class); }
    public function payments() { return $this->hasMany(Payment::class); }

    public function getRemainingAmountAttribute()
    {
        return $this->total - $this->paid;
    }
}
PHP,

    'InvoiceItem' => <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $fillable = [
        'invoice_id', 'description', 'quantity', 'unit_price', 'total'
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function invoice() { return $this->belongsTo(Invoice::class); }
}
PHP,

    'Payment' => <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'transaction_id', 'invoice_id', 'customer_id', 'amount', 'payment_method', 'payment_date'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'date',
    ];

    public function invoice() { return $this->belongsTo(Invoice::class); }
    public function customer() { return $this->belongsTo(Customer::class); }
}
PHP,

    'Expense' => <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'reference', 'category', 'amount', 'expense_date', 'description'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'expense_date' => 'date',
    ];
}
PHP,

    'Project' => <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'project_code', 'name', 'customer_id', 'order_id', 'status', 'start_date', 'end_date'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function customer() { return $this->belongsTo(Customer::class); }
    public function order() { return $this->belongsTo(Order::class); }
    public function tasks() { return $this->hasMany(ProjectTask::class); }
    public function siteSurveys() { return $this->hasMany(SiteSurvey::class); }
    public function installations() { return $this->hasMany(Installation::class); }
    public function warranties() { return $this->hasMany(Warranty::class); }
    public function solarSystems() { return $this->hasMany(SolarSystem::class); }
}
PHP,

    'ProjectTask' => <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectTask extends Model
{
    protected $fillable = [
        'project_id', 'name', 'description', 'status', 'assigned_to'
    ];

    public function project() { return $this->belongsTo(Project::class); }
    public function assignedTo() { return $this->belongsTo(User::class, 'assigned_to'); }
}
PHP,

    'SiteSurvey' => <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSurvey extends Model
{
    protected $fillable = [
        'project_id', 'survey_date', 'engineer_id', 'notes', 'document_path'
    ];

    protected $casts = [
        'survey_date' => 'date',
    ];

    public function project() { return $this->belongsTo(Project::class); }
    public function engineer() { return $this->belongsTo(User::class, 'engineer_id'); }
}
PHP,

    'Installation' => <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Installation extends Model
{
    protected $fillable = [
        'project_id', 'scheduled_date', 'status', 'notes'
    ];

    protected $casts = [
        'scheduled_date' => 'date',
    ];

    public function project() { return $this->belongsTo(Project::class); }
    public function technicianAssignments() { return $this->hasMany(TechnicianAssignment::class); }
    public function technicians()
    {
        return $this->belongsToMany(User::class, 'technician_assignments', 'installation_id', 'technician_id');
    }
}
PHP,

    'TechnicianAssignment' => <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TechnicianAssignment extends Model
{
    protected $fillable = [
        'installation_id', 'technician_id'
    ];

    public function installation() { return $this->belongsTo(Installation::class); }
    public function technician() { return $this->belongsTo(User::class, 'technician_id'); }
}
PHP,

    'MaintenanceTicket' => <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaintenanceTicket extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'ticket_number', 'customer_id', 'solar_system_id', 'subject', 'description', 'status', 'technician_id'
    ];

    public function customer() { return $this->belongsTo(Customer::class); }
    public function solarSystem() { return $this->belongsTo(SolarSystem::class); }
    public function technician() { return $this->belongsTo(User::class, 'technician_id'); }
    public function tasks() { return $this->hasMany(MaintenanceTask::class); }
}
PHP,

    'MaintenanceTask' => <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceTask extends Model
{
    protected $fillable = [
        'maintenance_ticket_id', 'description', 'is_completed'
    ];

    protected $casts = [
        'is_completed' => 'boolean',
    ];

    public function maintenanceTicket() { return $this->belongsTo(MaintenanceTicket::class); }
}
PHP,

    'Warranty' => <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warranty extends Model
{
    protected $fillable = [
        'warranty_code', 'customer_id', 'project_id', 'product_id', 'start_date', 'end_date', 'status'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function customer() { return $this->belongsTo(Customer::class); }
    public function project() { return $this->belongsTo(Project::class); }
    public function product() { return $this->belongsTo(Product::class); }
}
PHP,

    'SolarSystem' => <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolarSystem extends Model
{
    protected $fillable = [
        'customer_id', 'project_id', 'name', 'capacity_kw', 'installation_date'
    ];

    protected $casts = [
        'capacity_kw' => 'decimal:2',
        'installation_date' => 'date',
    ];

    public function customer() { return $this->belongsTo(Customer::class); }
    public function project() { return $this->belongsTo(Project::class); }
    public function components() { return $this->hasMany(SolarComponent::class); }
    public function readings() { return $this->hasMany(SolarReading::class); }
}
PHP,

    'SolarComponent' => <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolarComponent extends Model
{
    protected $fillable = [
        'solar_system_id', 'product_id', 'serial_number'
    ];

    public function solarSystem() { return $this->belongsTo(SolarSystem::class); }
    public function product() { return $this->belongsTo(Product::class); }
}
PHP,

    'SolarReading' => <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolarReading extends Model
{
    protected $fillable = [
        'solar_system_id', 'reading_time', 'energy_produced_kwh', 'current_power_w'
    ];

    protected $casts = [
        'reading_time' => 'datetime',
        'energy_produced_kwh' => 'decimal:2',
        'current_power_w' => 'decimal:2',
    ];

    public function solarSystem() { return $this->belongsTo(SolarSystem::class); }
}
PHP,

    'AuditLog' => <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $fillable = [
        'user_id', 'action', 'model_type', 'model_id', 'old_values', 'new_values', 'ip_address'
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
    ];

    public function user() { return $this->belongsTo(User::class); }
}
PHP,

    'Setting' => <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'key', 'value', 'group'
    ];
}
PHP
];

foreach ($models as $name => $code) {
    file_put_contents(__DIR__ . "/app/Models/{$name}.php", trim($code));
    echo "Updated {$name}.php\n";
}
echo "All models updated successfully!\n";
