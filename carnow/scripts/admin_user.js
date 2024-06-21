function searchTable() {

    let input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("search-input");
    filter = input.value.toUpperCase();
    table = document.getElementById("userTable");
    tr = table.getElementsByTagName("tr");


    for (i = 1; i < tr.length; i++) {
        tr[i].style.display = "none"; 
        td = tr[i].getElementsByTagName("td")[0]; 
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().startsWith(filter)) {
                tr[i].style.display = ""; 
            }
        }
    }
}


document.addEventListener('DOMContentLoaded', function() {
    var openBtn = document.getElementById('openBtn');
    var popOutWindow = document.getElementById('popOutWindow');
    var closeBtn = document.getElementById('closeBtn');

    openBtn.onclick = function() {
        popOutWindow.style.display = 'block';
    }

    closeBtn.onclick = function() {
        popOutWindow.style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target == popOutWindow) {
            popOutWindow.style.display = 'none';
        }
    }
});



$(document).ready(function() {
    $('#animatedElement').on('click', 'tr', function() {
        var userId = $(this).data('id');
        $.ajax({
            url: 'admin_user.php',
            type: 'GET',
            data: { user_id: userId },
            success: function(response) {
                var $responseHtml = $(response); 
                var userDetailsHtml = $responseHtml.find('#userDetails').html(); 
                $('#userDetails').html(userDetailsHtml); 

                var updatePopOutWindowHtml = $responseHtml.find('#updatePopOutWindow').html(); 
                $('#updatePopOutWindow').html(updatePopOutWindowHtml); 

                
                document.getElementById('updateInfoLink').onclick = function() {
                    document.getElementById('updatePopOutWindow').style.display = 'block';
                };

                document.getElementById('closeUpdateBtn').onclick = function() {
                    document.getElementById('updatePopOutWindow').style.display = 'none';
                };

                window.onclick = function(event) {
                    if (event.target == document.getElementById('updatePopOutWindow')) {
                        document.getElementById('updatePopOutWindow').style.display = 'none';
                    }
                };
            }
        });
    });
});





function deleteUser(event, user_id) {
    event.stopPropagation(); 
    if (confirm('Are you sure you want to delete this user?')) {

        window.location.href = 'delete_user.php?main_id=' + user_id;
    }
}



document.addEventListener('DOMContentLoaded', function() {
    var showUsersBtn = document.getElementById('showUsers');
    var showStaffsBtn = document.getElementById('showStaffs');
    var rows = document.querySelectorAll('#userTable tbody tr');

    showUsersBtn.addEventListener('click', function() {
        filterRows('user');
        setActiveButton(showUsersBtn);
    });

    showStaffsBtn.addEventListener('click', function() {
        filterRows('staff');
        setActiveButton(showStaffsBtn);
    });

    function filterRows(role) {
        rows.forEach(function(row) {
            if (row.classList.contains(role)) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });
    }

    function setActiveButton(activeBtn) {
        [showUsersBtn, showStaffsBtn].forEach(function(btn) {
            if (btn === activeBtn) {
                btn.classList.add('active');
            } else {
                btn.classList.remove('active');
            }
        });
    }
});


document.getElementById('updateInfoLink').onclick = function() {
                    document.getElementById('updatePopOutWindow').style.display = 'block';
                };

                document.getElementById('closeUpdateBtn').onclick = function() {
                    document.getElementById('updatePopOutWindow').style.display = 'none';
                };

                window.onclick = function(event) {
                    if (event.target == document.getElementById('updatePopOutWindow')) {
                        document.getElementById('updatePopOutWindow').style.display = 'none';}}


function validate_ic($ic) {
    $regex = '/^[0-9]{6}-[0-9]{2}-[0-9]{4}$/';
    
    if (preg_match($regex, $ic)) {
        return true;
    } else {
        return false;
    }
}
