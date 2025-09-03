-- Create adoption application tables

-- Main adoption application table
CREATE TABLE IF NOT EXISTS adoption_application (
    id INT AUTO_INCREMENT PRIMARY KEY,
    
    -- Father details
    father_family_name VARCHAR(255),
    father_first_names VARCHAR(255),
    father_dob DATE,
    father_pob_country VARCHAR(100),
    father_pob_city VARCHAR(100),
    father_nationality VARCHAR(100),
    father_passport VARCHAR(50),
    father_religion VARCHAR(100),
    father_languages TEXT,
    
    -- Mother details
    mother_family_name VARCHAR(255),
    mother_first_names VARCHAR(255),
    mother_dob DATE,
    mother_pob_country VARCHAR(100),
    mother_pob_city VARCHAR(100),
    mother_nationality VARCHAR(100),
    mother_passport VARCHAR(50),
    mother_religion VARCHAR(100),
    mother_languages TEXT,
    
    -- Contact and residence
    present_address TEXT,
    permanent_address TEXT,
    email VARCHAR(255),
    phone VARCHAR(50),
    date_of_marriage DATE,
    residence_type VARCHAR(50),
    ownership VARCHAR(50),
    bedrooms INT,
    
    -- Financial information
    household_income DECIMAL(15,2),
    assets TEXT,
    debts TEXT,
    
    -- Background information
    health_conditions TEXT,
    marriage_history TEXT,
    
    -- Child preferences
    prefer_typical ENUM('Yes', 'No'),
    preferred_age VARCHAR(100),
    preferred_sex VARCHAR(50),
    accept_special_needs ENUM('Yes', 'No'),
    special_age VARCHAR(100),
    special_sex VARCHAR(50),
    
    -- Other details
    other_particulars TEXT,
    
    -- Declarations
    decl_true BOOLEAN DEFAULT FALSE,
    decl_consent BOOLEAN DEFAULT FALSE,
    
    -- Timestamps
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    -- Application status
    status ENUM('draft', 'submitted', 'under_review', 'approved', 'rejected') DEFAULT 'submitted'
);

-- Father employment table
CREATE TABLE IF NOT EXISTS application_employment_father (
    id INT AUTO_INCREMENT PRIMARY KEY,
    application_id INT NOT NULL,
    employer VARCHAR(255),
    role_title VARCHAR(255),
    monthly_income DECIMAL(12,2),
    FOREIGN KEY (application_id) REFERENCES adoption_application(id) ON DELETE CASCADE
);

-- Mother employment table
CREATE TABLE IF NOT EXISTS application_employment_mother (
    id INT AUTO_INCREMENT PRIMARY KEY,
    application_id INT NOT NULL,
    employer VARCHAR(255),
    role_title VARCHAR(255),
    monthly_income DECIMAL(12,2),
    FOREIGN KEY (application_id) REFERENCES adoption_application(id) ON DELETE CASCADE
);

-- Children table
CREATE TABLE IF NOT EXISTS application_children (
    id INT AUTO_INCREMENT PRIMARY KEY,
    application_id INT NOT NULL,
    child_name VARCHAR(255),
    child_dob DATE,
    child_gender VARCHAR(20),
    child_relation VARCHAR(100),
    FOREIGN KEY (application_id) REFERENCES adoption_application(id) ON DELETE CASCADE
);

-- File attachments table
CREATE TABLE IF NOT EXISTS application_files (
    id INT AUTO_INCREMENT PRIMARY KEY,
    application_id INT NOT NULL,
    original_name VARCHAR(255),
    stored_name VARCHAR(255),
    mime_type VARCHAR(100),
    size_bytes INT,
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (application_id) REFERENCES adoption_application(id) ON DELETE CASCADE
);
