<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Submit Form Without Page Refresh</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-light">

<div class="container mt-5">
  <div class="card shadow-sm">
    <div class="card-body">
      <h4 class="mb-4">Demo Submit Form Without Page Refresh</h4>

      <form id="ContactForm" method="post">
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
        </div>

        <div class="form-group">
          <label for="email">Email Address:</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
        </div>

        <div class="form-group">
          <label for="message">Message:</label>
          <textarea class="form-control" id="message" name="message" placeholder="Write something..."></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>

      <div class="message_box mt-3"></div>
    </div>
  </div>
</div>

<script>
function isValidEmailAddress(emailAddress) {
  var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e]|\\[\x01-\x09\x0b\x0c\x0d-\x7f]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d]|[a-z\d][a-z\d\-._~]*[a-z\d])\.)+([a-z]|[a-z][a-z\d\-._~]*[a-z])\.?$/i;
  return pattern.test(emailAddress);
}

$(document).ready(function() {
  var delay = 2000; 

  $('#ContactForm').on('submit', function(e) {
    e.preventDefault();

    var name = $('#name').val().trim();
    var email = $('#email').val().trim();
    var message = $('#message').val().trim();

    if(name == '') {
      $('.message_box').html('<span class="text-danger">Enter your name!</span>');
      $('#name').focus();
      return false;
    }

    if(email == '') {
      $('.message_box').html('<span class="text-danger">Enter your email!</span>');
      $('#email').focus();
      return false;
    }

    if(!isValidEmailAddress(email)) {
      $('.message_box').html('<span class="text-danger">Invalid email address!</span>');
      $('#email').focus();
      return false;
    }

    if(message == '') {
      $('.message_box').html('<span class="text-danger">Enter your message!</span>');
      $('#message').focus();
      return false;
    }

    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: {name: name, email: email, message: message},
      beforeSend: function() {
        $('.message_box').html('<img src="Loader.gif" width="25" height="25"/> Sending...');
      },
      success: function(data) {
        setTimeout(function() {
          $('.message_box').html(data);
          $('#ContactForm')[0].reset();
        }, delay);
      },
      error: function() {
        $('.message_box').html('<span class="text-danger">Error submitting form!</span>');
      }
    });
  });
});
</script>

</body>
</html>
