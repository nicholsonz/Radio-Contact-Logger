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
    try  {
        
        require "./config.php";
        require "./common.php";

        $connection = new PDO($dsn, $username, $password, $options);

        $sql = "SELECT * 
                        FROM contacts
                        WHERE callsign = :callsign";

        $callsign = $_POST['callsign'];

        $statement = $connection->prepare($sql);
        $statement->bindParam(':callsign', $callsign, PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetchAll();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>
        
<?php  
if (isset($_POST['submit'])) {
    if ($result && $statement->rowCount() > 0) { ?>
 <div class="main">
        <h2>Results</h2>

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
                    <th>Country</th>
                    <th>Notes</th>
                </tr>
            </thead>
            <tbody>
        <?php foreach ($result as $row) { ?>
            <tr>
                <td><?php echo escape($row["id"]); ?></td>
                <td><?php echo escape($row["callsign"]); ?></td>
                <td><?php echo escape($row["frequency"]); ?></td>
                <td><?php echo escape($row["offset"]); ?></td>
                <td><?php echo escape($row["tone"]); ?></td>
                <td><?php echo escape($row["name"]); ?></td>
                <td><?php echo escape($row["lastname"]); ?></td>
                <td><?php echo escape($row["phone"]); ?></td>
                <td><?php echo escape($row["contactdate"]); ?></td>
                <td><?php echo escape($row["city"]); ?></td>
                <td><?php echo escape($row["state"]); ?></td>
                <td><?php echo escape($row["country"]); ?></td>
                <td><?php echo escape($row["notes"]); ?></td>
                <td><a href="modify.php?id=<?php echo escape($row["id"]); ?>" class="btn delete">delete</a></td>
                <td><a href="update-contact.php?id=<?php echo escape($row["id"]); ?>" class="btn edit">edit</a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php } else { ?>
        <blockquote>No results found for <?php echo escape($_POST['callsign']); ?>.</blockquote>
    <?php } 
} ?> 

<h2>Find contact based on callsign</h2>


<form method="post">
    <input type="text" id="callsign" name="callsign" placeholder="Type in call sign...">
    <input type="submit" name="submit" value="View Results">
</form>
</dvi>
<div>
<?php require "templates/footer.php"; ?>
</div>
