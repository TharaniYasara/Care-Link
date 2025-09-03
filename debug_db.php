<?php
require_once 'admin/db.php';

try {
    // Check table structure
    echo "<h2>Adoption Application Table Structure:</h2>";
    $stmt = $pdo->query("DESCRIBE adoption_application");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<table border='1'>";
    echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th></tr>";
    foreach ($columns as $col) {
        echo "<tr>";
        echo "<td>{$col['Field']}</td>";
        echo "<td>{$col['Type']}</td>";
        echo "<td>{$col['Null']}</td>";
        echo "<td>{$col['Key']}</td>";
        echo "<td>{$col['Default']}</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    // Check if there's any data
    echo "<h2>Sample Data (first row):</h2>";
    $stmt = $pdo->query("SELECT * FROM adoption_application LIMIT 1");
    $sample = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($sample) {
        echo "<table border='1'>";
        echo "<tr><th>Field</th><th>Value</th></tr>";
        foreach ($sample as $field => $value) {
            echo "<tr>";
            echo "<td>{$field}</td>";
            echo "<td>" . htmlspecialchars($value ?? 'NULL') . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No data found in the table.";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
