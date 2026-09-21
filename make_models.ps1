$models = @(
    "Customer",
    "CustomerAddress",
    "Lead",
    "LeadActivity",
    "Category",
    "Brand",
    "Product",
    "ProductImage",
    "ProductSpecification",
    "Warehouse",
    "Stock",
    "StockMovement",
    "Supplier",
    "PurchaseOrder",
    "PurchaseItem",
    "Quotation",
    "QuotationItem",
    "Order",
    "OrderItem",
    "Invoice",
    "InvoiceItem",
    "Payment",
    "Expense",
    "Project",
    "ProjectTask",
    "SiteSurvey",
    "Installation",
    "TechnicianAssignment",
    "MaintenanceTicket",
    "MaintenanceTask",
    "Warranty",
    "SolarSystem",
    "SolarComponent",
    "SolarReading",
    "AuditLog",
    "Setting"
)

foreach ($model in $models) {
    php artisan make:model $model -m
    Start-Sleep -Seconds 1
}
