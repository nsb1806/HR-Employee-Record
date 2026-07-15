-- HR Employee Record System Database
-- Applications Development and Emerging Technologies Final Project
-- Database Name: hr_employee_record

CREATE DATABASE IF NOT EXISTS hr_employee_record;
USE hr_employee_record;
DROP TABLE IF EXISTS employees;
DROP TABLE IF EXISTS users;
-- =====================================================
-- USERS TABLE
-- This table is for the login/logout feature.
-- =====================================================

CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(50) NOT NULL,
    lname VARCHAR(50) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) DEFAULT 'Staff',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (fname, lname, username, email, password, role) VALUES
('System', 'Administrator', 'admin', 'admin@company.com', 'admin123', 'Admin'),
('Maria', 'Santos', 'hr01', 'maria.santos@company.com', 'hr123', 'HR Staff'),
('Juan', 'Dela Cruz', 'hr02', 'juan.delacruz@company.com', 'hr123', 'HR Staff'),
('Angela', 'Reyes', 'manager', 'angela.reyes@company.com', 'manager123', 'Manager'),
('Kevin', 'Garcia', 'staff', 'kevin.garcia@company.com', 'staff123', 'Staff');

-- =====================================================
-- EMPLOYEES TABLE
-- This table stores the employee records.
-- =====================================================

CREATE TABLE IF NOT EXISTS employees (
    employee_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    gender VARCHAR(10),
    birth_date DATE,
    department VARCHAR(50),
    position VARCHAR(70),
    salary DECIMAL(10,2),
    contact_number VARCHAR(20),
    email VARCHAR(100),
    address VARCHAR(255),
    date_hired DATE
);

