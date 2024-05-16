<!DOCTYPE html>
<html>
<body>

<h2>LOG IN page</h2>
<div class='class'>
  <label for="user_login">User name:</label><br>
  <input type="text" name="user_login" id="user_login"><br><br>
  
  <label for="user_pass">Password:</label><br>
  <input type="password" name="user_pass" id="user_pass"><br><br>

  <button type="button" class="btnenter" id="enter">Log in</button>
</div>

<script>
  const websiteUrl = '<?php echo get_site_url(); ?>';  
  let addBtn = jQuery("#enter");
 if (addBtn) {
    addBtn.on("click", function() {
        let user_login = jQuery("#user_login").val();
        let user_pass = jQuery("#user_pass").val();
        let data = {
          user_login: user_login,
          user_pass: user_pass,
        };
        jQuery.post(
            websiteUrl+"/wp-json/enter/v1/authenticate",
            data,
            function(response) {
              if(response.status == true){
                console.log(response);
                //alert(response.message);
                window.location.assign(response.location)
               // window.location.reload();
              }
              else{
                console.log(response);
                alert(response.message);
              }
                
            }
        ).fail(function(error) {
            console.error(error);
        });
    });
}
</script>
</body>
</html>