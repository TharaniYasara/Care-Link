<?php
// Test form submission script
require_once 'admin/db.php';

echo "<h2>🚀 Form Submission Test</h2>\n";

// Simulate comprehensive form data
$_POST = [
    // Personal Information - Father
    'father_family_name' => 'Silva',
    'father_first_names' => 'John Michael',
    'father_dob' => '1985-03-15',
    'father_nationality' => 'Sri Lankan',
    'father_pob_country' => 'Sri Lanka',
    'father_pob_city' => 'Colombo',
    'father_passport' => 'N1234567',
    'father_religion' => 'Buddhist',
    'father_languages' => 'English, Sinhala, Tamil',
    
    // Personal Information - Mother
    'mother_family_name' => 'Silva',
    'mother_first_names' => 'Mary Elizabeth',
    'mother_dob' => '1987-07-22',
    'mother_nationality' => 'Sri Lankan',
    'mother_pob_country' => 'Sri Lanka',
    'mother_pob_city' => 'Kandy',
    'mother_passport' => 'N2345678',
    'mother_religion' => 'Buddhist',
    'mother_languages' => 'English, Sinhala',
    
    // Marriage Information
    'date_of_marriage' => '2010-12-10',
    'marriage_history' => 'first_marriage',
    
    // Address & Contact Information
    'present_address' => 'No. 123, Galle Road, Colombo 03, Sri Lanka',
    'phone' => '+94771234567',
    'email' => 'john.silva@email.com',
    'permanent_address' => 'No. 456, Kandy Road, Peradeniya, Kandy',
    'residence_type' => 'owned_house',
    'ownership' => 'owned',
    'bedrooms' => '3',
    
    // Financial Information & Preferences
    'household_income' => '250000',
    'assets' => '5500000',
    'debts' => '1200000',
    'health_conditions' => 'Father: Mild hypertension (controlled with medication). Mother: No significant health issues.',
    'prefer_typical' => 'No',
    'preferred_age' => '0-6months',
    'preferred_sex' => 'either',
    'accept_special_needs' => 'Yes',
    'special_age' => '0-3 years',
    'special_sex' => 'either',
    
    // Declarations
    'decl_true' => '1',
    'decl_consent' => '1',
    
    // Additional Information
    'adoption_reason' => 'After having two biological children, we feel called to provide a loving home for a child in need.',
    'additional_info' => 'We have completed comprehensive parenting courses including adoption-specific training.',
    
    // Employment data simulation
    'father_employment' => [
        [
            'employer_name' => 'Tech Solutions (Pvt) Ltd',
            'position' => 'Senior Software Engineer',
            'from_date' => '2018-01-01',
            'to_date' => '2025-12-31',
            'salary' => '150000'
        ]
    ],
    
    'mother_employment' => [
        [
            'employer_name' => 'International School Colombo',
            'position' => 'Senior Mathematics Teacher',
            'from_date' => '2012-02-01',
            'to_date' => '2025-12-31',
            'salary' => '100000'
        ]
    ],
    
    'children' => [
        [
            'name' => 'Alex Silva',
            'dob' => '2018-05-15',
            'gender' => 'male',
            'relationship' => 'biological_child'
        ]
    ],
    
    'final_submit' => '0' // Save as draft
];

echo "<p>📋 <strong>Simulating form submission with comprehensive data...</strong></p>\n";

// Include the save script
ob_start();
try {
    include 'admin/pages/save_adoption.php';
    $output = ob_get_contents();
} catch (Exception $e) {
    $output = json_encode(['success' => false, 'error' => $e->getMessage()]);
} finally {
    ob_end_clean();
}

// Parse the JSON response
$response = json_decode($output, true);

if ($response && isset($response['success'])) {
    if ($response['success']) {
        echo "<div style='background: #d4edda; color: #155724; padding: 15px; border: 1px solid #c3e6cb; border-radius: 5px;'>";
        echo "✅ <strong>SUCCESS!</strong> Form submission completed successfully.<br>";
        echo "📄 Application ID: " . ($response['application_id'] ?? 'N/A') . "<br>";
        echo "📊 Status: " . ($response['status'] ?? 'N/A') . "<br>";
        echo "</div>";
    } else {
        echo "<div style='background: #f8d7da; color: #721c24; padding: 15px; border: 1px solid #f5c6cb; border-radius: 5px;'>";
        echo "❌ <strong>FAILED!</strong> Form submission failed.<br>";
        echo "🔍 Error: " . ($response['error'] ?? 'Unknown error') . "<br>";
        echo "</div>";
    }
} else {
    echo "<div style='background: #fff3cd; color: #856404; padding: 15px; border: 1px solid #ffeaa7; border-radius: 5px;'>";
    echo "⚠️ <strong>UNEXPECTED RESPONSE</strong><br>";
    echo "📝 Raw output: <pre>" . htmlspecialchars($output) . "</pre>";
    echo "</div>";
}

echo "<hr>";
echo "<h3>🔍 Database Verification</h3>";

try {
    $stmt = $pdo->query("SELECT id, father_family_name, mother_family_name, email, phone, status, created_at FROM adoption_application ORDER BY created_at DESC LIMIT 5");
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($records) > 0) {
        echo "<p>✅ Recent applications in database:</p>";
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr><th>ID</th><th>Father Name</th><th>Mother Name</th><th>Email</th><th>Phone</th><th>Status</th><th>Created</th></tr>";
        
        foreach ($records as $record) {
            echo "<tr>";
            echo "<td>" . $record['id'] . "</td>";
            echo "<td>" . $record['father_family_name'] . "</td>";
            echo "<td>" . $record['mother_family_name'] . "</td>";
            echo "<td>" . $record['email'] . "</td>";
            echo "<td>" . $record['phone'] . "</td>";
            echo "<td>" . $record['status'] . "</td>";
            echo "<td>" . $record['created_at'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>⚠️ No applications found in database.</p>";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Error querying database: " . $e->getMessage() . "</p>";
}
?>