<?php

/**
  * List all users with a link to edit
  */

try {
  require "./config.php";
  require "./common.php";

  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM contacts";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();

} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>
<?php require "templates/header.php"; ?>

<h2>Update Contacts</h2>

<table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Call Sign</th>
                    <th>Frequency</th>
                    <th>Offset</th>
                    <th>Tone</th>
                    <th>Name</th>
                    <th>Email Address</th>
                    <th>Phone</th>
                    <th>Contact Date</th>
                    <th>City</th>
                    <th>State</th>
                    <th>country</th>
                    <th>Notes</th>
                </tr>
            </thead>
            <tbody>
        <?php foreach ($result as $row) : ?>
            <tr>
                <td><?php echo escape($row["id"]); ?></td>
                <td><?php echo escape($row["callsign"]); ?></td>
                <td><?php echo escape($row["frequency"]); ?></td>
                <td><?php echo escape($row["offset"]); ?></td>
                <td><?php echo escape($row["tone"]); ?></td>
                <td><?php echo escape($row["name"]); ?></td>
                <td><?php echo escape($row["email"]); ?></td>
                <td><?php echo escape($row["phone"]); ?></td>
                <td><?php echo escape($row["contactdate"]); ?></td>
                <td><?php echo escape($row["city"]); ?></td>
                <td><?php echo escape($row["state"]); ?></td>
                <td><?php echo escape($row["country"]); ?></td>
                <td><?php echo escape($row["notes"]); ?></td>
                <td><a href="update-contact.php?id=<?php echo escape($row["id"]); ?>">Edit</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    
    <?php require "templates/footer.php"; ?>
