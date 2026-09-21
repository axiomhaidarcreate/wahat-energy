<?php

$policiesDir = __DIR__ . '/app/Policies';
if (!is_dir($policiesDir)) {
    mkdir($policiesDir, 0755, true);
}

$modelsWithRoles = [
    'User' => ['Admin'],
    'Role' => ['Admin'],
    'Permission' => ['Admin'],
    
    'Customer' => ['Admin', 'Sales', 'Accountant'],
    'Lead' => ['Admin', 'Sales'],
    
    'Product' => ['Admin', 'Warehouse', 'Sales'],
    'Category' => ['Admin', 'Warehouse'],
    'Brand' => ['Admin', 'Warehouse'],
    'Warehouse' => ['Admin', 'Warehouse'],
    'Stock' => ['Admin', 'Warehouse'],
    'StockMovement' => ['Admin', 'Warehouse'],
    
    'Supplier' => ['Admin', 'Warehouse', 'Accountant'],
    'PurchaseOrder' => ['Admin', 'Warehouse', 'Accountant'],
    
    'Quotation' => ['Admin', 'Sales', 'Accountant'],
    'Order' => ['Admin', 'Sales', 'Accountant'],
    
    'Invoice' => ['Admin', 'Accountant'],
    'Payment' => ['Admin', 'Accountant'],
    'Expense' => ['Admin', 'Accountant'],
    
    'Project' => ['Admin', 'Technician', 'Sales'],
    'SiteSurvey' => ['Admin', 'Technician', 'Sales'],
    'Installation' => ['Admin', 'Technician'],
    'TechnicianAssignment' => ['Admin', 'Technician'],
    
    'MaintenanceTicket' => ['Admin', 'Technician'],
    'Warranty' => ['Admin', 'Technician', 'Accountant', 'Sales'],
    
    'SolarSystem' => ['Admin', 'Technician', 'Sales'],
    
    'Setting' => ['Admin'],
    'AuditLog' => ['Admin'],
];

foreach ($modelsWithRoles as $model => $allowedRoles) {
    $rolesPhp = implode("', '", $allowedRoles);
    $policyCode = <<<PHP
<?php

namespace App\Policies;

use App\Models\\{$model};
use App\Models\User;

class {$model}Policy
{
    protected array \$allowedRoles = ['{$rolesPhp}'];

    public function viewAny(User \$user): bool
    {
        return \$user->hasAnyRole(['Admin', ...\$this->allowedRoles]);
    }

    public function view(User \$user, {$model} \$model): bool
    {
        return \$user->hasAnyRole(['Admin', ...\$this->allowedRoles]);
    }

    public function create(User \$user): bool
    {
        return \$user->hasAnyRole(['Admin', ...\$this->allowedRoles]);
    }

    public function update(User \$user, {$model} \$model): bool
    {
        return \$user->hasAnyRole(['Admin', ...\$this->allowedRoles]);
    }

    public function delete(User \$user, {$model} \$model): bool
    {
        return \$user->hasRole('Admin');
    }

    public function restore(User \$user, {$model} \$model): bool
    {
        return \$user->hasRole('Admin');
    }

    public function forceDelete(User \$user, {$model} \$model): bool
    {
        return \$user->hasRole('Admin');
    }
}
PHP;

    file_put_contents("{$policiesDir}/{$model}Policy.php", $policyCode);
    echo "Created {$model}Policy.php\n";
}

echo "All policies generated successfully!\n";
