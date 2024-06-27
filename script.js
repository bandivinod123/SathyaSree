document.getElementById('contact-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission

    // Collect form data
    let formData = new FormData(this);

    // Optional: Client-side validation
    let name = formData.get('name');
    let phone = formData.get('phone');
    let email = formData.get('email');
    let message = formData.get('message');

    // Example: Basic validation
    if (name.trim() === '' || phone.trim() === '' || email.trim() === '' || message.trim() === '') {
        alert('Please fill in all fields.');
        return;
    }

    // Perform AJAX request
    fetch('submit.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json(); // Optional: Process server response as JSON
    })
    .then(data => {
        console.log('Form submitted successfully', data);
        // Optional: Reset form or display success message
        document.getElementById('contact-form').reset();
        alert('Form submitted successfully!');
    })
    .catch(error => {
        console.error('Error submitting form', error);
        alert('An error occurred while submitting the form.');
    });
});
