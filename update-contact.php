<?php
/**
  * Use an HTML form to edit an entry in the
  * users table.
  *
  */
 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "./config.php";
require "./common.php";
if (isset($_POST['submit'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $contacts =[ 
            "id"        => $_POST['id'],
            "callsign"  => $_POST['callsign'],
            "frequency" => $_POST['frequency'],
            "offset"    => $_POST['offset'],
            "tone"      => $_POST['tone'],
            "name"      => $_POST['name'],
            "email"     => $_POST['email'],
            "phone"     => $_POST['phone'],
            "contactdate"  => $_POST['contactdate'],
            "city"      => $_POST['city'],
            "state"     => $_POST['state'],
            "country"   => $_POST['country'],
            "notes"     => $_POST['notes']
          ];

    $sql = "UPDATE contacts
            SET id = :id,
              callsign = :callsign,
              frequency = :frequency,
              offset = :offset,
              tone = :tone,
              name = :name,
              email = :email,
              phone = :phone,
              contactdate = :contactdate,
              city = :city,
              state = :state,
              country = :country,
              notes = :notes
            WHERE id = :id";

  $statement = $connection->prepare($sql);
  $statement->execute($contacts);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}

if (isset($_GET['id'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $id = $_GET['id'];
    $sql = "SELECT * FROM contacts WHERE id = :id";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $contacts = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} else {
    echo "Something went wrong!";
    exit;
}
?>


<?php if (isset($_POST['submit']) && $statement) : ?>
  <?php echo escape($_POST['callsign']); ?> successfully updated.
<?php endif; ?>

<div>
<?php include "templates/header.php"; ?>
</div>

 <div class="topnav">
   <a href="create.php" class="button">Create</a>
   <a href="read.php" class="button">Search</a>
   <a href="modify.php" class="button">Modify</a>
 </div>

<div class="main">
<h2>Edit Contact</h2>
 <div class="container2">
<form method="post">
    <?php foreach ($contacts as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
      <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>
    </div>
</div>

<?php require "templates/footer.php"; ?>
