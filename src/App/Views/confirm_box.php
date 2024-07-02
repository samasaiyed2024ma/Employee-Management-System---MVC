<section class="confirm-box" id="confirm-box">
    <div class="confirm">
        <div class="title d-flex-r">
            <span> Delete Employee </span>
            <a href="" id="box" onclick="displayConfirmBox()" class="close"> &times; </a>
        </div>
        <hr>
        <div class="confirmation">
            <p> Are you sure you want to delete employee? </p>
        </div>
        <hr>
        <div class="delete-form">
            <form action="/delete" method="post" name="delete-form">
                <input type="hidden" id="eid" name="eid">

                <div class="button d-flex-r">
                    <a href="" id="box" onclick="displayConfirmBox()"> No </a>
                    <input type="submit" value="Yes" id="delete" class="delete-btn">
                </div>
            </form>
        </div>
    </div>
</section>