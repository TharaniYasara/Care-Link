-- Sample Data for Post-Adoption Monitoring System

-- First, let's add some sample monitoring officers if they don't exist
INSERT IGNORE INTO monitoring_officers (officer_name, officer_id, email, phone, password, assigned_region, status) VALUES
('Dr. Sarah Williams', 'MON001', 'sarah.williams@carelink.lk', '+94771234567', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Western Province', 'active'),
('Mr. David Thompson', 'MON002', 'david.thompson@carelink.lk', '+94771234568', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Central Province', 'active'),
('Ms. Lisa Chen', 'MON003', 'lisa.chen@carelink.lk', '+94771234569', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Southern Province', 'active');

-- Add sample adopted children if they don't exist
INSERT IGNORE INTO adopted_children (
    id, child_name, child_dob, adoption_date, 
    adoptive_father_name, adoptive_mother_name, 
    father_phone, mother_phone, child_phone, child_email,
    address, monitoring_status, next_visit_due
) VALUES
(1, 'Emily Rodriguez', '2015-03-15', '2022-06-10', 
 'Michael Rodriguez', 'Anna Rodriguez', 
 '+94771111111', '+94771111112', '+94771111113', 'emily.rodriguez@family.lk',
 '123 Maple Street, Colombo 03', 'active', '2024-12-15'),

(2, 'James Wilson', '2014-08-22', '2022-01-20', 
 'Robert Wilson', 'Jennifer Wilson', 
 '+94772222221', '+94772222222', '+94772222223', 'james.wilson@family.lk',
 '456 Oak Avenue, Kandy', 'active', '2024-11-20'),

(3, 'Sophie Chen', '2016-01-05', '2023-03-12', 
 'Thomas Chen', 'Maria Chen', 
 '+94773333331', '+94773333332', '+94773333333', 'sophie.chen@family.lk',
 '789 Pine Road, Galle', 'active', '2024-10-25'),

(4, 'Lucas Anderson', '2013-11-18', '2021-09-08', 
 'William Anderson', 'Sarah Anderson', 
 '+94774444441', '+94774444442', '+94774444443', 'lucas.anderson@family.lk',
 '321 Cedar Lane, Negombo', 'active', '2025-01-08'),

(5, 'Maya Patel', '2017-05-30', '2023-08-15', 
 'Raj Patel', 'Priya Patel', 
 '+94775555551', '+94775555552', '+94775555553', 'maya.patel@family.lk',
 '654 Birch Street, Matara', 'active', '2024-12-01');

-- Add comprehensive sample visit records
INSERT INTO monitoring_visits (
    adopted_child_id, officer_id, visit_date, visit_type, visit_status,
    physical_health_score, mental_health_score, educational_progress_score, 
    social_integration_score, family_bonding_score,
    visit_notes, concerns_identified, recommendations,
    follow_up_required, urgent_intervention, overall_assessment
) VALUES

-- Visit 1: Emily Rodriguez - Excellent progress
(1, 1, '2024-08-15', 'routine', 'completed',
 5, 5, 4, 5, 5,
 'Emily is thriving in her new family environment. She shows excellent physical development and has adapted well to her new school. The family dynamics are very positive with strong emotional bonds. Emily participates actively in family activities and has made good friends in the neighborhood.',
 NULL,
 'Continue current care approach. Schedule regular check-ins. Consider advanced educational programs given Emily\'s academic progress.',
 0, 0, 'excellent'),

-- Visit 2: James Wilson - Good with minor concerns
(2, 2, '2024-08-10', 'routine', 'completed',
 4, 3, 4, 4, 4,
 'James has shown good overall progress. He has settled well into the family routine and is performing adequately in school. Some initial shyness observed but improving over time. Physical health is good with regular medical check-ups.',
 'James occasionally shows signs of anxiety during social interactions with new people. May need additional support for confidence building.',
 'Recommend social skills development activities. Consider counseling sessions to address mild anxiety. Encourage participation in group activities.',
 1, 0, 'good'),

-- Visit 3: Sophie Chen - Recent placement, monitoring closely
(3, 3, '2024-08-05', 'follow_up', 'completed',
 4, 3, 4, 3, 4,
 'Sophie is adjusting well to her new family. Being a relatively recent placement, she is still adapting to new routines. Shows good physical health and is catching up academically. Family is very supportive and patient.',
 'Some difficulty in social integration at school. Needs time to build friendships. Occasional homesickness observed.',
 'Continue close monitoring during adjustment period. Encourage school counselor involvement. Plan family bonding activities.',
 1, 0, 'satisfactory'),

-- Visit 4: Lucas Anderson - Long-term success story
(4, 1, '2024-07-28', 'routine', 'completed',
 5, 5, 5, 5, 5,
 'Lucas continues to excel in all areas. He has been with the family for nearly 3 years and shows remarkable progress. Academic performance is outstanding, social skills are excellent, and family relationships are very strong. He has become a positive role model.',
 NULL,
 'Excellent progress across all areas. Consider reducing visit frequency to semi-annual. Family ready for final assessment phase.',
 0, 0, 'excellent'),

-- Visit 5: Maya Patel - Recent concern requiring attention
(5, 2, '2024-08-20', 'urgent', 'completed',
 3, 2, 3, 2, 3,
 'Maya has been showing some behavioral challenges recently. Reports from school indicate increased aggression and difficulty concentrating. Family reports some regression in behavior at home. Physical health remains good.',
 'Behavioral regression noticed. Difficulty in peer relationships at school. Some resistance to family rules and activities. May be related to adjustment stress or underlying trauma.',
 'Immediate referral to child psychologist recommended. Increase visit frequency to bi-weekly. Provide family with additional behavioral management strategies. School counselor consultation needed.',
 1, 1, 'concerning');

-- Add some additional historical visits for pattern tracking
INSERT INTO monitoring_visits (
    adopted_child_id, officer_id, visit_date, visit_type, visit_status,
    physical_health_score, mental_health_score, educational_progress_score, 
    social_integration_score, family_bonding_score,
    visit_notes, concerns_identified, recommendations,
    follow_up_required, urgent_intervention, overall_assessment
) VALUES

-- Emily's previous visit
(1, 1, '2024-05-15', 'routine', 'completed',
 4, 4, 4, 4, 5,
 'Emily showing consistent progress in all areas. Strong family bonds continue to develop.',
 NULL,
 'Continue current approach.',
 0, 0, 'good'),

-- James's follow-up visit
(2, 2, '2024-05-10', 'follow_up', 'completed',
 4, 3, 3, 3, 4,
 'James showing gradual improvement in confidence levels.',
 'Still some social anxiety present.',
 'Continue social skills support.',
 1, 0, 'satisfactory'),

-- Maya's previous routine visit (before current concerns)
(5, 2, '2024-05-20', 'routine', 'completed',
 4, 4, 4, 4, 4,
 'Maya adapting well to family environment. Good progress overall.',
 NULL,
 'Continue monitoring.',
 0, 0, 'good');
