<?php
require 'Common/header.php';

if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
}

?>
<section class="d-flex-c">
    <h1> Edit Employee Details </h1>

    <?php if (isset($_GET['eid'])) : ?>

        <form action="/update" name="edit_emp" class="edit_emp" method="post" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $row['eid']; ?>" name="eid">
            <span class="error">
                <?php echo isset($errors['update_error']) ? $errors['update_error']  : ''; ?>
            </span>
            <div class="d-flex-r">
                <div>
                    <input type="text" class="text" name="firstname" placeholder="First Name*" value="<?php echo isset($row['first_name']) ? $row['first_name'] : ''; ?>">
                    <span class="error">
                        <?php echo isset($errors['firstname']) ? $errors['firstname']  : ''; ?>
                    </span>
                </div>
                <div>
                    <input type="text" class="text" name="lastname" placeholder="Last Name*" value="<?php echo $row['last_name']; ?>">
                    <span class="error">
                        <?php echo isset($errors['lastname']) ? $errors['lastname']  : ''; ?>
                    </span>
                </div>
            </div>
            <div class="d-flex-r">
                <div>
                    <input type="text" class="text" name="email" placeholder="Email*" value="<?php echo $row['email']; ?>">
                    <span class="error">
                        <?php echo isset($errors['email']) ? $errors['email']  : ''; ?>
                    </span>

                </div>
                <div>
                    <input type="text" class="text" name="phone" placeholder="Phone*" value="<?php echo $row['phone']; ?>">
                    <span class="error">
                        <?php echo isset($errors['phone']) ? $errors['phone']  : ''; ?>
                    </span>
                </div>
            </div>
            <div class="d-flex-r">
                <div>
                    <span> Gender* </span>
                    <input type="radio" name="gender" id="male" value="male" <?php if ($row['gender'] == 'male') {
                                                                                    echo 'checked';
                                                                                } ?> /> <label for="male">Male</label>
                    <input type="radio" name="gender" id="female" value="female" <?php if ($row['gender'] == 'female') {
                                                                                        echo 'checked';
                                                                                    } ?> /> <label for="female">Female</label>
                    <span class="error">
                        <?php echo isset($errors['gender']) ? $errors['gender']  : ''; ?>
                    </span>
                </div>
                <div>
                    <input type="text" class="text" name="birthdate" placeholder="Birthdate*" onfocus="(this.type='date')" value="<?php echo $row['birthdate']; ?>">
                    <span class="error">
                        <?php echo isset($errors['birthdate']) ? $errors['birthdate']  : ''; ?>
                    </span>
                </div>
            </div>
            <div class="d-flex-c">
                <span>Qualification*</span>
                <div>
                    <?php $qualification = explode(", ", $row['qualification']) ?>

                    <input type="checkbox" name="qualification[]" id="B-Tech" value="B-Tech" <?php if (in_array('B-Tech', $qualification)) {
                                                                                                    echo 'checked';
                                                                                                } ?>> <label for="B-Tech"> B-Tech </label>
                    <input type="checkbox" name="qualification[]" id="M-Tech" value="M-Tech" <?php if (in_array('M-Tech', $qualification)) {
                                                                                                    echo 'checked';
                                                                                                } ?>> <label for="M-Tech"> M-Tech </label>
                    <input type="checkbox" name="qualification[]" id="BE-IT" value="BE-IT" <?php if (in_array('BE-IT', $qualification)) {
                                                                                                echo 'checked';
                                                                                            } ?>> <label for="BE-IT"> BE-IT </label>
                    <input type="checkbox" name="qualification[]" id="BE-CS&E" value="BE-CS&E" <?php if (in_array('BE-CS&E', $qualification)) {
                                                                                                    echo 'checked';
                                                                                                } ?>> <label for="BE-CS&E"> BE-CS&E </label>
                    <input type="checkbox" name="qualification[]" id="ME-IT" value="ME-IT" <?php if (in_array('ME-IT', $qualification)) {
                                                                                                echo 'checked';
                                                                                            } ?>> <label for="ME-IT"> ME-IT </label>
                    <input type="checkbox" name="qualification[]" id="ME-CS&E" value="ME-CS&E" <?php if (in_array('ME-CS&E', $qualification)) {
                                                                                                    echo 'checked';
                                                                                                } ?>> <label for="ME-CS&E"> ME-CS&E </label>
                    <input type="checkbox" name="qualification[]" id="BCA" value="BCA" <?php if (in_array('BCA', $qualification)) {
                                                                                            echo 'checked';
                                                                                        } ?>> <label for="BCA"> BCA </label>
                    <input type="checkbox" name="qualification[]" id="MCA" value="MCA" <?php if (in_array('MCA', $qualification)) {
                                                                                            echo 'checked';
                                                                                        } ?>> <label for="MCA"> MCA </label>
                    <input type="checkbox" name="qualification[]" id="BSc-IT" value="BSc-IT" <?php if (in_array('BSc-IT', $qualification)) {
                                                                                                    echo 'checked';
                                                                                                } ?>> <label for="BSc-IT"> BSc-IT </label>
                    <input type="checkbox" name="qualification[]" id="MSc-IT" value="MSc-IT" <?php if (in_array('MSc-IT', $qualification)) {
                                                                                                    echo 'checked';
                                                                                                } ?>> <label for="MSc-IT"> MSc-IT </label>
                </div>
            </div>
            <div class="d-flex-c">
                <span>Upload Photo*</span>
                <input type="hidden" name="old_image" value="<?php echo $row['image']; ?>">
                <div class="d-flex-r">
                    <input type="file" name="image" id="image">
                    <img src="images/<?php echo $row['image']; ?>" style="border-radius:50%; height:70px; width:70px; object-fit:cover;" />
                </div>
                <span class="error">
                    <?php echo isset($errors['image']) ? $errors['image']  : ''; ?>
                </span>
            </div>
            <div>
                <textarea name="about" id="about_emp" placeholder="About Employee"> <?php echo $row['about_emp']; ?> </textarea>
            </div>
            <div class="d-flex-r">
                <input type="submit" value="Update" class="btn-blue">
                <input type="button" value="< Back" onclick="javascript:history.go(-1)" class="btn-purple">
            </div>
        </form>
    <?php endif; ?>
</section>

<?php
require 'Common/footer.php';
unset($_SESSION['errors']);
?>