<?php
include "admin-header.php";
include "Connection/connection.php";

// Edit employee record
if(isset($_GET['username'])) {
    $username = $_GET['username'];

    $result=mysqli_query($connection,"SELECT * FROM User WHERE Username='$username'");
    if(mysqli_num_rows($result)>0){
        $rowData=mysqli_fetch_all($result,MYSQLI_ASSOC);
    }
}
?>

<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Edit a User</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit a User</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form class="form-horizontal m-t-20" action="backend-php/modify-a-user.php" method="post">
                        <div class="row p-b-30">
                            <div class="col-10 align-items-center">
                                <!--Name-->
                                <div class="input-group mb-3">
                                    <label for="name" class="col-sm-2 text-right control-label col-form-label">Name</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input onkeypress="validate()" value="<?php echo $rowData[0]['Name'] ?>" name="Name" type="text" id="name" class="form-control form-control-lg required" placeholder="Name" aria-label="Name" aria-describedby="basic-addon1" readonly>
                                </div>
                                <!--Username-->
                                <div class="input-group mb-3">
                                    <label for="username" class="col-sm-2 text-right control-label col-form-label">Username</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" id="username" value="<?php echo $rowData[0]['Username'] ?>" name="Username" class="form-control form-control-lg" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" readonly>
                                </div>
                                <!--email-->
                                <!--                                <div class="input-group mb-3">-->
                                <!--                                    <label for="email" class="col-sm-2 text-right control-label col-form-label">Email Address</label>-->
                                <!--                                    <div class="input-group-prepend">-->
                                <!--                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>-->
                                <!--                                    </div>-->
                                <!--                                    <input type="text" id="email" name="email" class="form-control form-control-lg" placeholder="email" aria-label="email" aria-describedby="basic-addon1" required>-->
                                <!--                                </div>-->
                                <!--Designtion-->
                                <div class="input-group mb-3">
                                    <label for="designation" class="col-sm-2 text-right control-label col-form-label">Designation</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-danger text-white" id="basic-addon2"><i class="fas fa-shopping-bag"></i></span>
                                    </div>
                                    <input type="text" id="designation" value="<?php echo $rowData[0]['Designation'] ?>" name="Designation" class="form-control form-control-lg" readonly>
                                    <!--                                    <input onkeypress="validate()" name="Designation" type="text" id="designation" class="form-control form-control-lg" placeholder="Designation" aria-label="Designation" aria-describedby="basic-addon1" required>-->
                                </div>
                                <!--Password-->
                                <div class="input-group mb-3">
                                    <label for="password" class="col-sm-2 text-right control-label col-form-label">Password</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon3"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="text" name="Password" id="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" onchange="validate()" aria-describedby="basic-addon1" required>
                                </div>
                                <div class="input-group mb-3">
                                    <label for="confirm_password" class="col-sm-2 text-right control-label col-form-label">Confirm Password</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-info text-white" id="basic-addon4"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="text"  name="confirm_Password" onchange="validate()" id="confirm_password" class="form-control form-control-lg" placeholder=" Confirm Password" aria-label="Password" onchange="validate()" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>
                        <!--            <div class="row border-top border-secondary">-->
                        <!--                <div class="col-9 ">-->
                        <!--                    <div class="form-group">-->
                        <!--                        <div class="p-t-20">-->
                        <!--                            <button class="btn btn-block btn-lg btn-info" type="submit">Add a New User</button>-->
                        <!--                        </div>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <div class="border-top col-12">
                            <div class="card-body" style="float:right;">
                                <button type="submit" id="btnUpdate" name="update" class="btn btn-primary" style="float:right;">Save Changes</button>
                            </div>
                        </div>
                    </form>
                    <script>
                        function validate() {

                            //validate email
                            $email = test_input($_POST["email"]);
                            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                $emailErr = "Invalid email format";
                            }

                            //Validate the Name and Designation input
                            $("#name,#designation").keydown(function (e) {
                                // console.log(e.keyCode);
                                // Allow: delete,backspace,tab, escape, enter
                                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
                                    // Allow: Ctrl/cmd+A
                                    (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                                    // Allow: Ctrl/cmd+C
                                    (e.keyCode === 67 && (e.ctrlKey === true || e.metaKey === true)) ||
                                    // Allow: Ctrl/cmd+X
                                    (e.keyCode === 88 && (e.ctrlKey === true || e.metaKey === true)) ||
                                    // Allow: home, end, left, right
                                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                                    // let it happen, don't do anything
                                    return;
                                }
                                // Disable: 0 to 9
                                if ((e.keyCode >= 48 && e.keyCode <= 57) ||
                                    //Disable: Number keypad
                                    (e.keyCode >= 96 && e.keyCode <= 105) ||
                                    //Disable: Arithmetic operation in number pad
                                    (e.keyCode >= 106 && e.keyCode <= 111) ||
                                    //Disable: Special characters (<>?:"{}|~`,./;'[]\)
                                    (e.keyCode >= 186 && e.keyCode <= 231)) {
                                    e.preventDefault();
                                }
                            });

                            //Check the password is matching or not
                            const password = document.querySelector('input[name=Password]');
                            const confirm = document.querySelector('input[name=confirm_Password]');
                            if (confirm.value === password.value) {
                                confirm.setCustomValidity('');
                            } else {
                                document.getElementById('confirm_password').select();
                                confirm.setCustomValidity('Passwords do not match');
                            }
                        }




                    </script>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

</script>

<?php include "footer.php"?>
