<?php

require 'Common/header.php';

?>
<section class="d-flex-c container">
    <h1> Employee List </h1>

    <div class="success">
        <?php if (isset($_SESSION['success'])) {
            echo $_SESSION['success'];
            unset($_SESSION['success']);
        }
        ?>
    </div>

    <table>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone no.</th>
            <th>Gender</th>
            <th>Birthdate</th>
            <th>Qualification</th>
            <th>Action</th>
        </tr>
        <?php if ($data['employee']) : ?>
            <?php foreach ($data['employee'] as $row) : ?>
                <tr>
                    <td> <?php echo $row['eid']; ?> </td>
                    <td> <?php echo ucfirst($row['first_name']) . " " . ucfirst($row['last_name']); ?> </td>
                    <td> <a href="mailto:<?php echo $row['email']; ?>" class="email"><?php echo $row['email']; ?></a> </td>
                    <td> <?php echo $row['phone']; ?> </td>
                    <td> <?php echo ucfirst($row['gender']); ?> </td>
                    <td>
                        <?php
                        $date = date_create($row['birthdate']);
                        echo date_format($date, "d-m-Y");
                        ?>
                    </td>
                    <td> <?php echo $row['qualification']; ?></td>
                    <td>
                        <a href="/view?eid=<?php echo $row['eid']; ?>">View</a>
                        <a href="/edit?eid=<?php echo $row['eid']; ?>">Edit</a>
                        <a href="javascript:displayConfirmBox(<?php echo $row['eid']; ?>)"> Delete </a>
                    </td>
                </tr>
                <?php require 'confirm_box.php'; ?>

            <?php endforeach; ?>
        <?php endif; ?>

    </table>
</section>

<?php
require 'pagination.php';
require 'Common/footer.php';
?>