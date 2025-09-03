-- Update the status ENUM to match the current workflow
ALTER TABLE adoption_application 
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
) DEFAULT 'submitted';
