<?php
require_once 'admin/db.php';

try {
    // Update the status ENUM to match the current workflow
    $sql = "ALTER TABLE adoption_application 
            MODIFY COLUMN status ENUM(
                'draft',
                'submitted', 
                'processing',
                'pending_screening',
                'approved',
                'in_bonding',
                'awaiting_court_order',
                'finalized',
                'rejected'
            ) DEFAULT 'submitted'";
    
    $pdo->exec($sql);
    echo "✅ Database status ENUM updated successfully!";
    
} catch (Exception $e) {
    echo "❌ Error updating database: " . $e->getMessage();
}
?>