<?php
$q = $_GET['q'];

include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/db.php');
include($_SERVER['DOCUMENT_ROOT'].'/erp/system_dependants/session.php');

?>

<div class="left">
<p1>January: </p1><input disabled value="$<?php
                            $sql = "SELECT sum(bl_amt) AS bal FROM arbl WHERE bl_cust = $q AND bl_period LIKE '01-%' AND bl_status = 'Owing'";
$result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo number_format($row["bal"],2);
                                }
                            }  else {
                                    echo number_format(0,2);
                                }
                            ?>"><br>
    <p1>February: </p1><input disabled value="$<?php
                            $sql = "SELECT sum(bl_amt) AS bal FROM arbl WHERE bl_cust = $q AND bl_period LIKE '02-%' AND bl_status = 'Owing'";
$result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo number_format($row["bal"],2);
                                }
                            }  else {
                                    echo number_format(0,2);
                                }
                            ?>"><br>
    <p1>March: </p1><input disabled value="$<?php
                            $sql = "SELECT sum(bl_amt) AS bal FROM arbl WHERE bl_cust = $q AND bl_period LIKE '03-%' AND bl_status = 'Owing'";
$result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo number_format($row["bal"],2);
                                }
                            }  else {
                                    echo number_format(0,2);
                                }
                            ?>"><br>
    <p1>April: </p1><input disabled value="$<?php
                            $sql = "SELECT sum(bl_amt) AS bal FROM arbl WHERE bl_cust = $q AND bl_period LIKE '04-%' AND bl_status = 'Owing'";
$result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo number_format($row["bal"],2);
                                }
                            }  else {
                                    echo number_format(0,2);
                                }
                            ?>"><br>
    <p1>May: </p1><input disabled value="$<?php
                            $sql = "SELECT sum(bl_amt) AS bal FROM arbl WHERE bl_cust = $q AND bl_period LIKE '05-%' AND bl_status = 'Owing'";
$result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo number_format($row["bal"],2);
                                }
                            }  else {
                                    echo number_format(0,2);
                                }
                            ?>"><br>
    <p1>June: </p1><input disabled  value="$<?php
                            $sql = "SELECT sum(bl_amt) AS bal FROM arbl WHERE bl_cust = $q AND bl_period LIKE '06-%' AND bl_status = 'Owing'";
$result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo number_format($row["bal"],2);
                                }
                            }  else {
                                    echo number_format(0,2);
                                }
                            ?>"><br><br>
    <p1>Total Invoices: </p1><input disabled value="<?php
                            $sql = "SELECT count(vh_id) AS inv FROM invh WHERE vh_cust = $q";
$result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo $row["inv"];
                                }
                            }  else {
                                    echo 0;
                                }
                            ?>"><br>
       <p1>Total Credits: </p1><input disabled value="0"><br>
       <p1>Total Receipts: </p1><input disabled value="0"><br>
       <p1>Total Payments: </p1><input disabled value="2"><br>

</div>
<div class="right">
<p1>July: </p1><input disabled value="$<?php
                            $sql = "SELECT sum(bl_amt) AS bal FROM arbl WHERE bl_cust = $q AND bl_period LIKE '07-%' AND bl_status = 'Owing'";
$result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo number_format($row["bal"],2);
                                }
                            }  else {
                                    echo number_format(0,2);
                                }
                            ?>"><br>
    <p1>August: </p1><input disabled value="$<?php
                            $sql = "SELECT sum(bl_amt) AS bal FROM arbl WHERE bl_cust = $q AND bl_period LIKE '08-%' AND bl_status = 'Owing'";
$result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo number_format($row["bal"],2);
                                }
                            }  else {
                                    echo number_format(0,2);
                                }
                            ?>"><br>
    <p1>September: </p1><input disabled value="$<?php
                            $sql = "SELECT sum(bl_amt) AS bal FROM arbl WHERE bl_cust = $q AND bl_period LIKE '09-%' AND bl_status = 'Owing'";
$result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo number_format($row["bal"],2);
                                }
                            }  else {
                                    echo number_format(0,2);
                                }
                            ?>"><br>
    <p1>October: </p1><input disabled value="$<?php
                            $sql = "SELECT sum(bl_amt) AS bal FROM arbl WHERE bl_cust = $q AND bl_period LIKE '10-%' AND bl_status = 'Owing'";
$result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo number_format($row["bal"],2);
                                }
                            }  else {
                                    echo number_format(0,2);
                                }
                            ?>"><br>
    <p1>November: </p1><input disabled value="$<?php
                            $sql = "SELECT sum(bl_amt) AS bal FROM arbl WHERE bl_cust = $q AND bl_period LIKE '11-%' AND bl_status = 'Owing'";
$result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo number_format($row["bal"],2);
                                }
                            }  else {
                                    echo number_format(0,2);
                                }
                            ?>"><br>
    <p1>December: </p1><input id="period" disabled value="$<?php
                            $sql = "SELECT sum(bl_amt) AS bal FROM arbl WHERE bl_cust = $q AND bl_period LIKE '12-%' AND bl_status = 'Owing'";
$result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo number_format($row["bal"],2);
                                }
                            }  else {
                                    echo number_format(0,2);
                                }
                            ?>"><br><br>
    <p1>Total Owing: </p1><input disabled value="$<?php
                            $sql = "SELECT sum(bl_amt) AS bal FROM arbl WHERE bl_cust = $q AND bl_status = 'Owing'";
$result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo number_format($row["bal"],2);
                                }
                            }  else {
                                    echo number_format(0,2);
                                }
                            ?>">
</div>




