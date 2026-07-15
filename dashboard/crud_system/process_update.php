<?php
    require_once '../../db.php';
    session_start();
    if (!isset($_SESSION['user_id'])) { header("Location: ../../index.php"); exit; }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = (int) ($_POST['id'] ?? 0);
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

        $stmt = $conn->prepare("UPDATE employees SET first_name=?, last_name=?, gender=?, birth_date=?, department=?, `position`=?, salary=?, email=?, contact_number=?, address=?, date_hired=? WHERE employee_id=?");
        $stmt->bind_param("ssssssdssssi",
            $firstname,
            $lastname,
            $gender,
            $birthDate,
            $department,
            $position,
            $salary,
            $email,
            $contact,
            $address,
            $dateHired,
            $id
        );

        $stmt->execute();
        header("Location: ../profile.php?id=" . $id . "&status=updated");
        exit;
    }
?>
