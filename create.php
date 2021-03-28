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

<div class="main">
<h2>Add Contact</h2>

 <div class="container">
  <form method="post">
  <div class="row">
   <div class="col-40">
    <input type="text" name="callsign" id="callsign" placeholder="Call Sign" required>
   </div>
   <div class="col-40">
    <input type="text" name="frequency" id="frequency" placeholder="Frequency">
   </div>   
   <div class="col-40">
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
   <div class="col-40">   
    <input type="text" name="tone" id="tone" placeholder="Tone">
   </div>
   <div class="col-40">
    <input type="text" name="name" id="name" placeholder="Name">
   </div>
   <div class="col-40">
    <input type="text" name="email" id="email" placeholder="Email Address">
   </div>
   <div class="col-40">
    <input type="text" name="phone" id="phone" placeholder="Phone #">
   </div>
   <div class="col-40">
    <input type="date" name="contactdate" id="contactdate" placeholder="Contact Date">
   </div>
   <div class="col-40">
    <input type="text" name="city" id="city" placeholder="City">
   </div>
   <div class="col-40">
    <input type="text" name="state" id="state" placeholder="State">
   </div>
   <div class="col-40">
    <input type="text" name="country" id="country" placeholder="Country">
   </div>
   <div class="col-40">
    <input type="text" name="notes" id="notes" placeholder="Notes" style="height:100px"> 
   </div>
   <div class="col-40">
    <input type="submit" name="submit" value="Submit">
   </div>
  </div>
  </form>
  </div>
</div>
</div>
<div>
<?php require "templates/footer.php"; ?>
</div>
