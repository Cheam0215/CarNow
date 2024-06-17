document.addEventListener('DOMContentLoaded', (event) => {
    function searchFunction() {
        let input = document.getElementById('searchInput');
        let filter = input.value.toUpperCase();
        let table = document.getElementById('historyTable');
        let tr = table.getElementsByTagName('tr');

        for (let i = 1; i < tr.length; i++) {
            let td = tr[i].getElementsByTagName('td');
            let match = false;

            for (let j = 0; j < td.length; j++) {
                if (td[j]) {
                    if (td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                        match = true;
                    }
                }
            }

            if (match) {
                tr[i].style.display = '';
            } else {
                tr[i].style.display = 'none';
            }
        }
    }

    document.getElementById('searchInput').addEventListener('keyup', searchFunction);
});

