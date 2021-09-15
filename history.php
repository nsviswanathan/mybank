<?php
  include 'nav.php';
?>
<br>
<h1 class="title">Transaction History</h1>
<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Sender</th>
            <th>Receiver</th>
            <th>Amount</th>
            <th>Date & Time</th>
        </tr>
    </thead>
    <tbody>
    <?php
        include 'config.php';
        $sql ="select * from transaction";
        $query =mysqli_query($conn, $sql);
        while($rows = mysqli_fetch_assoc($query))
        {
    ?>
    <tr>
        <td><?php echo $rows['id']; ?></td>
        <td><?php echo $rows['sender']; ?></td>
        <td><?php echo $rows['receiver']; ?></td>
        <td><?php echo $rows['balance']; ?> </td>
        <td><?php echo $rows['datetime']; ?> </td>

    <?php
        }
    ?>
    </tbody>
</table>
<?php include 'footer.php';
?>
</body>
</html>