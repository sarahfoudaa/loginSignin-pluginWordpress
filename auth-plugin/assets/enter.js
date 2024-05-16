
function handleLoginFormSubmit(event) {
  event.preventDefault(); // Prevent default form submission

  const formData = new FormData(event.target);

  fetch('http://fromthemes2.local/wp-json/enter/v1/authenticate', { 
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
       username: formData.get('username'),
          password: formData.get('password'),
    })
  })
  .then(response => response.json())
  .then(data => {
    const messageElement = document.getElementById('register-message');
    messageElement.textContent = data.message; 
    if (data.success && data.redirect_url) {
      window.location.href = data.redirect_url;
    }
  })
  .catch(error => {
    console.error(error);
    const messageElement = document.getElementById('register-message');
    messageElement.textContent = error.message || "unkown error"; 
  });
}
