<?php
// Test script to verify adoption application submission
require_once 'admin/db.php';

echo "<h2>Testing Adoption Application Submission</h2>\n";

// Test 1: Check database connection
try {
    $pdo->query("SELECT 1");
    echo "✅ Database connection successful<br>\n";
} catch (Exception $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "<br>\n";
    exit;
}

// Test 2: Check if all required tables exist
$required_tables = [
    'adoption_application',
    'application_employment_father',
    'application_employment_mother',
    'application_children',
    'application_files'
];

foreach ($required_tables as $table) {
    try {
        $stmt = $pdo->query("SHOW TABLES LIKE '$table'");
        if ($stmt->rowCount() > 0) {
            echo "✅ Table '$table' exists<br>\n";
        } else {
            echo "❌ Table '$table' does not exist<br>\n";
        }
    } catch (Exception $e) {
        echo "❌ Error checking table '$table': " . $e->getMessage() . "<br>\n";
    }
}

// Test 3: Simulate form submission data
$testData = [
    // Main application data
    'father_family_name' => 'Silva',
    'father_first_names' => 'John Anthony',
    'father_date_of_birth' => '1985-05-15',
    'father_place_of_birth' => 'Colombo',
    'father_nationality' => 'Sri Lankan',
    'father_religion' => 'Buddhist',
    'father_education_level' => 'Degree',
    'father_nic' => '198512345678',
    'father_passport' => 'N1234567',
    'father_address' => '123 Main Street, Colombo 03',
    'mother_family_name' => 'Fernando',
    'mother_first_names' => 'Mary Jane',
    'mother_date_of_birth' => '1987-03-20',
    'mother_place_of_birth' => 'Kandy',
    'mother_nationality' => 'Sri Lankan',
    'mother_religion' => 'Christian',
    'mother_education_level' => 'Diploma',
    'mother_nic' => '198712345679',
    'mother_passport' => 'N1234568',
    'mother_address' => '123 Main Street, Colombo 03',
    'marriage_date' => '2010-12-25',
    'marriage_certificate_no' => 'MC123456',
    'email' => 'test@example.com',
    'phone' => '+94771234567',
    'household_income' => 150000,
    'preferred_gender' => 'Any',
    'preferred_age_range' => '0-2 years',
    'motivation' => 'We want to provide a loving home for a child in need.',
    'father_employment' => json_encode([
        [
            'employer' => 'ABC Company',
            'position' => 'Manager',
            'duration' => '5 years',
            'salary' => '80000'
        ]
    ]),
    'mother_employment' => json_encode([
        [
            'employer' => 'XYZ Ltd',
            'position' => 'Accountant',
            'duration' => '3 years',
            'salary' => '70000'
        ]
    ]),
    'children' => json_encode([
        [
            'name' => 'Sarah Silva',
            'age' => '8',
            'relationship' => 'Biological daughter'
        ]
    ]),
    'status' => 'submitted'
];

echo "<h3>Test 4: Simulating Form Submission</h3>\n";

