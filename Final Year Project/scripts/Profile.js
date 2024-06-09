document.addEventListener('DOMContentLoaded', function() {
    // Replace with user ID here
    const userId = 1;

    fetch(`FUD.php?user_id=${userId}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('userName').innerText = data.name;
            document.getElementById('userEmail').innerText = data.email;
        })
        .catch(error => console.error('Error fetching personal data:', error));

    fetch(`FSH.php?user_id=${userId}`)
        .then(response => response.json())
        .then(data => {
            const serviceHistoryList = document.getElementById('serviceHistoryList');
            data.forEach(record => {
                const listItem = document.createElement('li');
                listItem.innerText = `${record.date} - ${record.service} - ${record.payment}`;
                serviceHistoryList.appendChild(listItem);
            });
        })
        .catch(error => console.error('Error fetching service history:', error));
});