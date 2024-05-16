<?php
global $wpdb;
?>
<h2>SIGN IN page</h2>
<div class='class'>
  
  <label for="user_login">User name:</label><br>
  <input type="text" id="user_login" name="user_login"><br><br>
  
  <label for="user_pass">Password:</label><br>
  <input type="password" id="user_pass" name="user_pass" ><br><br>
  
  <label for="user_email">Email:</label><br>
  <input type="email" id="user_email" name="user_email"><br><br>
  
  <label for="dateOfBirth">Date of birth:</label><br>
  <input type="date" id="dateOfBirth" name="dateOfBirth" ><br><br>
  
  <button type="button" class="btnsign" id="register">Sign in</button>
</div>

<script>
  const websiteUrl = '<?php echo get_site_url(); ?>';  
  let addBtn = jQuery("#register");
 if (addBtn) {
    addBtn.on("click", function() {
        let user_login = jQuery("#user_login").val();
        let user_pass = jQuery("#user_pass").val();
        let user_email = jQuery("#user_email").val();
        let dateOfBirth = jQuery("#dateOfBirth").val();
        let data = {
          user_login: user_login,
          user_pass: user_pass,
          user_email: user_email,
          dateOfBirth: dateOfBirth
        };
        jQuery.post(
            websiteUrl+"/wp-json/register/v1/authenticate",
            data,
            function(response) {
                console.log(response);
                alert(response.message);
                window.location.reload();
            }
        ).fail(function(error) {
            console.error(error);
        });
    });
}
</script>
