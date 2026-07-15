<?php
    require_once '../../db.php';
    session_start();
    if (!isset($_SESSION['user_id'])) { header("Location: ../../index.php"); exit; }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $firstname = trim($_POST['firstname'] ?? '');
        $lastname = trim($_POST['lastname'] ?? '');
        $gender = trim($_POST['gender'] ?? '');
        $birthDate = ($_POST['birth_date'] ?? '') !== '' ? $_POST['birth_date'] : null;
        $department = trim($_POST['department'] ?? '');
        $position = trim($_POST['position'] ?? '');
        $salary = ($_POST['salary'] ?? '') !== '' ? (float) $_POST['salary'] : null;
        $email = trim($_POST['email'] ?? '');
        $contact = trim($_POST['contact'] ?? '');
        $address = trim($_POST['address'] ?? '');
        $dateHired = ($_POST['date'] ?? '') !== '' ? $_POST['date'] : null;

        $stmt = $conn->prepare("INSERT INTO employees (first_name, last_name, gender, birth_date, department, `position`, salary, email, contact_number, address, date_hired) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssdssss",
            $firstname, $lastname, $gender, $birthDate,
            $department, $position, $salary, $email,
            $contact, $address, $dateHired
        );
        $stmt->execute();
        header("Location: ../records.php?status=added");
        exit;
    }
?>
