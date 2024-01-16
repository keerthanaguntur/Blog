<?php
// Include your database connection code here
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "blog";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $image_url = $_POST['image_url'];
    $content = $_POST['content'];
    $summary = $_POST['summary'];

    // Validate input if necessary

    // Insert new blog entry into the database
    $sql = "INSERT INTO blogs (title, image_url, content, summary) VALUES ('$title', '$image_url', '$content', '$summary')";

    if ($conn->query($sql) === TRUE) {
        // Get the ID of the newly inserted blog
        $newBlogId = $conn->insert_id;

        // Redirect to the blogdetail.php page of the new blog
        header("Location: blogdetail.php?id=" . $newBlogId);
        exit();
    } else {
        echo "Error creating new blog: " . $conn->error;
    }
}

$conn->close();
