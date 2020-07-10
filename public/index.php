<?php include_once('../private/initialize.php'); ?>

<?php require_once(SHARED_PATH . '/header.php'); ?>

<?php

$url = 'https://www.bnr.ro/nbrfxrates.xml';
$xmlobj = new SimpleXMLElement($url, 0, true, "", false);

if (is_post_request()) {

    foreach ($xmlobj->Body->Cube->Rate as $rate) {
        $currency = $rate->attributes()->currency;
        $rates = $rate;

        $date = $xmlobj->Body->Cube->attributes()->date;

        $sql = "INSERT INTO currency (currency, ron, date) " . "VALUES ('$currency', '$rates', '$date')";

        $result = mysqli_query($db, $sql);

        if (!$result) {
            confirm_query_result($result);
        }
    }
    
    header('Location: index.php');
}

?>

<section class="main" id="main">
    <div class="headers">
        <h1>Exchange currency GRABBER < LEU/RON ></h1>
        <h4>For date: <?php echo $xmlobj->Body->Cube->attributes()->date; ?></h4>
        <small>
            <?php
            date_default_timezone_set("Europe/Bucharest");
            echo "The time is " . date("h:i:sa");
            ?>
        </small>
        <p><small>Currency data changes every day at 13:00 (GMT+2 Romania time)</small></p>
        <p><small>Grabs data from https://www.bnr.ro/nbrfxrates.xml</small></p>
    </div>

    <div class="actions">
        <form action="<?php echo url_for('/'); ?>" method="post">
            <button type="submit" class="button button1">Add all data to database</button>
        </form>
    </div>

    <table>
        <tr>
            <th>Currency</th>
            <th>Lei</th>
        </tr>

        <?php foreach ($xmlobj->Body->Cube->Rate as $rate) { ?>
            <tr>
                <td><?php echo $rate->attributes()->currency; ?></td>
                <td><?php echo $rate; ?></td>
            </tr>
        <?php }; ?>
    </table>

</section>

<?php require_once(SHARED_PATH . '/footer.php'); ?>