try {
    $pdo->beginTransaction();
    
    // Insert main application
    $sql = "INSERT INTO adoption_application (
        father_family_name, father_first_names, father_date_of_birth, father_place_of_birth,
        father_nationality, father_religion, father_education_level, father_nic, father_passport, father_address,
        mother_family_name, mother_first_names, mother_date_of_birth, mother_place_of_birth,
        mother_nationality, mother_religion, mother_education_level, mother_nic, mother_passport, mother_address,
        marriage_date, marriage_certificate_no, email, phone, household_income,
        preferred_gender, preferred_age_range, motivation, status, created_at
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([
        $testData['father_family_name'], $testData['father_first_names'], $testData['father_date_of_birth'], $testData['father_place_of_birth'],
        $testData['father_nationality'], $testData['father_religion'], $testData['father_education_level'], $testData['father_nic'], $testData['father_passport'], $testData['father_address'],
        $testData['mother_family_name'], $testData['mother_first_names'], $testData['mother_date_of_birth'], $testData['mother_place_of_birth'],
        $testData['mother_nationality'], $testData['mother_religion'], $testData['mother_education_level'], $testData['mother_nic'], $testData['mother_passport'], $testData['mother_address'],
        $testData['marriage_date'], $testData['marriage_certificate_no'], $testData['email'], $testData['phone'], $testData['household_income'],
        $testData['preferred_gender'], $testData['preferred_age_range'], $testData['motivation'], $testData['status']
    ]);
    
    if ($result) {
        $applicationId = $pdo->lastInsertId();
        echo "✅ Main application inserted with ID: $applicationId<br>\n";
        
        // Insert father employment
        $fatherEmployment = json_decode($testData['father_employment'], true);
        foreach ($fatherEmployment as $emp) {
            $stmt = $pdo->prepare("INSERT INTO application_employment_father (application_id, employer, position, duration, salary) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$applicationId, $emp['employer'], $emp['position'], $emp['duration'], $emp['salary']]);
        }
        echo "✅ Father employment data inserted<br>\n";
        
        // Insert mother employment
        $motherEmployment = json_decode($testData['mother_employment'], true);
        foreach ($motherEmployment as $emp) {
            $stmt = $pdo->prepare("INSERT INTO application_employment_mother (application_id, employer, position, duration, salary) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$applicationId, $emp['employer'], $emp['position'], $emp['duration'], $emp['salary']]);
        }
        echo "✅ Mother employment data inserted<br>\n";
        
        // Insert children data
        $children = json_decode($testData['children'], true);
        foreach ($children as $child) {
            $stmt = $pdo->prepare("INSERT INTO application_children (application_id, name, age, relationship) VALUES (?, ?, ?, ?)");
            $stmt->execute([$applicationId, $child['name'], $child['age'], $child['relationship']]);
        }
        echo "✅ Children data inserted<br>\n";
        
        $pdo->commit();
        echo "<strong>✅ Complete test submission successful!</strong><br>\n";
        
        // Verify data was saved correctly
        echo "<h3>Test 5: Verifying Saved Data</h3>\n";
        
        $stmt = $pdo->prepare("SELECT * FROM adoption_application WHERE id = ?");
        $stmt->execute([$applicationId]);
        $app = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($app) {
            echo "✅ Application data retrieved successfully<br>\n";
            echo "- Father: " . $app['father_first_names'] . " " . $app['father_family_name'] . "<br>\n";
            echo "- Mother: " . $app['mother_first_names'] . " " . $app['mother_family_name'] . "<br>\n";
            echo "- Email: " . $app['email'] . "<br>\n";
            echo "- Status: " . $app['status'] . "<br>\n";
        }
        
        // Check related tables
        $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM application_employment_father WHERE application_id = ?");
        $stmt->execute([$applicationId]);
        $fatherEmpCount = $stmt->fetch()['count'];
        echo "✅ Father employment records: $fatherEmpCount<br>\n";
        
        $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM application_employment_mother WHERE application_id = ?");
        $stmt->execute([$applicationId]);
        $motherEmpCount = $stmt->fetch()['count'];
        echo "✅ Mother employment records: $motherEmpCount<br>\n";
        
        $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM application_children WHERE application_id = ?");
        $stmt->execute([$applicationId]);
        $childrenCount = $stmt->fetch()['count'];
        echo "✅ Children records: $childrenCount<br>\n";
        
    } else {
        echo "❌ Failed to insert main application<br>\n";
        $pdo->rollback();
    }
    
} catch (Exception $e) {
    echo "❌ Test submission failed: " . $e->getMessage() . "<br>\n";
    $pdo->rollback();
}

echo "<h3>Test 6: Testing save_adoption.php endpoint</h3>\n";

// Test the actual save_adoption.php endpoint
echo "Now testing the actual save_adoption.php endpoint...<br>\n";
echo "<a href='admin/pages/save_adoption.php' target='_blank'>Click here to test save_adoption.php directly</a><br>\n";

echo "<h3>Test 7: Admin Interface Links</h3>\n";
echo "<a href='admin/pages/adoption_applications.php' target='_blank'>View Adoption Applications Admin Page</a><br>\n";
echo "<a href='admin/pages/adoption_application.html' target='_blank'>Test Adoption Application Form</a><br>\n";

echo "<br><strong>All tests completed!</strong>\n";
?>
