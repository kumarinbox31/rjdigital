<?php
require_once 'includes/header.php';
?>
    <div class="container">
        <div class="col-md-6 col-md-offset-3">
            <div class="box box-danger">
                <div class="box-header">
                    <h3>Winner Certificate</h3>
                </div>
                <div class="box-body">
                    <form action="winner-certificate.php" method="get">
                        <div class="form-group">
                            <label>Enrollment No.</label>
                            <input type="text" class="form-control" name="enrollment_no" placeholder="Enter Certificate No." required/>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
require_once 'includes/footer.php';
?>
