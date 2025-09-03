-- Simplified Monitoring System Tables (without foreign key constraints for now)

-- Monitoring Officers Table
CREATE TABLE IF NOT EXISTS monitoring_officers (
    id INT PRIMARY KEY AUTO_INCREMENT,
    officer_name VARCHAR(255) NOT NULL,
    officer_code VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    assigned_region VARCHAR(100),
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Adopted Children Table (simplified, no foreign key to adoption_application)
CREATE TABLE IF NOT EXISTS adopted_children (
    id INT PRIMARY KEY AUTO_INCREMENT,
    child_name VARCHAR(255) NOT NULL,
    child_dob DATE,
    adoption_date DATE,
    adoptive_father_name VARCHAR(255),
    adoptive_mother_name VARCHAR(255),
    father_phone VARCHAR(20),
    mother_phone VARCHAR(20),
    child_phone VARCHAR(20),
    child_email VARCHAR(255),
    address TEXT,
    monitoring_status ENUM('active', 'completed', 'suspended') DEFAULT 'active',
    next_visit_due DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Monitoring Visits
CREATE TABLE IF NOT EXISTS monitoring_visits (
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
    visit_notes TEXT,
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
