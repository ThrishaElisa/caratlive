<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Events - Carat Live</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<?php
// Include database connection
include("db_connection.php");
include('header.php');

$keywordURL = '';
// Check if 'keyword' is set in the URL
if (isset($_GET['keyword'])) {
	htmlspecialchars($_GET['keyword']);
	$keywordURL = $_GET['keyword'];
	$keyword = "%" . mysqli_real_escape_string($conn, $keywordURL) . "%"; // Add wildcards to the keyword for LIKE

	// Prepare a parameterized query
	$query = "SELECT * FROM event WHERE artistname LIKE ? OR eventname LIKE ? AND is_deleted = false";
	$stmt = mysqli_prepare($conn, $query);

	// Bind the keyword parameter to both placeholders
	mysqli_stmt_bind_param($stmt, "ss", $keyword, $keyword);

	// Execute the statement
	mysqli_stmt_execute($stmt);

	// Get the result
	$result = mysqli_stmt_get_result($stmt);
} else {
	// If no keyword is set, fetch all events without filtering
	$query = "SELECT * FROM event WHERE is_deleted = false";
	$result = mysqli_query($conn, $query);
}
?>

<body class="app">
	<div class="cardSearch">
		<div class="input-search">
			<input onkeydown="if (event.key === 'Enter') searchEvents()" type="text" value="<?php echo $keywordURL; ?>"
				class="input-field" name="keyword" id="keyword"
				placeholder="Search Events by Artist Name or Event Name...">
		</div>
		<button class="buttonSecondary" onclick="searchEvents()">Find Events</button>
		<button class="buttonSecondary" style="margin-left: 8px" onclick="clearSearch()">Clear Search</button>
	</div>

	<div class="event-container" style="margin-top:50px; width:100%">
		<div class="cardTitleButton" style="padding-left: 6px">
			<h2>Upcoming Events..</h2>
			<button onclick="redirectToPage('event_form.php')" id="addevent-button" class="buttonSecondary"><i
					style="color:white; padding-right:5px" class="fa-solid fa-plus"></i> Add Event</button>
		</div>

		<?php
		if (mysqli_num_rows($result) > 0) {
			$index = 0;

			// Output data of each row
			while ($row = mysqli_fetch_assoc($result)) {
				?>
				<div class="listUpcomingEvents">
					<div class="responsive">
						<div class="gallery">
							<a target="_blank">
								<img src="<?php echo $row['image']; ?>" alt="events" width="700" height="500">
							</a>
						</div>
					</div>
					<div class="listUpcomingEventDesc" style="display: flex; align-items: center;">
						<!-- Date Section -->
						<div class="date">
							<?php
							// Create a DateTime object from the date string
							$date = new DateTime($row['date']);

							// Get the day and month separately
							$day = $date->format('d'); // Day (e.g., 24)
							$month = $date->format('F'); // Month (e.g., February)
							?>
							<p class="day"><?php echo $day; ?></p>
							<p class="month"><?php echo $month; ?></p>
						</div>
						<!-- Event Title and Details Section -->
						<div style="flex-grow: 1;">
							<h2 style="margin: 0 0 20px 0;"><?php echo $row['artistname']; ?>: <?php echo $row['eventname']; ?>
							</h2>
							<div style="margin-top: 5px;">
								<strong> <?php echo $row['location']; ?></strong>
								<div style="padding-top: 10px;">Time: <?php echo date("h:i A", strtotime($row['time'])); ?>
								</div>
								<div id="user-eventaction<?php echo $index ?>" style="text-align: left; padding-top: 20px;">
									<a href="moreinfo.php?event_id=<?php echo $row['event_id']; ?>"><button
											class="buttonSecondary">More Info</button></a>
									<a href="buynow.php?event_id=<?php echo $row['event_id']; ?>"><button
											id="buy-button<?php echo $index ?>" class="buttonSecondary">Buy Now</button></a>
								</div>
								<div id="admin-eventaction<?php echo $index ?>"
									style="text-align: left; padding-left: 20px; padding-top: 20px;">
									<button class="buttonSecondary"
										onclick="redirectToPage('event_form.php?event_id=<?php echo $row['event_id']; ?>&mode=edit')"><i
											style="color: white; padding-right: 5px"
											class="fa-solid fa-pen-to-square"></i>Edit</button>
									<button class="buttonSecondary" onclick="confirmDelete(<?php echo $row['event_id']; ?>)"><i
											style="color: white; padding-right: 5px"
											class="fa-solid fa-trash"></i>Delete</button>
									<button class="buttonSecondary"
										onclick="redirectToPage('manageticketform.php?event_id=<?php echo $row['event_id']; ?>')"><i
											style="color: white; padding-right: 5px" class="fa-solid fa-ticket"></i>Manage
										Tickets</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
				$index++;
			}
		} else {
			?>
			<div style="padding:16px 0px 16px 0px;">
				No results found
			</div>
			<?php
		}
		?>
	</div>
	<script>

		// Select all rows with the admin or user event actions
		var adminActions = document.querySelectorAll('[id^="admin-eventaction"]');
		var userActions = document.querySelectorAll('[id^="user-eventaction"]');

		// Loop through each row and apply visibility based on the role
		adminActions.forEach(function (actionDiv, index) {
			if (localStorage.getItem('role') == 'admin') {
				// Show admin actions for the row, hide user actions
				actionDiv.style.display = 'block';
				userActions[index].style.display = 'none';

			} else if (localStorage.getItem('role') == 'user') {
				// Show user actions for the row, hide admin actions
				actionDiv.style.display = 'none';
				userActions[index].style.display = 'block';
				document.getElementById('addevent-button').style.display = 'none'; //make it disappear
			} else {
				actionDiv.style.display = 'none';
				userActions[index].style.display = 'block';
				document.getElementById('addevent-button').style.display = 'none'; //make it disappear
				document.getElementById('buy-button' + index).style.display = 'none'; //make it disappear


			}
		});

		function searchEvents() {
			// Get the value from the input field
			const keyword = document.getElementById("keyword").value;

			// Redirect to the current URL with the keyword parameter
			window.location.href = `${window.location.pathname}?keyword=${encodeURIComponent(keyword)}`;
		}
		function clearSearch() {
			document.getElementById("keyword").value = '';
			window.location.href = `${window.location.pathname}`;
		}

		function confirmDelete(event_id) {
			// Show a confirmation dialog
			var confirmation = confirm("Are you sure you want to delete this event?");

			// If the user clicks "OK", redirect to eventdelete.php
			if (confirmation) {
				// Redirect to eventdelete.php with the event_id passed in the URL
				window.location.href = "eventdelete.php?event_id=" + event_id;
			}
		}

	</script>
</body>

</html>