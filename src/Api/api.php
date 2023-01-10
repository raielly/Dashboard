<?php

include('db.php');

if (isset($_SERVER['HTTP_ORIGIN'])) {
    // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
    // you want to allow, and if so:
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 1000');
}
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
        // may also be using PUT, PATCH, HEAD etc
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
    }

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
        header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization");
    }
    exit(0);
}

$res = array();
$action = '';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
}


// login user
if ($action == 'login') {

    $firstName = $_POST['firstName'];
    $type = $_POST['type'];

    if ($type == 0) {

        $sql = "SELECT * FROM users WHERE firstName='Raiel' AND type=0 ";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
        $userLogin = array();
        if ($count == 1) {
            $res['userLogin'] = $row;
        } else {
            $res['error'] = false;
            $res['message'] = "No Data Found!";
        }
    } else {
        $sql = "SELECT * FROM users WHERE firstName='Raiel' AND type=1 ";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
        $userLogin = array();
        if ($count == 1) {
            $res['userLogin'] = $row;
        } else {
            $res['error'] = false;
            $res['message'] = "No Data Found!";
        }
    }
}

// add new user
if ($action == 'adduser') {

    // $data = json_decode(file_get_contents("php://input"), TRUE);
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $type = $_POST['type'];

    $sql = "INSERT INTO users (firstName, lastName, type, dateCreated) VALUES ( '" . $firstName . "', '" . $lastName . "', '" . $type . "', now())";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if ($result) {
        $res['message'] = "Writer Successfully Added";
    }
}

// edit user
if ($action == 'edituser') {

    // $data = json_decode(file_get_contents("php://input"), TRUE);
    $id = $_POST['id'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $type = $_POST['type'];
    $status = $_POST['status'];

    $sql = "UPDATE users SET firstName='" . $firstName . "', lastName='" . $lastName . "', status='" . $status . "' WHERE id='" . $id . "' ";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if ($result) {
        $res['message'] = "Writer Successfully Updated";
    }
}

// display user
if ($action == 'userdata') {
    $sql = "SELECT * FROM users ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    $userData = array();
    if ($num > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($userData, $row);
        }
        $res['userData'] = $userData;
    } else {
        $res['error'] = false;
        $res['message'] = "No Data Found!";
    }
}

// display company
if ($action == 'companydata') {
    $sql = "SELECT * FROM company ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    $companyData = array();
    if ($num > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($companyData, $row);
        }
        $res['companyData'] = $companyData;
    } else {
        $res['error'] = false;
        $res['message'] = "No Data Found!";
    }
}

// add new company
if ($action == 'addcompany') {

    // $data = json_decode(file_get_contents("php://input"), TRUE);
    $name = $_POST['name'];
    $status = $_POST['status'];

    $image_name = $_FILES['logo']['name'];
    $valid_extensions = array("jpg", "jpeg", "png");
    $extension = pathinfo($image_name, PATHINFO_EXTENSION);
    if (in_array($extension, $valid_extensions)) {
        $upload_path = 'upload/' . time() . '.' . $extension;
        if (move_uploaded_file($_FILES['logo']['tmp_name'], $upload_path)) {
            $res['message'] = 'Image Uploaded';
            $res['img'] = $upload_path;
        } else {
            $res['message'] = 'There is an error while uploading image';
        }
    } else {
        $res['message'] = 'Only .jpg, .jpeg and .png Image allowed to upload';
    }


    $sql = "INSERT INTO company (logo, name, status, dateCreated) VALUES ( '" . $upload_path . "', '" . $name . "', '" . $status . "', now())";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if ($result) {
        $res['message'] = "Company Successfully Added";
    }
}

// edit company
if ($action == 'editcompany') {

    // $data = json_decode(file_get_contents("php://input"), TRUE);
    $id = $_POST['id'];
    $logo = $_FILES['logo'];
    $name = $_POST['name'];
    $status = $_POST['status'];

    $image_name = $_FILES['logo']['name'];
    $valid_extensions = array("jpg", "jpeg", "png");
    $extension = pathinfo($image_name, PATHINFO_EXTENSION);
    if (in_array($extension, $valid_extensions)) {
        $upload_path = 'upload/' . time() . '.' . $extension;
        if (move_uploaded_file($_FILES['logo']['tmp_name'], $upload_path)) {
            $res['message'] = 'Image Uploaded';
            $res['img'] = $upload_path;
        } else {
            $res['message'] = 'There is an error while uploading image';
        }
    } else {
        $res['message'] = 'Only .jpg, .jpeg and .png Image allowed to upload';
    }

    $sql = "UPDATE company SET logo='" . $upload_path . "', name='" . $name . "', status='" . $status . "' WHERE id='" . $id . "' ";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if ($result) {
        $res['message'] = "Company Successfully Updated";
    }
}



// add article
if ($action == 'addpost') {

    // $data = json_decode(file_get_contents("php://input"), TRUE);
    $title = $_POST['title'];
    $link = $_POST['link'];
    $content = $_POST['content'];
    $forEdit = $_POST['forEdit'];
    $publish = $_POST['publish'];
    $writer = $_POST['writer'];
    $editor = $_POST['editor'];
    $company = $_POST['company'];

    $sql = "INSERT INTO `article`(`title`, `link`, `content`, `date`, `forEdit`, `publish`, `writer`, `editor`, `company`) VALUES ('" . $title . "','" . $link . "', '" . $content . "', now(), '" . $forEdit . "', '" . $publish . "', '" . $writer . "', '" . $editor . "', '" . $company . "')";

    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if ($result) {
        $res['message'] = "Writer Successfully Added";
    } else {
        $res['error'] = false;
        $res['message'] = "No Data Found!";
    }
}

// update article
if ($action == 'updatearticle') {

    // $data = json_decode(file_get_contents("php://input"), TRUE);
    $id = $_POST['id'];
    $title = $_POST['title'];
    $link = $_POST['link'];
    $content = $_POST['content'];
    $forEdit = $_POST['forEdit'];
    $publish = $_POST['publish'];
    $writer = $_POST['writer'];
    $editor = $_POST['editor'];
    $company = $_POST['company'];

    $sql = "UPDATE `article` SET `title`='$title',`link`='$link',`content`='$content',`forEdit`='$forEdit',`publish`='$publish',`writer`='$writer',`editor`='$editor',`company`='$company' WHERE `id` = '$id'";

    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if ($result) {
        $res['message'] = "Article Successfully updated";
    } else {
        $res['error'] = false;
        $res['message'] = "No Data Found!";
    }
}

// get article 
if ($action == 'article') {
    $sql = "SELECT article.id, article.title, article.link, article.content, article.date, article.forEdit, article.publish, article.writer, article.editor, article.company, company.name AS 'companyName', users.firstName, users.lastName FROM `article` LEFT JOIN company ON article.company = company.id LEFT JOIN users ON article.writer = users.id ORDER BY article.id DESC";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    $articleData = array();
    if ($num > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($articleData, $row);
        }
        $res['articleData'] = $articleData;
    } else {
        $res['error'] = false;
        $res['message'] = "No Data Found!";
    }
}


$conn->close();
header("Content-type: application/json");

echo json_encode($res);
die();
