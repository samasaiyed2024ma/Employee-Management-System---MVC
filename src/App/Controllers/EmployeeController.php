<?php

namespace Ems\Controllers;

use DateTime;
use Ems\Models\Employee;
use Ems\Controller;

class EmployeeController extends Controller
{
    private $model;
    private $validate;

    public function __construct()
    {
        $this->model = new Employee();
    }

    /**
     * @return error[] message when field is empty or invalid input value is written
     */
    private function validate(array $data): array
    {
        $errors = [];

        $firstname = $data['firstname'];
        $lastname = $data['lastname'];
        $email = $data['email'];
        $phone = $data['phone'];
        $birthdate = $data['birthdate'];
        $about = $data['about'];
        $gender = isset($data['gender']) ? ucfirst($data['gender']) : '';
        $qualification = isset($data['qualification']) ? implode(", ", $data['qualification']) : '';
        $filename = $data['image']['name'];
        $image_extension = !empty($filename) ? pathinfo($filename, PATHINFO_EXTENSION) : '';
        $allowed_extension = ['jpg', 'jpeg', 'png'];

        //firstname validation
        if (empty($firstname)) {
            $errors['firstname'] = "First name is required*";
        } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $firstname)) {
            $errors['firstname'] = "First name must contains characters and white space only*";
        }

        //lastname validation
        if (empty($lastname)) {
            $errors['lastname'] = "Last name is required*";
        } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $lastname)) {
            $errors['lastname'] = "Last name must contains characters and white space only*";
        }

        //email validation
        if (empty($email)) {
            $errors['email'] = "E-mail is required*";
        } elseif (!filter_var($email,  FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid E-mail address*";
            var_dump($email);
        }

        //phone validation
        if (empty($phone)) {
            $errors['phone'] = "Phone number is required*";
        } elseif (!preg_match("/^[0-9]{10}+$/", $phone)) {
            $errors['phone'] = "Phone number must be 10 digits*";
        }

        //gender validation
        if (empty($gender)) {
            $errors['gender'] = "Please select gender*";
        }

        //qualification validation
        if (empty($qualification)) {
            $errors['qualification'] = "Please select qualification*";
        }

        //birthdate validation
        $current_date = date_create();
        $format_date = date_format($current_date, 'Y-m-d');
        if (empty($birthdate)) {
            $errors['birthdate'] = "Birthdate is required*";
        } elseif ($birthdate > $format_date) {
            $errors['birthdate'] = 'Birthdate cannot be in future*';
        }

        // image validation
        if (!empty($filename) && !in_array($image_extension, $allowed_extension)) {
            $errors['image'] =  'Only jpg, jpeg and png files are allowed.';
        }

        return $errors;
    }

    /**
     * @return dashboard page(home page) 
     * with
     * all employeee records 
     * total numbers of pages and current page
     */
    public function index(): void
    {
        $this->model->getAllRecords();
        $employee = $this->model->getLimitedData();
        $current_page = $this->model->current_page();
        $total_pages = $this->model->getPaginationNumber();

        $data = [
            'employee' => $employee,
            'total_pages' => $total_pages,
            'current_page' => $current_page
        ];
        $this->render('dashboard', $data);
    }

    /**
     * @return view page with employee details according employee id
     */
    public function view(): void
    {
        $eid = $_GET['eid'];
        $employee = $this->model->getRecordById($eid);
        $data = [
            'row' => $employee,
        ];
        $this->render('view_employee', $data);
    }

    /**
     * @return form for storing employee data
     */
    public function add(): void
    {
        $this->render('add_emp_data');
    }

    /**
     * store employee data in database 
     */
    public function store(): void
    {
        $input = $_POST;

        $filename = $_FILES['image']['name'];
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "./images/" . $_FILES['image']['name'];

        $errors = $this->validate(array_merge($input, ['image' => $_FILES['image']]));

        if (count($errors) > 0) {
            $_SESSION['errors'] = $errors;
            $_SESSION['input'] = $input;
            header('Location: /create');
            exit();
        } else {
            $data = [
                'firstname' => $input['firstname'],
                'lastname' => $input['lastname'],
                'email' => $input['email'],
                'phone' => $input['phone'],
                'gender' => $input['gender'],
                'birthdate' => $input['birthdate'],
                'qualification' => implode(', ', $input['qualification']),
                'image' => $filename,
                'about_emp' => $input['about']
            ];

            move_uploaded_file($tempname, $folder);
            $save = $this->model->insertData($data);


            if (!$save) {
                $this->redirect('create');
            }
            $_SESSION['success'] = 'Data saved successfully';
            $this->redirect('dashboard');
        }
    }

    /**
     * delete employeee data and redirect to dashboard page
     */
    public function delete(): void
    {
        $eid = $_POST['eid'];

        $this->model->deleteData($eid);
        $employee = $this->model->getAllRecords();
        $data = [
            'employee' => $employee
        ];

        $_SESSION['success'] = 'Record deleted successfully';
        $this->redirect('dashboard');
    }

    /**
     * @return form for update data
     */
    public function edit(): void
    {
        $eid = $_GET['eid'];
        $employee = $this->model->getRecordById($eid);
        $data = [
            'row' => $employee,
        ];
        $this->render('edit_emp_data', $data);
    }

    /**
     * update data in database
     */
    public function update(): void
    {
        $eid = $_POST['eid'];
        $input = $_POST;

        $filename = $_FILES['image']['name'];
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "./images/" . $_FILES['image']['name'];

        $errors = $this->validate(array_merge($input, ['image' => $_FILES['image']]));

        if (empty($filename)) {
            $filename = $input['old_image'];
        }

        if (count($errors) > 0) {
            $_SESSION['errors'] = $errors;
            $_SESSION['input'] = $input;
            header('Location: /edit?eid=' . $eid);
            exit();
        } else {
            $data = [
                'eid' => $eid,
                'firstname' => $input['firstname'],
                'lastname' => $input['lastname'],
                'email' => $input['email'],
                'phone' => $input['phone'],
                'gender' => $input['gender'],
                'birthdate' => $input['birthdate'],
                'qualification' => implode(', ', $input['qualification']),
                'image' => $filename,
                'about_emp' => $input['about']
            ];

            move_uploaded_file($tempname, $folder);
            $update = $this->model->updateData($data);

            if (!$update) {
                $this->redirect('edit?eid=' . $eid);
            }

            $_SESSION['success'] = 'Data updated successfully';
            $this->redirect('dashboard');
        }
    }
}
