<?php
require 'Common/header.php';

if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
}
if (isset($_SESSION['input'])) {
    $input = $_SESSION['input'];
}
?>

<section class="d-flex-c">
    <h1> Add Employee Details </h1>

    <form action="/store" name="add_emp" class="add_emp" method="post" enctype="multipart/form-data">

        <div class="d-flex-r">
            <div>
                <input type="text" class="firstname" name="firstname" placeholder="First Name*" value="<?php echo isset($input['firstname']) ? $input['firstname'] : ''; ?>">
                <span class="error">
                    <?php echo isset($errors['firstname']) ? $errors['firstname']  : ''; ?>
                </span>
            </div>
            <div>
                <input type="text" class="lname" name="lastname" placeholder="Last Name*" value="<?php echo isset($input['lastname']) ? $input['lastname'] : ''; ?>">
                <span class="error">
                    <?php echo isset($errors['lastname']) ? $errors['lastname']  : ''; ?>
                </span>
            </div>
        </div>

        <div class="d-flex-r">
            <div>
                <input type="text" class="email" name="email" placeholder="Email*" value="<?php echo isset($input['email']) ? $input['email'] : '';  ?>">
                <span class="error">
                    <?php echo isset($errors['email']) ? $errors['email']  : ''; ?>
                </span>
            </div>
            <div>
                <input type="text" class="phone" name="phone" placeholder="Phone*" value="<?php echo isset($input['phone']) ? $input['phone'] : '';  ?>">
                <span class="error">
                    <?php echo isset($errors['phone']) ? $errors['phone']  : ''; ?>
                </span>
            </div>
        </div>

        <div class="d-flex-r">
            <div>
                <span> Gender* </span>
                <input type="radio" name="gender" id="male" value="male" <?php if (isset($input['gender']) == 'male') {
                                                                                echo 'checked';
                                                                            } ?> /> <label for="male">Male</label>
                <input type="radio" name="gender" id="female" value="female" <?php if (isset($input['gender']) == 'female') {
                                                                                    echo 'checked';
                                                                                } ?> /> <label for="female">Female</label>
                <span class="error">
                    <?php echo isset($errors['gender']) ? $errors['gender']  : ''; ?>
                </span>
            </div>
            <div>
                <input type="text" class="birthdate" name="birthdate" placeholder="Birthdate*" onfocus="(this.type='date')" value="<?php echo isset($input['birthdate']) ? $input['birthdate'] : ''; ?>">
                <span class="error">
                    <?php echo isset($errors['birthdate']) ? $errors['birthdate']  : ''; ?>
                </span>
            </div>
        </div>

        <div class="d-flex-c">
            <span>Qualifications*</span>
            <div>
                <?php $qualifications = ['B-Tech', 'M-Tech', 'BE-IT', 'BE-CS&E', 'ME-IT', 'ME-CS&E', 'BCA', 'MCA', 'BSc-IT', 'MSc-IT'] ?>

                <?php foreach ($qualifications as $qualification) : ?>
                    <input type="checkbox" name="qualification[]" id="<?php echo $qualification; ?>" value="<?php echo $qualification; ?>">
                    <label for="<?php echo $qualification; ?>"> <?php echo $qualification; ?></label>
                <?php endforeach; ?>
            </div>
            <span class="error">
                <?php echo isset($errors['qualification']) ? $errors['qualification']  : ''; ?>
            </span>
        </div>

        <div class="d-flex-c">
            <span>Upload Photo*</span>
            <input type="file" name="image" id="image">
            <span class="error">
                <?php echo isset($errors['image']) ? $errors['image']  : ''; ?>
            </span>
        </div>

        <div>
            <textarea name="about" id="about" placeholder="About Employee"><?php echo isset($input['about']) ? $input['about'] : '';  ?></textarea>
        </div>

        <div class="d-flex-r">
            <input type="submit" name="submit-btn" value="Submit" class="btn-blue">
            <input type="button" name="back-btn" value="< Back" class="btn-purple" onclick="javascript:history.go(-1)">
        </div>

    </form>
</section>

<?php require 'Common/footer.php';

unset($_SESSION['errors']);
unset($_SESSION['input']);

?>