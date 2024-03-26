document.getElementById('remiseForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);
    fetch('http://localhost:3000/remises-cles/add', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        console.log(data);
        alert('Remise added successfully!');
        form.reset(); // Réinitialiser le formulaire après l'ajout
    })
    .catch(error => {
        console.error('There was a problem with your fetch operation:', error);
        alert('Failed to add remise. Please try again.');
    });
});
