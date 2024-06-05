document.addEventListener('DOMContentLoaded', function() {
    loadFeedback();

    function loadFeedback() {
        fetch('feedback.php')
            .then(response => response.json())
            .then(data => {
                const tableBody = document.getElementById('feedbackTableBody');
                tableBody.innerHTML = '';
                data.forEach(feedback => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${feedback.id}</td>
                        <td>${feedback.name}</td>
                        <td>${feedback.email}</td>
                        <td>${feedback.feedback}</td>
                        <td><button class="delete-btn" onclick="deleteFeedback(${feedback.id}, this)">Delete</button></td>
                    `;
                    tableBody.appendChild(row);
                });
            })
            .catch(error => console.error('Error loading feedback:', error));
    }

    window.deleteFeedback = function(id, button) {
        if (confirm('Delete this feedback?')) {
            fetch(`AdminFeedback.php?id=${id}`, {
                method: 'DELETE'
            })
            .then(response => {
                if (response.ok) {
                    const row = button.closest('tr');
                    row.remove();
                } else {
                    alert('Failed to delete feedback');
                }
            })
            .catch(error => console.error('Error deleting feedback:', error));
        }
    };
});