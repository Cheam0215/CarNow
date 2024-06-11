const chart = document.querySelector('#chart').getContext('2d');

new Chart(chart, {
    type: 'line',

    data: {        
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],

        datasets: [
            
            {
                label: 'Revenue',
            data: [7000, 9800, 12000, 10900, 12400, 15500],
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
            },
            {
                label: 'Profit',
            data: [3500, 5550, 7100, 6150, 7200, 9770],
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1 
            }

        ]
    },

    option: {
        responsive: true,
    }

});