<?php
session_start();
// Redirect the user to login page if he is not logged in.
if(!isset($_SESSION['loggedIn'])){
    header('Location: login.php');
    exit();
}

require_once('inc/config/constants.php');
require_once('inc/config/db.php');
require_once('inc/header.html');
?>
<html>
<head>
    <style>
        .card {
            /* Add shadows to create the "card" effect */
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            border-radius: 12px;
            height: fit-content;
            width: fit-content;
        }

        /* On mouse-over, add a deeper shadow */
        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }




        /* Add rounded corners to the top left and the top right corner of the image */
        img {
            border-radius: 5px 5px 0 0;
        }

        .fitcenter{
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            border-radius: 12px;
            height: fit-content;
            width: fit-content;
        }
    </style>
</head>

<body style="background-image: url('./assets/images/invent.jpg');background-repeat:no-repeat;">
<?php
require 'inc/navigation.php';
?>
<!-- Page Content -->

<div style="width:420px; margin:0 auto; text-align: center;">
    <div class="card">
        <div class="container">
            <div class="wrap-login100 p-t-85 p-b-20">
                <div class="login100-form validate-form">

                    <div style="text-align: center;">
                        <img src="assets/images/owner.png" alt="AVATAR" style="height: 150px; width: 150px; margin-top: 10px;">
                    </div>
                    <br>

                    <span class="login100-form-title p-b-1">
                         <label class="fa fa-check-circle" style="color: black; font-size: 30px; font-weight: bold;"> KWIMS</label>
                        <br>
            <label class="fa fa-check-circle" style="color: blue; font-size: 23px; font-weight: bold;"> Kabianga Warehouse Inventory Management System</label>
          </span>
                    <br>
                    <label class="container-login100-form-btn"><b style="color: red; font-weight: bold;">Check Inventory Reports</b></label>


                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2">
                    <h1 class="my-4"></h1>
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link" id="v-pills-reports-tab" data-toggle="pill" href="#v-pills-reports" role="tab" aria-controls="v-pills-reports" aria-selected="false"><button class="btn btn-success">Click Here For Reports</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="margin-left: 200px;">
                <div class="tab-pane fade" id="v-pills-reports" role="tabpanel" aria-labelledby="v-pills-reports-tab">
                    <div class="card card-outline-secondary my-4">
                        <div class="card-header"><label style="font-weight: bold;">Inventory Reports</label><button id="reportsTablesRefresh" name="reportsTablesRefresh" class="btn btn-warning float-right btn-sm">Refresh</button></div>
                        <div class="card-body">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#itemReportsTab">Product</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#customerReportsTab">Customer</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#saleReportsTab">Dispatch</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#purchaseReportsTab">Request</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#vendorReportsTab">Manufacturer</a>
                                </li>
                            </ul>

                            <!-- Tab panes for reports sections -->
                            <div class="tab-content">
                                <div id="itemReportsTab" class="container-fluid tab-pane active">
                                    <br>
                                    <p>Use the grid below to get reports for products</p>
                                    <div class="table-responsive" id="itemReportsTableDiv"></div>
                                </div>
                                <div id="customerReportsTab" class="container-fluid tab-pane fade">
                                    <br>
                                    <p>Use the grid below to get reports for customers</p>
                                    <div class="table-responsive" id="customerReportsTableDiv"></div>
                                </div>
                                <div id="saleReportsTab" class="container-fluid tab-pane fade">
                                    <br>
                                    <!-- <p>Use the grid below to get reports for sales</p> -->
                                    <form>
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="saleReportStartDate">Start Date</label>
                                                <input type="text" class="form-control datepicker" id="saleReportStartDate" value="" name="saleReportStartDate" readonly>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="saleReportEndDate">End Date</label>
                                                <input type="text" class="form-control datepicker" id="saleReportEndDate" value="" name="saleReportEndDate" readonly>
                                            </div>
                                        </div>
                                        <button type="button" id="showSaleReport" class="btn btn-dark">Show Report</button>
                                        <button type="reset" id="saleFilterClear" class="btn">Clear</button>
                                    </form>
                                    <br><br>
                                    <div class="table-responsive" id="saleReportsTableDiv"></div>
                                </div>
                                <div id="purchaseReportsTab" class="container-fluid tab-pane fade">
                                    <br>
                                    <!-- <p>Use the grid below to get reports for purchases</p> -->
                                    <form>
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="purchaseReportStartDate">Start Date</label>
                                                <input type="text" class="form-control datepicker" id="purchaseReportStartDate" value="2018-05-24" name="purchaseReportStartDate" readonly>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="purchaseReportEndDate">End Date</label>
                                                <input type="text" class="form-control datepicker" id="purchaseReportEndDate" value="2018-05-24" name="purchaseReportEndDate" readonly>
                                            </div>
                                        </div>
                                        <button type="button" id="showPurchaseReport" class="btn btn-dark">Show Report</button>
                                        <button type="reset" id="purchaseFilterClear" class="btn">Clear</button>
                                    </form>
                                    <br><br>
                                    <div class="table-responsive" id="purchaseReportsTableDiv"></div>
                                </div>
                                <div id="vendorReportsTab" class="container-fluid tab-pane fade">
                                    <br>
                                    <p>Use the grid below to get reports for vendors</p>
                                    <div class="table-responsive" id="vendorReportsTableDiv"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php
require 'inc/footer.php';
?>
</body>
</html>
