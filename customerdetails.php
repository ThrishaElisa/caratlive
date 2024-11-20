<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Customer's Details - Carat Live </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<?php
include('header.php');
?>


<body class="app">
    <!-- Main profile section with image on the left and form on the right -->
    <div style="display: flex; justify-content: center;  ">
        <div class="details-container">

            <div class="profile-details">
                <div style="text-align: center; font-size: 20px">
                    <h2>Customer's Details</h2>
                </div>
                <div class="form-group">
                    <label for="firstname">First Name:</label>
                    <input type="text" id="firstname" name="firstname" required>
                </div>
                <div class="form-group">
                    <label for="lastname">Last Name:</label>
                    <input type="text" id="lastname" name="lastname" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number:</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" required>
                </div>
                <hr />
                <div style="text-align: center; font-size: 20px">
                    <h2>Purchase Detail</h2>
                </div>

                <div style="padding-top:30px; padding-bottom:30px">
                    <div>Ticket Category: <span id="ticketname"></span></div>
                    <div>Ticket Quantity: <span id="ticketNum"></span></div>
                    <div>Section: <span id="section"></span></div>

                </div>
                <hr>
                <div style="padding-bottom:30px">
                    <h3>Total Price: <span id="totalprice"></span></h3>
                </div>

                <hr>

                <label> Payment Method:</label><br><br>
                <input type="radio" id="fpxPayment" name="paymentMethod" value="FPX Payment">
                <label for="fpxPayment">FPX Payment</label><br>
				<div style="text-align: center;" onclick="paynow()">
                    <button class="buttonSecondary">Pay Now</button>
                </div>



                    <form id="paymentForm" action="userpurchaseticket.php" method="POST" style="display: none">
                        <input type="text" name="firstnameH" id="firstnameH" />
                        <input type="text" name="lastnameH" id="lastnameH" />
                        <input type="email" name="emailH" id="emailH" />
                        <input type="text" name="phoneH" id="phoneH" />
                        <input type="text" name="addressH" id="addressH" />
                        <input type="text" name="ticketnameH" id="ticketnameH" />
                        <input type="number" name="ticketNumH" id="ticketNumH" />
                        <input type="text" name="sectionH" id="sectionH" />
                        <input type="number" name="totalpriceH" id="totalpriceH" />
                        <input type="text" name="paymentMethodH" id="paymentMethodH" />
                        <input type="text" name="event_id" id="event_id" />
                        <input type="text" name="ticket_id" id="ticket_id" />
                        <input type="text" name="user_id" id="user_id" />
                    </form>



            </div>

        </div>
    </div>
    <!-- Embedding the footer -->
    <div id="footer">
        <iframe src="footer.html" style="border: none; width: 100%;"></iframe>
    </div>

    <script>
    document.getElementById("firstname").value = user.firstname;
    document.getElementById("lastname").value = user.lastname;
    document.getElementById("email").value = user.email;
    document.getElementById("phone").value = "0" + user.phonenumber;
    document.getElementById("address").value = user.address;


    let purchase = JSON.parse(localStorage.getItem('purchase'))

    document.getElementById("ticketname").innerHTML = purchase.ticketname
    document.getElementById("ticketNum").innerHTML = purchase.ticketNum
    document.getElementById("section").innerHTML = purchase.section

    let totalPrice = purchase.pricePerTicket * parseInt(purchase.ticketNum) + (20 * parseInt(purchase.ticketNum));
    document.getElementById("totalprice").innerHTML = "RM " + totalPrice

    function paynow() {
        let paymentMethod = document.querySelector('input[name="paymentMethod"]:checked')?.value;
        let params = new URLSearchParams(window.location.search);

        let event_id = params.get('event_id');

        if (paymentMethod) {
            let data = {
                firstname: document.getElementById("firstname").value,
                lastname: document.getElementById("lastname").value,
                email: document.getElementById("email").value,
                phone: document.getElementById("phone").value,
                address: document.getElementById("address").value,
                ticketname: purchase.ticketname,
                ticketNum: purchase.ticketNum,
                section: purchase.section,
                totalprice: totalPrice,
                paymentMethod: paymentMethod,
                event_id: event_id,
                ticket_id: purchase.ticket_id,
                user_id: user.id

            };

            // Fill the form with the data
            document.getElementById("firstnameH").value = data.firstname;
            document.getElementById("lastnameH").value = data.lastname;
            document.getElementById("emailH").value = data.email;
            document.getElementById("phoneH").value = data.phone;
            document.getElementById("addressH").value = data.address;
            document.getElementById("ticketnameH").value = data.ticketname;
            document.getElementById("ticketNumH").value = data.ticketNum;
            document.getElementById("sectionH").value = data.section;
            document.getElementById("totalpriceH").value = data.totalprice;
            document.getElementById("paymentMethodH").value = data.paymentMethod;
            document.getElementById("event_id").value = data.event_id;
            document.getElementById("ticket_id").value = data.ticket_id;
            document.getElementById("user_id").value = data.user_id;

            document.getElementById("paymentForm").submit();


        } else {
            alert("Please choose payment method")
        }

    }
    </script>

</body>

</html>