<?php

namespace Database\Seeders;

use App\Models\AuditLog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Expense;
use App\Models\Installation;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Lead;
use App\Models\MaintenanceTicket;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Project;
use App\Models\PurchaseOrder;
use App\Models\Quotation;
use App\Models\Setting;
use App\Models\SiteSurvey;
use App\Models\SolarSystem;
use App\Models\Stock;
use App\Models\StockMovement;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Warehouse;
use App\Models\Warranty;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Roles & Permissions
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $accountantRole = Role::firstOrCreate(['name' => 'Accountant']);
        $warehouseRole = Role::firstOrCreate(['name' => 'Warehouse']);
        $techRole = Role::firstOrCreate(['name' => 'Technician']);
        $salesRole = Role::firstOrCreate(['name' => 'Sales']);

        // 2. Users
        $admin = User::firstOrCreate(['email' => 'admin@wahat-energy.com'], [
            'name' => 'مدير النظام الرئيسي',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole($adminRole);

        $accountant = User::firstOrCreate(['email' => 'accountant@wahat-energy.com'], [
            'name' => 'أحمد المحاسب (قسم المالية)',
            'password' => Hash::make('password'),
        ]);
        $accountant->assignRole($accountantRole);

        $warehouseMgr = User::firstOrCreate(['email' => 'warehouse@wahat-energy.com'], [
            'name' => 'خالد مسؤول المستودعات',
            'password' => Hash::make('password'),
        ]);
        $warehouseMgr->assignRole($warehouseRole);

        $technician = User::firstOrCreate(['email' => 'tech@wahat-energy.com'], [
            'name' => 'عمر مهندس التركيبات والصيانة',
            'password' => Hash::make('password'),
        ]);
        $technician->assignRole($techRole);

        $sales = User::firstOrCreate(['email' => 'sales@wahat-energy.com'], [
            'name' => 'فهد ممثل المبيعات',
            'password' => Hash::make('password'),
        ]);
        $sales->assignRole($salesRole);

        // 3. Categories
        $catPanels = Category::create(['name' => 'ألواح طاقة شمسية', 'slug' => 'solar-panels', 'is_active' => true]);
        $catInverters = Category::create(['name' => 'محولات طاقة (Inverters)', 'slug' => 'inverters', 'is_active' => true]);
        $catBatteries = Category::create(['name' => 'بطاريات ليثيوم', 'slug' => 'lithium-batteries', 'is_active' => true]);
        $catStructures = Category::create(['name' => 'هياكل وقواعد تثبيت', 'slug' => 'mounting-structures', 'is_active' => true]);

        // 4. Brands
        $bJinko = Brand::create(['name' => 'Jinko Solar', 'slug' => 'jinko-solar', 'is_active' => true]);
        $bLongi = Brand::create(['name' => 'Longi Solar', 'slug' => 'longi-solar', 'is_active' => true]);
        $bDeye = Brand::create(['name' => 'Deye Solar', 'slug' => 'deye-solar', 'is_active' => true]);
        $bPylontech = Brand::create(['name' => 'Pylontech', 'slug' => 'pylontech', 'is_active' => true]);
        $bTrina = Brand::create(['name' => 'Trina Solar', 'slug' => 'trina-solar', 'is_active' => true]);

        // 5. Products
        $p1 = Product::create([
            'name' => 'لوح طاقة شمسية Jinko N-Type 575W',
            'slug' => 'jinko-n-type-575w',
            'sku' => 'JK-575N',
            'category_id' => $catPanels->id,
            'brand_id' => $bJinko->id,
            'price' => 420.00,
            'cost' => 310.00,
            'description' => 'لوح شمسي عالي الكفاءة بقدرة 575 واط بتقنية N-Type الكريستالية.',
            'is_active' => true,
        ]);

        $p2 = Product::create([
            'name' => 'لوح طاقة شمسية Longi Hi-MO 6 600W',
            'slug' => 'longi-himo6-600w',
            'sku' => 'LNG-600H',
            'category_id' => $catPanels->id,
            'brand_id' => $bLongi->id,
            'price' => 460.00,
            'cost' => 340.00,
            'description' => 'لوح شمسي قدرة 600 واط مضاد للتآكل والغبار مناسب للمناطق الصحراوية.',
            'is_active' => true,
        ]);

        $p3 = Product::create([
            'name' => 'انفيرتر هايبرد Deye 10kW Three Phase',
            'slug' => 'deye-10kw-hybrid',
            'sku' => 'DEYE-10K-3P',
            'category_id' => $catInverters->id,
            'brand_id' => $bDeye->id,
            'price' => 8500.00,
            'cost' => 6800.00,
            'description' => 'محول هايبرد قدرة 10 كيلوواط ثلاثي الأوجه يعمل على شبكة الكهرباء والبطاريات.',
            'is_active' => true,
        ]);

        $p4 = Product::create([
            'name' => 'بطارية ليثيوم Pylontech US5000 4.8kWh',
            'slug' => 'pylontech-us5000-48kwh',
            'sku' => 'PYLON-US5000',
            'category_id' => $catBatteries->id,
            'brand_id' => $bPylontech->id,
            'price' => 6200.00,
            'cost' => 4900.00,
            'description' => 'بطارية ليثيوم سعة 4.8 كيلوواط ساعة بعمر افتراضي يتجاوز 6000 دورة شحن.',
            'is_active' => true,
        ]);

        $p5 = Product::create([
            'name' => 'هيكل ألومنيوم لـ 10 ألواح شمسية',
            'slug' => 'aluminum-structure-10-panels',
            'sku' => 'STR-AL-10P',
            'category_id' => $catStructures->id,
            'price' => 1200.00,
            'cost' => 800.00,
            'description' => 'هيكل تثبيت ألومنيوم مقاوم للرياح العاتية والصدأ.',
            'is_active' => true,
        ]);

        $p6 = Product::create([
            'name' => 'ألواح ترينا Vertex N 720W',
            'slug' => 'trina-vertex-n-720w',
            'sku' => 'TSM-NEG21C.20',
            'category_id' => $catPanels->id,
            'brand_id' => $bTrina->id,
            'price' => 520.00,
            'cost' => 410.00,
            'description' => '<p><strong>ألواح ترينا Vertex N 720W في السعودية – أعلى كفاءة وحلول موثوقة للمشاريع الكبرى</strong><br>
🔎 يمثل لوح Trina Vertex N 720W – موديل TSM-NEG21C.20 – قمة الابتكار في تقنيات الطاقة الشمسية، إذ يجمع بين كفاءة مذهلة تصل إلى 23.2% وتقنية الخلايا N-type TOPCon ثنائية الوجه. يمنحك إنتاجية طاقة قياسية مع استغلال أمثل للمساحة، ليكون الخيار الأول لمحطات الطاقة الكبيرة والمشاريع الصناعية والتجارية التي تتطلب أداءً وموثوقية لعقود طويلة. 🆓 احصل على استشارة مجانية أو ☎️ تواصل مع واحة إنرجي للطاقة الشمسية الآن!</p>
<br>
<h3 style="color: var(--primary);">🟦 أبرز المميزات والفوائد</h3>
<h4>🚩 نقاط البيع الفريدة</h4>
<ul style="list-style-type: none; padding-left: 0;">
    <li>🔋 تقنية N-type TOPCon ثنائية الوجه تزيد إنتاجية الوجه الخلفي حتى 20%.</li>
    <li>⚡ كفاءة استثنائية: 23.2% بقدرة إنتاجية تصل إلى 720 واط – رقم قياسي للمشاريع الكبرى.</li>
    <li>🪟 تصميم بزجاج مزدوج لتحمل أقسى الظروف المناخية في السعودية: غبار، حرارة، ورطوبة.</li>
    <li>🔥 أداء ممتاز حتى في درجات الحرارة المرتفعة والإشعاع المنخفض – استقرار وكفاءة على مدار العام.</li>
    <li>📉 تدهور سنوي منخفض جدًا: 1% في السنة الأولى، ثم 0.4% فقط سنويًا – عمر تشغيلي طويل.</li>
    <li>🛡️ ضمان منتج 12 سنة وضمان أداء حتى 30 سنة مع دعم فني وخدمة محلية.</li>
    <li>🏅 معتمد من TÜV Rheinland وPVEL للجودة والأداء العالمي.</li>
</ul>
<br>
<h3 style="color: var(--primary);">⚙️ المواصفات الفنية</h3>
<ul style="list-style-type: none; padding-left: 0;">
    <li>🔢 <strong>القدرة الاسمية:</strong> 720 واط</li>
    <li>🎯 <strong>الكفاءة:</strong> 23.2%</li>
    <li>🔌 <strong>الجهد عند أقصى قدرة (Vmp):</strong> 41.3 فولت</li>
    <li>🔋 <strong>التيار عند أقصى قدرة (Imp):</strong> 17.44 أمبير</li>
    <li>⚡ <strong>الجهد في حالة الدائرة المفتوحة (Voc):</strong> 49.4 فولت</li>
    <li>🔌 <strong>التيار القصير (Isc):</strong> 23.2 أمبير</li>
    <li>📏 <strong>الأبعاد:</strong> 2384 × 1303 × 33 ملم</li>
    <li>⚖️ <strong>الوزن:</strong> 38.3 كجم</li>
    <li>🌡️ <strong>NOCT:</strong> 43±2°C</li>
    <li>🔄 <strong>تحمل القدرة:</strong> 0 ~ +5 واط</li>
    <li>🌡️ <strong>درجة حرارة التشغيل:</strong> -40 إلى +85°C</li>
</ul>
<br>
<h4>🧊 معاملات الحرارة:</h4>
<ul style="list-style-type: none; padding-left: 0;">
    <li>📉 <strong>القدرة:</strong> -0.29% /°C</li>
    <li>🔋 <strong>الجهد:</strong> -0.24% /°C</li>
    <li>⚡ <strong>التيار:</strong> +0.04% /°C</li>
</ul>
<br>
<h3 style="color: var(--primary);">💡 مجالات الاستخدام</h3>
<ul style="list-style-type: none; padding-left: 0;">
    <li>🏭 محطات الطاقة الشمسية الكبرى المرتبطة بالشبكة في السعودية.</li>
    <li>🏢 أنظمة الطاقة التجارية والصناعية واسعة النطاق.</li>
    <li>🌱 المبادرات الزراعية والحكومية في الطاقة النظيفة.</li>
    <li>🔥 البيئات القاسية: المناطق الصحراوية، الساحلية، أو ذات الحرارة العالية.</li>
</ul>
<br>
<h3 style="color: var(--primary);">❓ الأسئلة الشائعة</h3>
<ul style="list-style-type: none; padding-left: 0;">
    <li>💰 ما هو سعر لوح Trina Vertex N 720W في السعودية؟</li>
    <li>📍 أين أجد موزعين معتمدين لألواح ترينا في الرياض وجدة والدمام؟</li>
    <li>🛡️ ما هي شروط الضمان وجودة الأداء على المدى الطويل؟</li>
    <li>📐 كيف أختار اللوح المناسب لمشروعي الكبير أو الحكومي؟</li>
    <li>🌄 هل توفرون خدمات التركيب والصيانة في المشاريع الكبرى أو البيئات الصحراوية؟</li>
</ul>',
            'is_active' => true,
        ]);

        // 6. Warehouses
        $wRiyadh = Warehouse::create(['name' => 'المستودع الرئيسي - الرياض', 'location' => 'حي السلي، الرياض', 'is_active' => true]);
        $wJeddah = Warehouse::create(['name' => 'مستودع المنطقة الغربية - جدة', 'location' => 'المنطقة الصناعية، جدة', 'is_active' => true]);

        // 7. Stocks
        Stock::create(['product_id' => $p1->id, 'warehouse_id' => $wRiyadh->id, 'quantity' => 150]);
        Stock::create(['product_id' => $p2->id, 'warehouse_id' => $wRiyadh->id, 'quantity' => 85]);
        Stock::create(['product_id' => $p3->id, 'warehouse_id' => $wRiyadh->id, 'quantity' => 14]);
        Stock::create(['product_id' => $p4->id, 'warehouse_id' => $wRiyadh->id, 'quantity' => 5]); // Low stock alert
        Stock::create(['product_id' => $p5->id, 'warehouse_id' => $wRiyadh->id, 'quantity' => 30]);
        Stock::create(['product_id' => $p6->id, 'warehouse_id' => $wRiyadh->id, 'quantity' => 500]);

        Stock::create(['product_id' => $p1->id, 'warehouse_id' => $wJeddah->id, 'quantity' => 40]);
        Stock::create(['product_id' => $p4->id, 'warehouse_id' => $wJeddah->id, 'quantity' => 3]); // Low stock alert

        // 8. Customers
        $c1 = Customer::create([
            'name' => 'مؤسسة الرواد التجارية',
            'company_name' => 'مؤسسة الرواد للطاقة والتجارة',
            'email' => 'contact@alrowad.com',
            'phone' => '0501234567',
            'tax_number' => '300123456700003',
            'type' => 'corporate',
        ]);

        $c2 = Customer::create([
            'name' => 'المهندس عبدالمجيد السليم',
            'email' => 'abdulmajeed@gmail.com',
            'phone' => '0559876543',
            'type' => 'individual',
        ]);

        $c3 = Customer::create([
            'name' => 'شركة مزارع الخرج الحديثة',
            'company_name' => 'شركة مزارع الخرج للإنتاج الزراعي',
            'email' => 'info@alkharjfarms.sa',
            'phone' => '0114567890',
            'tax_number' => '310987654300003',
            'type' => 'corporate',
        ]);

        // 9. Suppliers
        $sup1 = Supplier::create([
            'name' => 'شركة التوريدات الشمسية العالمية',
            'contact_person' => 'السيد مايكل تشانغ',
            'email' => 'sales@globalsolar-supply.com',
            'phone' => '0112348899',
            'address' => 'دبي، الإمارات العربية المتحدة',
        ]);

        // 10. Purchase Order
        $po1 = PurchaseOrder::create([
            'po_number' => 'PO-2026-001',
            'supplier_id' => $sup1->id,
            'status' => 'received',
            'total_amount' => 145000.00,
            'expected_delivery_date' => now()->subDays(10),
        ]);

        // 11. Quotations & Orders & Invoices & Payments
        $q1 = Quotation::create([
            'quotation_number' => 'QUO-2026-101',
            'customer_id' => $c1->id,
            'user_id' => $sales->id,
            'status' => 'approved',
            'subtotal' => 45000.00,
            'discount' => 2000.00,
            'tax' => 6450.00,
            'installation_fee' => 3500.00,
            'transport_fee' => 1000.00,
            'total' => 53950.00,
            'valid_until' => now()->addDays(15),
        ]);

        $o1 = Order::create([
            'order_number' => 'ORD-2026-501',
            'customer_id' => $c1->id,
            'quotation_id' => $q1->id,
            'status' => 'completed',
            'total' => 53950.00,
        ]);

        $inv1 = Invoice::create([
            'invoice_number' => 'INV-2026-901',
            'order_id' => $o1->id,
            'customer_id' => $c1->id,
            'issue_date' => now()->subDays(20),
            'due_date' => now()->subDays(5),
            'total' => 53950.00,
            'paid' => 53950.00,
            'status' => 'paid',
        ]);

        Payment::create([
            'transaction_id' => 'TRX-99887766',
            'invoice_id' => $inv1->id,
            'customer_id' => $c1->id,
            'amount' => 53950.00,
            'payment_method' => 'bank_transfer',
            'payment_date' => now()->subDays(18),
        ]);

        // Quotation 2 (Pending)
        $q2 = Quotation::create([
            'quotation_number' => 'QUO-2026-102',
            'customer_id' => $c2->id,
            'user_id' => $sales->id,
            'status' => 'sent',
            'subtotal' => 28000.00,
            'discount' => 1000.00,
            'tax' => 4050.00,
            'installation_fee' => 2000.00,
            'transport_fee' => 500.00,
            'total' => 33550.00,
            'valid_until' => now()->addDays(20),
        ]);

        // Unpaid Invoice
        $inv2 = Invoice::create([
            'invoice_number' => 'INV-2026-902',
            'order_id' => null,
            'customer_id' => $c3->id,
            'issue_date' => now()->subDays(5),
            'due_date' => now()->addDays(25),
            'total' => 84000.00,
            'paid' => 20000.00,
            'status' => 'partial',
        ]);

        Payment::create([
            'transaction_id' => 'TRX-11223344',
            'invoice_id' => $inv2->id,
            'customer_id' => $c3->id,
            'amount' => 20000.00,
            'payment_method' => 'bank_transfer',
            'payment_date' => now()->subDays(4),
        ]);

        // 12. Expenses
        Expense::create([
            'reference' => 'EXP-2026-01',
            'category' => 'وقود ومصاريف انتقال الفنيين',
            'amount' => 3400.00,
            'expense_date' => now()->subDays(12),
            'description' => 'تعبئة وقود وصيانة دورية لسيارات التركيبات بالحوادث والخرج.',
        ]);

        Expense::create([
            'reference' => 'EXP-2026-02',
            'category' => 'إيجار المستودع الرئيسي',
            'amount' => 15000.00,
            'expense_date' => now()->subDays(30),
            'description' => 'دفع إيجار المستودع الرئيسي بالرياض عن الشرف الحالي.',
        ]);

        // 13. Projects & Engineering Operations
        $proj1 = Project::create([
            'project_code' => 'PRJ-2026-01',
            'name' => 'مشروع محطة الطاقة الشمسية - فيلا حطين 15kW',
            'customer_id' => $c2->id,
            'order_id' => $o1->id,
            'status' => 'installation',
            'start_date' => now()->subDays(10),
            'end_date' => now()->addDays(5),
        ]);

        $proj2 = Project::create([
            'project_code' => 'PRJ-2026-02',
            'name' => 'مشروع محطة ضخ مياه بالخرج 100kW',
            'customer_id' => $c3->id,
            'order_id' => null,
            'status' => 'design',
            'start_date' => now()->subDays(2),
            'end_date' => now()->addDays(25),
        ]);

        // Site Survey
        SiteSurvey::create([
            'project_id' => $proj1->id,
            'survey_date' => now()->subDays(12),
            'engineer_id' => $technician->id,
            'notes' => 'الموقع ممتاز، مساحة السطح تتسع لـ 26 لوح بميلان 22 درجة جنوباً، لا توجد ظلال.',
        ]);

        // Installation
        $inst1 = Installation::create([
            'project_id' => $proj1->id,
            'scheduled_date' => now()->subDays(3),
            'status' => 'in_progress',
            'notes' => 'تم الانتهاء من تركيب قواعد الألومنيوم وجاري مد الكوابل وتوصيل الانفيرتر.',
        ]);

        // Solar Systems
        $sys1 = SolarSystem::create([
            'customer_id' => $c1->id,
            'project_id' => $proj1->id,
            'name' => 'محطة الطاقة الشمسية - المقر الرئيسي لالرواد',
            'capacity_kw' => 15.00,
            'installation_date' => now()->subDays(30),
        ]);

        // 14. Maintenance Tickets
        MaintenanceTicket::create([
            'ticket_number' => 'TCK-2026-001',
            'customer_id' => $c1->id,
            'solar_system_id' => $sys1->id,
            'subject' => 'إنذار خطأ بالانفيرتر E-04',
            'description' => 'يظهر على شاشة الانفيرتر تنبيه انخفاض جهد الجهد القادم من الألواح أثناء فترة الظهيرة.',
            'status' => 'assigned',
            'technician_id' => $technician->id,
        ]);

        // 15. Warranties
        Warranty::create([
            'warranty_code' => 'WAR-2026-881',
            'customer_id' => $c1->id,
            'project_id' => $proj1->id,
            'product_id' => $p1->id,
            'start_date' => now()->subDays(30),
            'end_date' => now()->addYears(25),
            'status' => 'active',
        ]);

        // 16. Settings
        Setting::create(['key' => 'company_name', 'value' => 'شركة واحة الطاقة للتجهيزات الشمسية', 'group' => 'general']);
        Setting::create(['key' => 'vat_number', 'value' => '300998877600003', 'group' => 'financial']);
        Setting::create(['key' => 'support_phone', 'value' => '920001234', 'group' => 'contact']);

        // 17. Audit Logs
        AuditLog::create([
            'user_id' => $admin->id,
            'action' => 'إعداد وتجهيز لوحة التحكم الجديدة',
            'model_type' => 'System',
            'ip_address' => '127.0.0.1',
        ]);

        echo "Database seeded successfully with real solar company data!\n";
    }
}
