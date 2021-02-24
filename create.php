<div>
<?php include "templates/header.php"; ?>
</div>

 <div class="topnav">
   <a href="create.php" class="button">Create</a>
   <a href="read.php" class="button">Search</a>
   <a href="modify.php" class="button">Modify</a>
 </div>

<?php

if (isset($_POST['submit'])) {
    require "./config.php";
    require "./common.php";

    try  {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $new_contact = array(
            "callsign"  => $_POST['callsign'],
            "frequency" => $_POST['frequency'],
            "offset"    => $_POST['offset'],
            "tone"      => $_POST['tone'],
            "name" => $_POST['name'],
            "email"     => $_POST['email'],
            "phone"     => $_POST['phone'],
            "contactdate"      => $_POST['contactdate'],
            "city"      => $_POST['city'],
            "state"     => $_POST['state'],
            "country"   => $_POST['country'],
            "notes"     => $_POST['notes']            
        );

        $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "contacts",
                implode(", ", array_keys($new_contact)),
                ":" . implode(", :", array_keys($new_contact))
        );
        
        $statement = $connection->prepare($sql);
        $statement->execute($new_contact);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>

<?php if (isset($_POST['submit']) && $statement) { ?>
    <blockquote><?php echo $_POST['firstname']; ?> successfully added.</blockquote>
<?php } ?>

<div class="main2">
<h2>Add Contact</h2>

<div class="createbox">
 <form method="post">
   <div class="item">
    <label for="callsign">Call Sign</label>
    <input type="text" name="callsign" id="callsign">
   </div>
   <div class="item"> 
    <label for="frequency">Frequency</label>
      <input type="text" name="frequency" id="frequency">   
   </div> 
   <div class="item">
     <select name="offset" id="offset">
      <option value="None">Offset</option>
      <option value="-500 kHz">-500 kHz</option>
      <option value="-600 kHz">-600 kHz</option>
      <option value="+600 kHz">+600 kHz</option>
      <option value="-1.6 MHz">-1.6 MHz</option>
      <option value="+5 MHz">+5 MHz</option>
      <option value="-5 MHz">-5 MHz</option>
      <option value="-12 MHz">-12 MHz</option>
     </select>
   </div>
    <label for="tone">Tone</label>
    <input type="text" name="tone" id="tone">
   <div class="item"> 
    <label for="name">Name</label>
    <input type="text" name="name" id="name">
    <label for="email">Email Address</label>
    <input type="text" name="email" id="email">
    <label for="phone">Phone #</label>
    <input type="text" name="phone" id="phone">
    <label for="contactdate">Contact Date</label>
    <input type="date" name="contactdate" id="contactdate">
    <label for="city">City</label>
    <input type="text" name="city" id="city">
    <label for="state">State</label>
    <input type="text" name="state" id="state">
    <label for="country">Country</label>
    <input type="text" name="country" id="country">
    <label for="notes">Notes</label>
    <input type="text" name="notes" id="notes">
    <input type="submit" name="submit" value="Submit">
   </div>
 </form>
</div>
</div>
<div>
<?php require "templates/footer.php"; ?>
</div>