INSERT INTO employees
(first_name, last_name, gender, birth_date, department, position, salary, contact_number, email, address, date_hired)
VALUES
('Andrei', 'Santos', 'Male', '1995-03-14', 'Human Resources', 'HR Assistant', 25000.00, '09171234501', 'andrei.santos@company.com', 'Quezon City', '2021-01-15'),
('Bianca', 'Reyes', 'Female', '1997-07-22', 'Human Resources', 'Recruitment Specialist', 30000.00, '09171234502', 'bianca.reyes@company.com', 'Manila City', '2020-05-10'),
('Carlo', 'Dela Cruz', 'Male', '1992-11-05', 'Information Technology', 'Web Developer', 38000.00, '09171234503', 'carlo.delacruz@company.com', 'Makati City', '2019-03-18'),
('Danica', 'Garcia', 'Female', '1998-01-30', 'Information Technology', 'System Support Specialist', 32000.00, '09171234504', 'danica.garcia@company.com', 'Taguig City', '2022-06-21'),
('Enrico', 'Villanueva', 'Male', '1990-09-12', 'Finance', 'Accountant', 35000.00, '09171234505', 'enrico.villanueva@company.com', 'Pasig City', '2018-09-03'),
('Francesca', 'Torres', 'Female', '1996-12-03', 'Finance', 'Payroll Officer', 33000.00, '09171234506', 'francesca.torres@company.com', 'Marikina City', '2021-04-19'),
('Gabriel', 'Ramos', 'Male', '1994-04-18', 'Marketing', 'Marketing Associate', 28000.00, '09171234507', 'gabriel.ramos@company.com', 'Caloocan City', '2020-02-11'),
('Hannah', 'Mendoza', 'Female', '1999-08-09', 'Marketing', 'Social Media Coordinator', 27000.00, '09171234508', 'hannah.mendoza@company.com', 'San Juan City', '2023-01-09'),
('Ivan', 'Cruz', 'Male', '1993-02-25', 'Operations', 'Operations Staff', 26000.00, '09171234509', 'ivan.cruz@company.com', 'Mandaluyong City', '2021-11-15'),
('Jasmine', 'Navarro', 'Female', '1995-06-17', 'Operations', 'Operations Supervisor', 42000.00, '09171234510', 'jasmine.navarro@company.com', 'Las Pinas City', '2018-12-01'),
('Kyle', 'Aquino', 'Male', '1998-10-21', 'Sales', 'Sales Representative', 29000.00, '09171234511', 'kyle.aquino@company.com', 'Paranaque City', '2022-02-14'),
('Louise', 'Castillo', 'Female', '1991-05-27', 'Sales', 'Sales Manager', 50000.00, '09171234512', 'louise.castillo@company.com', 'Valenzuela City', '2017-07-10'),
('Miguel', 'Bautista', 'Male', '1996-03-08', 'Customer Service', 'Customer Support Agent', 24000.00, '09171234513', 'miguel.bautista@company.com', 'Quezon City', '2022-09-05'),
('Nicole', 'Fernandez', 'Female', '1997-09-29', 'Customer Service', 'Customer Service Lead', 34000.00, '09171234514', 'nicole.fernandez@company.com', 'Manila City', '2020-10-12'),
('Oliver', 'Gonzales', 'Male', '1990-01-11', 'Administration', 'Admin Officer', 31000.00, '09171234515', 'oliver.gonzales@company.com', 'Makati City', '2019-08-20'),
('Patricia', 'Lopez', 'Female', '1993-07-04', 'Administration', 'Office Secretary', 26000.00, '09171234516', 'patricia.lopez@company.com', 'Taguig City', '2021-03-22'),
('Quincy', 'Mercado', 'Male', '1999-11-16', 'Information Technology', 'Junior Programmer', 30000.00, '09171234517', 'quincy.mercado@company.com', 'Pasig City', '2023-04-03'),
('Rhea', 'Domingo', 'Female', '1994-02-07', 'Information Technology', 'Database Assistant', 34000.00, '09171234518', 'rhea.domingo@company.com', 'Marikina City', '2020-06-08'),
('Samuel', 'Aguilar', 'Male', '1992-06-19', 'Finance', 'Budget Analyst', 39000.00, '09171234519', 'samuel.aguilar@company.com', 'Caloocan City', '2018-04-16'),
('Trisha', 'Morales', 'Female', '1996-10-02', 'Finance', 'Billing Assistant', 27000.00, '09171234520', 'trisha.morales@company.com', 'San Juan City', '2022-01-17'),
('Ulysses', 'Rivera', 'Male', '1989-12-24', 'Operations', 'Logistics Coordinator', 36000.00, '09171234521', 'ulysses.rivera@company.com', 'Mandaluyong City', '2017-11-06'),
('Vanessa', 'Flores', 'Female', '1995-08-15', 'Operations', 'Inventory Staff', 25000.00, '09171234522', 'vanessa.flores@company.com', 'Las Pinas City', '2021-07-26'),
('Warren', 'Santiago', 'Male', '1991-04-06', 'Sales', 'Account Executive', 37000.00, '09171234523', 'warren.santiago@company.com', 'Paranaque City', '2019-02-25'),
('Xandra', 'Perez', 'Female', '1998-05-13', 'Sales', 'Sales Coordinator', 28000.00, '09171234524', 'xandra.perez@company.com', 'Valenzuela City', '2022-03-30'),
('Yves', 'Marquez', 'Male', '1993-09-20', 'Marketing', 'Graphic Designer', 33000.00, '09171234525', 'yves.marquez@company.com', 'Quezon City', '2020-08-13'),
('Zara', 'Lim', 'Female', '1997-01-28', 'Marketing', 'Content Writer', 29000.00, '09171234526', 'zara.lim@company.com', 'Manila City', '2021-12-07'),
('Aaron', 'Tan', 'Male', '1994-07-31', 'Human Resources', 'Training Officer', 35000.00, '09171234527', 'aaron.tan@company.com', 'Makati City', '2019-05-14'),
('Beatrice', 'Sy', 'Female', '1992-03-23', 'Human Resources', 'Compensation Officer', 37000.00, '09171234528', 'beatrice.sy@company.com', 'Taguig City', '2018-06-18'),
('Cedric', 'Chua', 'Male', '1996-11-09', 'Administration', 'Records Clerk', 24000.00, '09171234529', 'cedric.chua@company.com', 'Pasig City', '2022-07-04'),
('Dianne', 'Ocampo', 'Female', '1995-04-26', 'Administration', 'Executive Assistant', 32000.00, '09171234530', 'dianne.ocampo@company.com', 'Marikina City', '2020-04-27'),
('Ethan', 'Panganiban', 'Male', '1990-08-01', 'Customer Service', 'Client Relations Officer', 36000.00, '09171234531', 'ethan.panganiban@company.com', 'Caloocan City', '2017-10-23'),
('Faith', 'Salazar', 'Female', '1999-12-11', 'Customer Service', 'Call Center Agent', 23000.00, '09171234532', 'faith.salazar@company.com', 'San Juan City', '2023-02-06'),
('Gino', 'Valdez', 'Male', '1993-06-05', 'Information Technology', 'Network Administrator', 45000.00, '09171234533', 'gino.valdez@company.com', 'Mandaluyong City', '2018-01-29'),
('Hazel', 'Soriano', 'Female', '1996-09-14', 'Information Technology', 'QA Tester', 33000.00, '09171234534', 'hazel.soriano@company.com', 'Las Pinas City', '2021-08-02'),
('Ian', 'Robles', 'Male', '1991-02-18', 'Finance', 'Financial Analyst', 44000.00, '09171234535', 'ian.robles@company.com', 'Paranaque City', '2019-09-16'),
('Janelle', 'Manalo', 'Female', '1997-10-07', 'Finance', 'Accounting Assistant', 26000.00, '09171234536', 'janelle.manalo@company.com', 'Valenzuela City', '2022-05-09'),
('Kristian', 'Padilla', 'Male', '1995-01-25', 'Operations', 'Warehouse Staff', 24000.00, '09171234537', 'kristian.padilla@company.com', 'Quezon City', '2021-06-01'),
('Lara', 'Espino', 'Female', '1994-12-19', 'Operations', 'Production Planner', 38000.00, '09171234538', 'lara.espino@company.com', 'Manila City', '2020-07-20'),
('Marco', 'De Leon', 'Male', '1988-05-02', 'Sales', 'Regional Sales Head', 58000.00, '09171234539', 'marco.deleon@company.com', 'Makati City', '2016-03-07'),
('Nina', 'Buenaventura', 'Female', '1998-03-12', 'Sales', 'Sales Assistant', 25000.00, '09171234540', 'nina.buenaventura@company.com', 'Taguig City', '2023-03-13'),
('Oscar', 'Velasco', 'Male', '1992-07-08', 'Marketing', 'Brand Specialist', 41000.00, '09171234541', 'oscar.velasco@company.com', 'Pasig City', '2019-11-25'),
('Paula', 'Estrada', 'Female', '1996-06-30', 'Marketing', 'Events Coordinator', 30000.00, '09171234542', 'paula.estrada@company.com', 'Marikina City', '2021-09-27'),
('Rafael', 'Lazaro', 'Male', '1990-10-10', 'Human Resources', 'HR Supervisor', 46000.00, '09171234543', 'rafael.lazaro@company.com', 'Caloocan City', '2018-02-12'),
('Sofia', 'Alvarez', 'Female', '1995-11-22', 'Human Resources', 'Employee Relations Officer', 36000.00, '09171234544', 'sofia.alvarez@company.com', 'San Juan City', '2020-01-06'),
('Theo', 'Rosales', 'Male', '1997-04-09', 'Administration', 'Admin Assistant', 24000.00, '09171234545', 'theo.rosales@company.com', 'Mandaluyong City', '2022-08-08'),
('Una', 'Francisco', 'Female', '1993-08-27', 'Administration', 'Facilities Coordinator', 34000.00, '09171234546', 'una.francisco@company.com', 'Las Pinas City', '2019-12-09'),
('Vince', 'Matias', 'Male', '1994-09-03', 'Customer Service', 'Support Specialist', 28000.00, '09171234547', 'vince.matias@company.com', 'Paranaque City', '2021-10-18'),
('Wendy', 'Cabrera', 'Female', '1999-02-14', 'Customer Service', 'Customer Care Associate', 24000.00, '09171234548', 'wendy.cabrera@company.com', 'Valenzuela City', '2023-05-15'),
('Xavier', 'Montemayor', 'Male', '1991-12-06', 'Information Technology', 'IT Project Coordinator', 47000.00, '09171234549', 'xavier.montemayor@company.com', 'Quezon City', '2018-10-01'),
('Yna', 'Del Rosario', 'Female', '1996-05-21', 'Finance', 'Tax Assistant', 31000.00, '09171234550', 'yna.delrosario@company.com', 'Manila City', '2021-05-24');
