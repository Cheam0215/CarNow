document.addEventListener('DOMContentLoaded', function() {
    const user_id = 1;

    fetch(`FUD.php?user_id=${user_id}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('username').innerText = data.username;
            document.getElementById('email').innerText = data.email;
            document.getElementById('contact_number').innerText = data.contact_number;
            document.getElementById('user_id').innerText = data.user_id;
        })
        .catch(error => console.error('Error fetching personal data:', error));

    fetch(`FSH.php?user_id=${user_id}`)
        .then(response => response.json())
        .then(data => {
            const serviceHistoryList = document.getElementById('payment');
            data.forEach(record => {
                const listItem = document.createElement('li');
                listItem.innerText = `${record.time} - ${record.maintenance_id} - ${record.amount}`;
                serviceHistoryList.appendChild(listItem);
            });
        })
        .catch(error => console.error('Error fetching service history:', error));
});