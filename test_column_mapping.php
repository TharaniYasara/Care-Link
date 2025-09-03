<?php
// Test script to verify form field to database column mapping
require_once 'admin/db.php';

echo "<h2>🔍 Column Mapping Verification Test</h2>\n";

// Get database columns
try {
    $stmt = $pdo->query("DESCRIBE adoption_application");
    $dbColumns = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $dbColumns[] = $row['Field'];
    }
    echo "<h3>✅ Database columns found: " . count($dbColumns) . "</h3>\n";
} catch (Exception $e) {
    echo "❌ Error getting database columns: " . $e->getMessage() . "<br>\n";
    exit;
}

// Expected form fields based on our HTML form
$formFields = [
    // Personal Information - Father
    'father_family_name',
    'father_first_names', 
    'father_dob',
    'father_nationality',
    'father_pob_country',
    'father_pob_city',
    'father_passport',
    'father_religion',
    'father_languages',
    
    // Personal Information - Mother
    'mother_family_name',
    'mother_first_names',
    'mother_dob', 
    'mother_nationality',
    'mother_pob_country',
    'mother_pob_city',
    'mother_passport',
    'mother_religion',
    'mother_languages',
    
    // Marriage Information
    'date_of_marriage',
    'marriage_history',
    
    // Address & Contact
    'present_address',
    'phone',
    'email',
    'permanent_address',
    'residence_type',
    'ownership',
    'bedrooms',
    
    // Financial & Other
    'household_income',
    'assets',
    'debts',
    'health_conditions',
    
    // Preferences
    'prefer_typical',
    'preferred_age',
    'preferred_sex',
    'accept_special_needs',
    'special_age',
    'special_sex',
    
    // Declarations
    'decl_true',
    'decl_consent',
    
    // Additional
    'other_particulars',
    'status'
];

echo "<h3>📋 Form Field to Database Column Mapping Check:</h3>\n";
echo "<table border='1' style='border-collapse: collapse; width: 100%;'>\n";
echo "<tr><th>Form Field</th><th>Database Column</th><th>Status</th></tr>\n";

$mismatches = [];
$matches = 0;

foreach ($formFields as $field) {
    $exists = in_array($field, $dbColumns);
    $status = $exists ? '✅ Match' : '❌ Missing';
    $rowColor = $exists ? '' : ' style="background-color: #ffe6e6;"';
    
    echo "<tr$rowColor><td>$field</td><td>" . ($exists ? $field : 'NOT FOUND') . "</td><td>$status</td></tr>\n";
    
    if ($exists) {
        $matches++;
    } else {
        $mismatches[] = $field;
    }
}

echo "</table>\n";

echo "<h3>📊 Summary:</h3>\n";
echo "<p><strong>Total form fields:</strong> " . count($formFields) . "</p>\n";
echo "<p><strong>Matching fields:</strong> $matches</p>\n";
echo "<p><strong>Missing fields:</strong> " . count($mismatches) . "</p>\n";

if (!empty($mismatches)) {
    echo "<h3>❌ Missing Database Columns:</h3>\n";
    echo "<ul>\n";
    foreach ($mismatches as $field) {
        echo "<li style='color: red;'>$field</li>\n";
    }
    echo "</ul>\n";
}

// Check for database columns not covered by form
$uncoveredColumns = [];
$systemColumns = ['id', 'created_at']; // System-generated columns

foreach ($dbColumns as $column) {
    if (!in_array($column, $formFields) && !in_array($column, $systemColumns)) {
        $uncoveredColumns[] = $column;
    }
}

if (!empty($uncoveredColumns)) {
    echo "<h3>⚠️ Database Columns Not in Form:</h3>\n";
    echo "<ul>\n";
    foreach ($uncoveredColumns as $column) {
        echo "<li style='color: orange;'>$column</li>\n";
    }
    echo "</ul>\n";
}

// Test actual insertion with sample data
echo "<h3>🧪 Testing Database Insertion:</h3>\n";

$testData = [
    'father_family_name' => 'TEST_Silva',
    'father_first_names' => 'TEST_John',
    'father_dob' => '1985-03-15',
    'father_nationality' => 'Sri Lankan',
    'father_pob_country' => 'Sri Lanka',
    'father_pob_city' => 'Colombo',
    'father_passport' => 'TEST123',
    'father_religion' => 'Buddhist',
    'father_languages' => 'English, Sinhala',
    'mother_family_name' => 'TEST_Silva',
    'mother_first_names' => 'TEST_Mary',
    'mother_dob' => '1987-07-22',
    'mother_nationality' => 'Sri Lankan',
    'mother_pob_country' => 'Sri Lanka',
    'mother_pob_city' => 'Kandy',
    'mother_passport' => 'TEST456',
    'mother_religion' => 'Buddhist',
    'mother_languages' => 'English, Sinhala',
    'date_of_marriage' => '2010-12-10',
    'marriage_history' => 'first_marriage',
    'present_address' => 'TEST Address 123',
    'phone' => '+94771234567',
    'email' => 'test@test.com',
    'permanent_address' => 'TEST Permanent Address',
    'residence_type' => 'owned_house',
    'ownership' => 'owned',
    'bedrooms' => 3,
    'household_income' => 250000.00,
    'assets' => '5500000',
    'debts' => '1200000',
    'health_conditions' => 'None',
    'prefer_typical' => 'No',
    'preferred_age' => '0-6months',
    'preferred_sex' => 'either',
    'accept_special_needs' => 'Yes',
    'special_age' => '0-3 years',
    'special_sex' => 'either',
    'decl_true' => 1,
    'decl_consent' => 1,
    'other_particulars' => 'TEST adoption reason',
    'status' => 'draft'
];

try {
    $pdo->beginTransaction();
    
    $columns = array_keys($testData);
    $placeholders = ':' . implode(', :', $columns);
    
    $sql = "INSERT INTO adoption_application (" . implode(', ', $columns) . ") VALUES (" . $placeholders . ")";
    $stmt = $pdo->prepare($sql);
    
    $bindData = [];
    foreach ($testData as $key => $value) {
        $bindData[':' . $key] = $value;
    }
    
    $stmt->execute($bindData);
    $insertId = $pdo->lastInsertId();
    
    echo "✅ <strong>Test insertion successful!</strong> Record ID: $insertId<br>\n";
    
    // Clean up - delete the test record
    $pdo->prepare("DELETE FROM adoption_application WHERE id = ?")->execute([$insertId]);
    echo "✅ Test record cleaned up<br>\n";
    
    $pdo->commit();
    
} catch (Exception $e) {
    $pdo->rollback();
    echo "❌ <strong>Test insertion failed:</strong> " . $e->getMessage() . "<br>\n";
    echo "<p style='color: red;'>This indicates a field mapping issue that needs to be fixed.</p>\n";
}

echo "<hr>\n";
echo "<h3>🎯 Next Steps:</h3>\n";
if (empty($mismatches) && empty($uncoveredColumns)) {
    echo "<p style='color: green; font-weight: bold;'>✅ All field mappings are correct! Form is ready for use.</p>\n";
} else {
    echo "<p style='color: red; font-weight: bold;'>❌ Field mapping issues found. Please fix the mismatches above.</p>\n";
}
?>
