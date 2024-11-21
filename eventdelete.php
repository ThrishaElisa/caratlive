<?php
// Include the database connection
include 'db_connection.php';

if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];

    // Check for dependencies
    $dependencyCheckSql = "SELECT COUNT(*) AS dependency_count FROM purchase WHERE event_id = $event_id";
    $dependencyCheckResult = $conn->query($dependencyCheckSql);

    if ($dependencyCheckResult) {
        $row = $dependencyCheckResult->fetch_assoc();

        if ($row['dependency_count'] > 0) {
            // Dependencies found, perform a soft delete
            $softDeleteSql = "UPDATE event SET is_deleted = 1 WHERE event_id = $event_id";

            if ($conn->query($softDeleteSql) === TRUE) {
                echo "<script>
                        alert('Event marked as deleted (soft delete) successfully');
                        window.location.href = 'event.php'; // Redirect to event list
                      </script>";
            } else {
                echo "<script>alert('Error updating record: " . $conn->error . "');</script>";
            }
        } else {
            // No dependencies, perform a hard delete
            $deleteSql = "DELETE FROM event WHERE event_id = $event_id";

            if ($conn->query($deleteSql) === TRUE) {
                echo "<script>
                        alert('Event deleted successfully');
                        window.location.href = 'event.php'; // Redirect to event list
                      </script>";
            } else {
                echo "<script>alert('Error deleting record: " . $conn->error . "');</script>";
            }
        }
    } else {
        echo "<script>alert('Error checking dependencies: " . $conn->error . "');</script>";
    }

    // Close the database connection
    $conn->close();
} else {
    echo "<script>alert('No event ID provided.');</script>";
}
?>
