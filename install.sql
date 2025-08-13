-- Andrew Yemen sample DB
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) UNIQUE,
  email VARCHAR(255),
  password_hash VARCHAR(255),
  type VARCHAR(50) DEFAULT 'jobseeker',
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE IF NOT EXISTS jobs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255),
  company VARCHAR(255),
  location VARCHAR(255),
  description TEXT,
  apply_email VARCHAR(255),
  status VARCHAR(20) DEFAULT 'pending',
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
-- sample admin user (use setup_admin.php to set admin password)
INSERT INTO users (username, email, password_hash, type) VALUES ('admin', 'admin@andrewyemen.local', 'REPLACE_WITH_PHP_PASSWORD_HASH', 'admin');
-- sample approved job so it appears immediately
INSERT INTO jobs (title, company, location, description, apply_email, status) VALUES (
  'Web Developer (Sample)',
  'Andrew Yemen',
  'Sana\'a',
  'Sample job: Build and maintain website using PHP & MySQL. This listing is pre-approved for demo.',
  'hr@andrewyemen.local',
  'approved'
);
