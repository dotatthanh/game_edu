document.addEventListener('DOMContentLoaded', function() {
    // Toggle sidebar
    document.getElementById('toggle-btn').addEventListener('click', function() {
        document.querySelector('.sidebar').classList.toggle('closed');
        document.querySelector('.main-content').classList.toggle('closed');
    });

    // Function to show a specific section
    function showSection(sectionId) {
        const sections = document.querySelectorAll('.content-section');
        sections.forEach(section => {
            section.style.display = section.id === sectionId ? 'block' : 'none';
        });
    }

    window.showSection = showSection;

    // Function to create Edit and Delete buttons
    function createEditDeleteButtons(userId) {
        const editButton = document.createElement('button');
        editButton.textContent = 'Sửa';
        editButton.classList.add('edit-button');
        editButton.dataset.userId = userId;

        const deleteButton = document.createElement('button');
        deleteButton.textContent = 'Xóa';
        deleteButton.classList.add('delete-button');
        deleteButton.dataset.userId = userId;

        const td = document.createElement('td');
        td.appendChild(editButton);
        td.appendChild(deleteButton);

        return td;
    }

    // Form submission for adding a game
    const form = document.getElementById('game-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(form);

        fetch('PHP/insert_game.php', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    form.reset();
                    loadGames(); // Refresh the games list
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });

    // Function to load games from the server
    function loadGames() {
        fetch('PHP/get_games.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const games = data.games;
                    const tbody = document.querySelector('.game-table tbody');
                    tbody.innerHTML = '';
                    games.forEach(game => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                        <td>${game.ma_so}</td>
                        <td>${game.ten_game}</td>
                        <td><img src="${game.hinh_anh}" alt="${game.ten_game}" style="width: 100px;"></td>
                        <td>${game.mo_ta}</td>
                        <td>${game.ma_the_loai}</td>
                    `;
                        const actionsCell = createEditDeleteButtons(game.ma_so);
                        tr.appendChild(actionsCell);
                        tbody.appendChild(tr);
                    });
                } else {
                    console.error(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    }

    // Initial load of games
    loadGames();

    // Function to load users from the server
    function loadUsers() {
        fetch('PHP/get_users.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    const users = data.users;
                    const userList = document.getElementById('user-list');
                    userList.innerHTML = '';
                    users.forEach(user => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                        <td>${user.ma_so}</td>
                        <td>${user.ten_nguoi_dung}</td>
                        <td>${user.email}</td>
                        <td>${user.so_dien_thoai}</td>
                        <td>${user.gioi_tinh}</td>
                    `;
                        const actionsCell = createEditDeleteButtons(user.ma_so);
                        tr.appendChild(actionsCell);
                        userList.appendChild(tr);
                    });
                    document.getElementById('users').style.display = 'block';
                } else {
                    console.error('Server response error:', data.message);
                }
            })
            .catch(error => console.error('Fetch error:', error));
    }

    // Initial load of users
    loadUsers();
});