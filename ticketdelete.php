<?php
// Include the database connection
include 'db_connection.php';

if (isset($_GET['ticket_id']) && isset($_GET['event_id'])) {
    $ticket_id = $_GET['ticket_id'];
    $event_id = $_GET['event_id'];

    // Check for dependencies
    $dependencyCheckSql = "SELECT COUNT(*) AS dependency_count FROM purchase WHERE ticket_id = $ticket_id";
    $dependencyCheckResult = $conn->query($dependencyCheckSql);

    if ($dependencyCheckResult) {
        $row = $dependencyCheckResult->fetch_assoc();

        if ($row['dependency_count'] > 0) {
            // Dependencies found, perform a soft delete
            $softDeleteSql = "UPDATE tickets SET is_deleted = 1 WHERE ticket_id = $ticket_id";

            if ($conn->query($softDeleteSql) === TRUE) {
                echo "<script>
                        alert('Ticket marked as deleted (soft delete) successfully');
                        window.location.href = 'manageticketform.php?event_id=$event_id';
                      </script>";
            } else {
                echo "<script>alert('Error updating record: " . $conn->error . "');</script>";
            }
        } else {
            // No dependencies, perform a hard delete
            $deleteSql = "DELETE FROM tickets WHERE ticket_id = $ticket_id";

            if ($conn->query($deleteSql) === TRUE) {
                echo "<script>
                        alert('Ticket deleted successfully');
                        window.location.href = 'manageticketform.php?event_id=$event_id';
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
    echo "<script>alert('Ticket ID or Event ID is missing.');</script>";
}
?>
