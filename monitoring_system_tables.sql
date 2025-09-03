-- Post-Adoption Monitoring System Database Tables

-- Monitoring Officers Table
CREATE TABLE monitoring_officers (
    id INT PRIMARY KEY AUTO_INCREMENT,
    officer_name VARCHAR(255) NOT NULL,
    officer_id VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    assigned_region VARCHAR(100),
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- NOTE: Ensure adoption_application table is created before this table!
CREATE TABLE adopted_children (
    id INT PRIMARY KEY AUTO_INCREMENT,
    adoption_application_id BIGINT(20) UNSIGNED,
    child_name VARCHAR(255) NOT NULL,
    child_dob DATE,
    adoption_finalized_date DATE,
    adoptive_father_name VARCHAR(255),
    adoptive_mother_name VARCHAR(255),
    current_address TEXT,
    phone VARCHAR(20),
    monitoring_status ENUM('active', 'completed', 'suspended') DEFAULT 'active',
    next_visit_due DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (adoption_application_id) REFERENCES adoption_application(id)
) ENGINE=InnoDB;

-- Monitoring Visits
CREATE TABLE monitoring_visits (
    id INT PRIMARY KEY AUTO_INCREMENT,
    adopted_child_id INT NOT NULL,
    officer_id INT NOT NULL,
    visit_date DATE NOT NULL,
    visit_type ENUM('routine', 'follow_up', 'urgent', 'final') DEFAULT 'routine',
    visit_status ENUM('scheduled', 'completed', 'cancelled', 'rescheduled') DEFAULT 'completed',
    
    -- Child Assessment Scores (1-5 scale)
    physical_health_score INT(1) CHECK (physical_health_score BETWEEN 1 AND 5),
    mental_health_score INT(1) CHECK (mental_health_score BETWEEN 1 AND 5),
    educational_progress_score INT(1) CHECK (educational_progress_score BETWEEN 1 AND 5),
    social_integration_score INT(1) CHECK (social_integration_score BETWEEN 1 AND 5),
    family_bonding_score INT(1) CHECK (family_bonding_score BETWEEN 1 AND 5),
    
    -- Detailed Observations
    physical_observations TEXT,
    behavioral_observations TEXT,
    educational_status TEXT,
    family_dynamics TEXT,
    living_conditions TEXT,
    concerns_identified TEXT,
    recommendations TEXT,
    
    -- Next Steps
    next_visit_recommended DATE,
    follow_up_required BOOLEAN DEFAULT FALSE,
    urgent_intervention BOOLEAN DEFAULT FALSE,
    
    overall_assessment ENUM('excellent', 'good', 'satisfactory', 'concerning', 'critical') DEFAULT 'satisfactory',
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (adopted_child_id) REFERENCES adopted_children(id),
    FOREIGN KEY (officer_id) REFERENCES monitoring_officers(id)
);

-- Insert sample monitoring officer (password: officer123)
INSERT INTO monitoring_officers (officer_name, officer_id, email, phone, password, assigned_region, status) VALUES
('John Smith', 'OFF001', 'john.smith@carelink.lk', '+94771234567', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Colombo District', 'active'),
('Sarah Johnson', 'OFF002', 'sarah.johnson@carelink.lk', '+94771234568', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Kandy District', 'active');
