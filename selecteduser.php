<?php
include('config.php');

if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from users where id=$from";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query); 
    $sql = "SELECT * from users where id=$to";
    $query = mysqli_query($conn,$sql);
    $sql2 = mysqli_fetch_array($query);

    if (($amount)<0)
   {
        echo '<script type="text/javascript">';
        echo ' alert("Oops! Negative values cannot be transferred")';  
        echo '</script>';
    }

    else if($amount > $sql1['balance']) 
    {
        
        echo '<script type="text/javascript">';
        echo ' alert("Bad Luck! Insufficient Balance")'; 
        echo '</script>';
    }
    
    else if($amount == 0){

         echo "<script type='text/javascript'>";
         echo "alert('Oops! Zero value cannot be transferred')";
         echo "</script>";
     }

     else {
                $newbalance = $sql1['balance'] - $amount;
                $sql = "UPDATE users set balance=$newbalance where id=$from";
                mysqli_query($conn,$sql);
             
                $newbalance = $sql2['balance'] + $amount;
                $sql = "UPDATE users set balance=$newbalance where id=$to";
                mysqli_query($conn,$sql);
                
                $sender = $sql1['name'];
                $receiver = $sql2['name'];
                $sql = "INSERT INTO transaction(`sender`, `receiver`, `balance`) VALUES ('$sender','$receiver','$amount')";
                $query=mysqli_query($conn,$sql);

                if($query){
                     echo "<script> alert('Transaction Successful');
                                     window.location='history.php';
                           </script>";
                }

                $newbalance= 0;
                $amount =0;
        }
}
?>
<?php
  include 'nav.php';
?>
<br>
	<h1 class="title">Transaction</h1>
    <?php
        include 'config.php';
        $sid=$_GET['id'];
        $sql = "SELECT * FROM  users where id=$sid";
        $result=mysqli_query($conn,$sql);
        if(!$result)
        {
            echo "Error : ".$sql."<br>".mysqli_error($conn);
        }
        $rows=mysqli_fetch_assoc($result);
    ?>
    <form method="post" name="tcredit">
    <div>
        <table class="table">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Balance</th>
                </tr>
                <tr>
                    <td><?php echo $rows['id'] ?></td>
                    <td><?php echo $rows['name'] ?></td>
                    <td><?php echo $rows['email'] ?></td>
                    <td><?php echo $rows['balance'] ?></td>
                </tr>
            </table>
        </div>
        <br>
        <label ><center>Transfer To : </label>
        <select name="to" required>
            <option value="" disabled selected>Choose</option>
            <?php
                include 'config.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM users where id!=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error ".$sql."<br>".mysqli_error($conn);
                }
                while($rows = mysqli_fetch_assoc($result)) {
            ?>
                <option class="table" value="<?php echo $rows['id'];?>" >
                
                    <?php echo $rows['name'] ;?> (Balance: 
                    <?php echo $rows['balance'] ;?> ) 
               
                </option>
            <?php 
                } 
            ?>
            <div>
        </select></center>
        <br>
        
            <label><center>Amount : </label>
            <input type="number" name="amount" required>  </center> 
            <br>
                <div>
            <center><button class="btn-button" name="submit" type="submit" id="btn"> Transfer </button></center>
            </div>
        </form>
    </div>
<?php include 'footer.php';
?>
</body>
</html>