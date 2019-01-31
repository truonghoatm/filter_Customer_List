<?php
$customer_list = array(
    "1" => array("name" => "Mai Văn Hoàn", "day_of_birth" => "1983/08/20", "address" => "Hà Nội", "profile" => "./images/img1.jpg"),
    "2" => array("name" => "Nguyễn Văn Nam", "day_of_birth" => "1983/08/21", "address" => "Bắc Giang", "profile" => "./images/img2.jpg"),
    "3" => array("name" => "Nguyễn Thái Hòa", "day_of_birth" => "1983/08/22", "address" => "Nam Định", "profile" => "./images/img3.jpg"),
    "4" => array("name" => "Trần Đăng Khoa", "day_of_birth" => "1983/08/17", "address" => "Hà Tây", "profile" => "./images/img4.jpg"),
    "5" => array("name" => "Nguyễn Đình Thi", "day_of_birth" => "1983/08/19", "address" => "Hà Nội", "profile" => "./images/img5.jpg")
);
function searchByDate($customers, $from_date, $to_date)
{
    if (empty($from_date) && empty($to_date)) {
        return $customers;
    }
    $filter_customers = [];
    foreach ($customers as $customer) {
        if (!empty($from_date) && (strtotime($customer['day_of_birth']) < strtotime($from_date))) {
            continue;
        }
        if (!empty($to_date) && (strtotime($customer['day_of_birth']) > strtotime($to_date))) {
            continue;
        }
        $filter_customers [] = $customer;
    }
    return $filter_customers;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>
<?php
$from_date = null;
$to_date = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $from_date = $_POST["from"];
    $to_date = $_POST["to"];
}
$filter_customers = searchByDate($customer_list, $from_date, $to_date);
?>
<form method="post">
    <label>From:</label><input id="from" type="text" name="from" placeholder="yyyy/mm/dd"
                               value="<?php echo isset($from_date) ? $from_date : ''; ?>">
    <label>To:</label><input id="to" type="text" name="to" placeholder="yyyy/mm/dd"
                             value="<?php echo isset($to_date) ? $to_date : ''; ?>">
    <input type="submit" id="submit" value="Search">
</form>


<table border="0">
    <caption><h1>Danh sach khach hang</h1></caption>
    <tr>
        <th> STT</th>
        <th>Ten</th>
        <th>Ngay sinh</th>
        <th>Dia chi</th>
        <th>Anh</th>
    </tr>
    <?php if(count($filter_customers)===0):?>
    <tr>
        <td colspan="5" class="message">Khong tim thay khach hang nao</td>
    </tr>
    <?php endif;?>
    <?php foreach ($filter_customers as $index=>$customer): ?>
        <tr>
            <td><?php echo $index +1 ?></td>
            <td><?php echo $customer['name'] ?></td>
            <td><?php echo $customer['day_of_birth'] ?></td>
            <td><?php echo $customer['address'] ?></td>
            <td>
                <div class="profile"><img src="<?php echo $customer['profile']; ?>"></div>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>

