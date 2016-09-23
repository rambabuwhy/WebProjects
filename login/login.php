<!DOCTYPE html>
<html>
<head>

  <!--LOAD PRE-REQUISITES FOR GOOGLE SIGN IN -->
   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js">
  </script>

<script src="//apis.google.com/js/platform.js?onload=start"> </script>

<!-- END PRE-REQUISITES FOR GOOGLE SIGN IN -->


</head>


<body>  


<!-- GOOGLE PLUS SIGN IN-->

          
          <div id="signInButton">
          <span class="g-signin"
            data-scope="openid email"
            data-clientid="1030008831510-qecvect17semmpodvlapinplm924ud4v.apps.googleusercontent.com"
            data-redirecturi="postmessage"
            data-accesstype="offline"
            data-cookiepolicy="single_host_origin"
            data-callback="signInCallback"
            data-approvalprompt="force">
          </span>
        </div>

<div id="result"></div>

<script>
function signInCallback(authResult) {
  if (authResult['code']) {

    // Hide the sign-in button now that the user is authorized
    $('#signinButton').attr('style', 'display: none');

    // Send the one-time-use code to the server, if the server responds, write a 'login successful' message to the web page and then redirect back to the main restaurants page
    $.ajax({
      type: 'POST',
      url: '/gconnect?state={{STATE}}',
      processData: false,
      data: authResult['code'],
      contentType: 'application/octet-stream; charset=utf-8',
      success: function(result) {
        // Handle or verify the server response if necessary.
        if (result) {
          $('#result').html('Login Successful!</br>'+ result + '</br>Redirecting...')
         setTimeout(function() {
          window.location.href = "/restaurant";
         }, 4000);
          

      } else if (authResult['error']) {

    console.log('There was an error: ' + authResult['error']);
  } else {
        $('#result').html('Failed to make a server-side call. Check your configuration and console.');
         }

      }
      
  }); } }
</script>



<!--END GOOGLE PLUS SIGN IN -->

  </body>

  </html>