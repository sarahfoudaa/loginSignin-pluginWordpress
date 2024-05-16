function handleFormSubmit(event) {
    event.preventDefault(); 
  
    //const formData = new FormData(event.target);
  // Get form data
const username = document.getElementById('user_login').value;
const password = document.getElementById('user_pass').value;
const email = document.getElementById('user_email').value;
const dateOfBirth = document.getElementById('dateOfBirth').value;

// Prepare data object (including action)
const data = {
  action: 'register', // Set action to 'register'
  user_login: user_login,
  user_pass: user_pass,
  user_email: user_email,
  dateOfBirth: dateOfBirth,
};



    fetch('http://fromthemes2.local/wp-json/register/v1/authenticate', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
  })
    .then(response => response.json())
    .then(data => {
      
      console.log(data);
      if (data.success) {
        alert("User data saved successfully!");
      } else {
        alert(data.message); 
      }
    })
    .catch(error => {
      console.error(error);
      alert(error.message );
    });
  }