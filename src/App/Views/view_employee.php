<?php
require 'Common/header.php';
?>

<section class="d-flex-c view-emp">
    <h1>View Employee Detail</h1>
    <div class="d-flex-r emp-detail">

        <?php if (isset($_GET['eid'])) : ?>
            <div class="image">
                <img src="/images/<?php echo $row['image']; ?>" alt="<?php ?>" srcset="">
            </div>
            <div class="d-flex-c detail">
                <span class="name"> <?php echo $row['first_name'] . " " . $row['last_name']; ?> </span>
                <span> <?php echo $row['qualification']; ?> </span> <br>
                <span> Birthdate:
                    <?php
                    $date = date_create($row['birthdate']);
                    echo date_format($date, "d-m-Y");
                    ?>
                </span>
                <span> Email: <?php echo $row['email']; ?> </span>
                <span> Phone: <?php echo $row['phone']; ?> </span>
                <div class="d-flex-r">
                    <a href="/edit?eid=<?php echo $row['eid']; ?>"><input type="button" name="edit" value="Edit" class="btn-blue"></a>
                    <input type="button" name="back" value="< Back" class="btn-purple" onclick="javascript:history.go(-1)">
                </div>
            </div>
    </div>

<?php endif; ?>
</section>
<?php require 'Common/footer.php'; ?>