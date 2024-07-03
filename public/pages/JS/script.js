

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('user-container').addEventListener('click', function() {
        var dropdown = document.getElementById('userDropdown');
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    });
    
    // Gọi API PHP để lấy dữ liệu từ bảng chi_tiet_game
    fetch('PHP/get_all_games.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const games = data.games;
                const gamezone = document.querySelector('.gamezone');

                // Xóa nội dung cũ trong gamezone
                gamezone.innerHTML = '';

                // Duyệt qua từng game và thêm vào gamezone
                games.forEach(game => {
                    const gameDiv = document.createElement('div');
                    gameDiv.classList.add('game-card');

                    gameDiv.innerHTML = `
                        <img src="${game.hinh_anh}" alt="${game.ten_game}" class="game-image">
                        <h3>${game.ten_game}</h3>
                        <p>${game.mo_ta}</p>
                    `;

                    // Thêm sự kiện click để điều hướng đến link tương ứng
                    gameDiv.addEventListener('click', function() {
                        window.location.href = game.link;
                    });

                    gamezone.appendChild(gameDiv);
                });
            } else {
                console.error(data.message); // Hiển thị lỗi nếu không thành công
            }
        })
        .catch(error => console.error('Error:', error));
});


document.addEventListener('DOMContentLoaded', function() {



    // Mở form quên mật khẩu khi click vào liên kết "Quên mật khẩu"
    document.querySelector(".forgot-password").addEventListener("click", function() {
        document.getElementById("forgotPasswordForm").style.display = "block";
    });
    document.getElementById('logout').addEventListener('click', function() {
        // Gửi yêu cầu AJAX đến tập tin PHP xử lý đăng xuất
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'PHP/logout.php', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Chuyển hướng người dùng đến trang Đăng nhập hoặc trang chính
                window.location.href = 'index.html'; // Thay 'login.php' bằng đường dẫn của trang Đăng nhập
                // Ẩn nút Đăng nhập và Đăng ký
                document.getElementById('loginBtn').style.display = 'none';
                document.getElementById('registerBtn').style.display = 'none';
            } else {
                // Hiển thị thông báo lỗi nếu không thể kết nối đến tập tin PHP
                showAlert('Đã xảy ra lỗi: Không thể kết nối đến máy chủ.', false);
            }
        };
        xhr.send();
    });

    // Mở form đăng ký
    document.getElementById('registerBtn').addEventListener('click', function() {
        document.getElementById('registerForm').style.display = 'block';
    });

    // Mở form đăng nhập
    // document.getElementById('loginBtn').addEventListener('click', function() {
    //     document.getElementById('loginForm').style.display = 'block';
    // });
    // Đăng ký
    // document.querySelector("#registerForm .btn[type='submit']").addEventListener("click", function(event) {
    //     event.preventDefault(); // Ngăn chặn form submit mặc định
    //     if (validateForm()) {
    //         registerUser();
    //     }
    // });

    // Đăng nhập
    document.querySelector("#loginForm .btn[type='submit']").addEventListener("click", function(event) {
        event.preventDefault(); // Ngăn chặn form submit mặc định
        loginUser();
    });

    // Gửi yêu cầu reset mật khẩu khi click nút "Xác nhận" trong form quên mật khẩu
    document.querySelector("#forgotPasswordForm .btn").addEventListener("click", function(event) {
        event.preventDefault(); // Ngăn chặn form submit mặc định
        sendNewPassword(this);
    });
    var accountInfoLink = document.getElementById('accountInfo');
    var userInfoModal = document.getElementById('userInfoModal');

    // Thêm sự kiện click cho liên kết "Thông tin tài khoản"
    accountInfoLink.addEventListener('click', function() {
        // Hiển thị popup form thông tin người dùng
        userInfoModal.style.display = 'block';
    });

    // Đóng popup form thông tin người dùng khi nhấp vào nút đóng
    var closeBtn = document.querySelector("#userInfoModal .close");
    closeBtn.addEventListener('click', function() {
        userInfoModal.style.display = 'none';
    });
    var changePasswordLink = document.getElementById('changePassword');
    var changePasswordModal = document.getElementById('changePasswordModal');

    // Thêm sự kiện click cho liên kết "Đổi mật khẩu"
    changePasswordLink.addEventListener('click', function() {
        // Hiển thị popup form thay đổi mật khẩu
        changePasswordModal.style.display = 'block';
    });

    // Đóng popup form thay đổi mật khẩu khi nhấp vào nút "Thoát"
    var cancelBtn = document.querySelector("#changePasswordModal .cancel");
    cancelBtn.addEventListener('click', function() {
        changePasswordModal.style.display = 'none';
    });
    document.getElementById('changePassword').addEventListener('click', function(event) {
        event.preventDefault(); // Ngăn chặn hành vi mặc định của thẻ 'a'

        // Hiển thị form thay đổi mật khẩu
        openChangePasswordForm();
    });

    // Xử lý sự kiện khi người dùng gửi form thay đổi mật khẩu
    document.getElementById('changePasswordForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Ngăn chặn form submit mặc định

        // Thu thập dữ liệu từ các trường nhập
        var currentPassword = document.getElementById('currentPassword').value;
        var newPassword = document.getElementById('newPassword').value;
        var confirmPassword = document.getElementById('confirmPassword').value;

        // Gọi hàm để gửi yêu cầu thay đổi mật khẩu lên máy chủ
        changePassword(currentPassword, newPassword, confirmPassword);
    });
    document.getElementById('accountInfo').addEventListener('click', function() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'PHP/get_user_info.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var userInfo = JSON.parse(xhr.responseText);
                document.getElementById("username").value = userInfo.ten_nguoi_dung;
                document.getElementById("email").value = userInfo.email;
                document.getElementById("phone").value = userInfo.so_dien_thoai;
                document.getElementById("gender").value = userInfo.gioi_tinh;
                document.getElementById('userInfoModal').style.display = 'block';
            }
        };
        xhr.send();
    });
    document.getElementById('saveBtn').addEventListener('click', function() {
        // Lấy thông tin từ các trường nhập
        var username = document.getElementById('username').value;
        var email = document.getElementById('email').value;
        var phone = document.getElementById('phone').value;
        var gender = document.getElementById('gender').value;

        // Gửi yêu cầu AJAX đến tập tin PHP xử lý để lưu thông tin
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'PHP/save_user_info.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    // Hiển thị thông báo thành công và cập nhật thông tin trên modal nếu cần
                    showAlert('Thông tin đã được cập nhật thành công!', true);
                } else {
                    // Hiển thị thông báo lỗi nếu có lỗi xảy ra
                    showAlert('Đã xảy ra lỗi: ' + response.message, false);
                }
            } else {
                // Hiển thị thông báo lỗi nếu không thể kết nối đến tập tin PHP
                showAlert('Đã xảy ra lỗi: Không thể kết nối đến máy chủ.', false);
            }
        };
        xhr.send('username=' + username + '&email=' + email + '&phone=' + phone + '&gender=' + gender);
    });

});
// document.getElementById('loginForm').addEventListener('submit', function(e) {
//     e.preventDefault();

//     const username = document.getElementById('username').value;
//     const psw = document.getElementById('psw').value;

//     fetch('PHP/login.php', {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/x-www-form-urlencoded',
//             },
//             body: new URLSearchParams({
//                 username: username,
//                 psw: psw
//             })
//         })
//         .then(response => response.json())
//         .then(data => {
//             if (data.success) {
//                 window.location.href = data.redirect_url;
//             } else {
//                 document.getElementById('message').textContent = data.message;
//             }
//         })
//         .catch(error => console.error('Error:', error));
// });




document.addEventListener('DOMContentLoaded', function() {
    var editBtn = document.getElementById('editBtn');
    var saveBtn = document.getElementById('saveBtn');
    var userInfoForm = document.getElementById('userInfoForm');

    // Khi ấn vào nút "Sửa"
    editBtn.addEventListener('click', function() {
        // Cho phép chỉnh sửa thông tin và hiển thị nút "Lưu"
        enableEdit();
    });

    // Khi ấn vào nút "Lưu"
    saveBtn.addEventListener('click', function() {
        // Lưu thông tin chỉnh sửa vào cơ sở dữ liệu
        saveUserInfo();
    });

    function enableEdit() {
        // Cho phép chỉnh sửa thông tin
        userInfoForm.querySelectorAll('input').forEach(function(input) {
            input.disabled = false;
        });
        // Hiển thị nút "Lưu" và ẩn nút "Sửa"
        saveBtn.disabled = false;
        editBtn.disabled = true;
    }

    function saveUserInfo() {
        saveBtn.disabled = true;
        editBtn.disabled = false;
    }
});

function closeForm(formId) {
    document.getElementById(formId).style.display = 'none';
}

function validateForm() {
    var username = document.querySelector("#registerForm input[name='username']").value;
    var password = document.querySelector("#registerForm input[name='psw']").value;
    if (username.length < 8 || password.length < 8) {
        showAlert("Tên đăng nhập và mật khẩu phải chứa ít nhất 8 ký tự.", false);
        return false; // Prevent form submission
    }
    return true; // Allow form submission
}

function registerUser() {
    var formData = new FormData(document.querySelector("#registerForm form"));
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(this.responseText);
            showAlert(response.message, response.success);
            if (response.success) {
                closeForm('registerForm');
            }
        }
    };
    xhr.open("POST", "PHP/register.php", true);
    xhr.send(formData);
}

function loginUser() {
    var formData = new FormData(document.querySelector("#loginForm form"));
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(this.responseText);
            showAlert(response.message, response.success);
            if (response.success) {
                updateHeader(response.username);
                closeForm('loginForm');
            }
        }
    };
    xhr.open("POST", "PHP/login.php", true);
    xhr.send(formData);
}

function showAlert(message, success, newPassword = "") {
    var alertBox = document.createElement("div");
    alertBox.className = "alert";
    alertBox.classList.add(success ? "alert-success" : "alert-error");

    // Tạo nội dung thông báo
    var content = document.createElement("div");
    content.textContent = message;

    // Thêm nội dung vào thông báo
    alertBox.appendChild(content);

    // Hiển thị alert box ở góc phải màn hình
    alertBox.style.position = "fixed";
    alertBox.style.top = "50px";
    alertBox.style.right = "10px";
    alertBox.style.padding = "10px";
    alertBox.style.background = "hwb(0 20% 70%)"; // Thay đổi màu nền
    alertBox.style.color = "#fff"; // Màu chữ là màu trắng
    alertBox.style.borderRadius = "5px";
    alertBox.style.zIndex = "9999";

    // Thêm nút đóng thông báo
    var closeButton = document.createElement("span");
    closeButton.textContent = "×";
    closeButton.style.position = "absolute";
    closeButton.style.top = "5px";
    closeButton.style.right = "5px";
    closeButton.style.cursor = "pointer";
    closeButton.style.fontSize = "16px";
    closeButton.style.fontWeight = "bold";

    // Xử lý sự kiện khi nhấn nút đóng
    closeButton.addEventListener("click", function() {
        document.body.removeChild(alertBox);
    });

    // Thêm nút đóng vào thông báo
    alertBox.appendChild(closeButton);

    // Nếu có mật khẩu mới, thêm thông báo về mật khẩu mới
    if (newPassword !== "") {
        var newPasswordText = document.createElement("p");
        newPasswordText.textContent = "Mật khẩu mới của bạn là: " + newPassword;
        newPasswordText.style.marginTop = "5px";
        newPasswordText.style.fontSize = "14px";
        newPasswordText.style.fontWeight = "bold";
        newPasswordText.style.color = "#fff"; // Màu chữ là màu trắng
        alertBox.appendChild(newPasswordText);
    }

    // Thêm thông báo vào body của trang
    document.body.appendChild(alertBox);

    // Tự động tắt thông báo sau 3 giây
    setTimeout(function() {
        if (document.body.contains(alertBox)) {
            document.body.removeChild(alertBox);
        }
    }, 5000);
}


function updateHeader(username) {
    var registerBtn = document.getElementById('registerBtn');
    var loginBtn = document.getElementById('loginBtn');
    if (registerBtn && loginBtn) {
        registerBtn.style.display = 'none';
        loginBtn.style.display = 'none';
    }

    // Tạo phần tử biểu tượng người dùng
    var userIcon = document.createElement('div');
    userIcon.className = 'user-icon';

    var userAvatar = document.createElement('img');
    userAvatar.src = 'Photo/path_to_user_icon.png'; // Thay đổi đường dẫn ảnh
    userAvatar.alt = 'User Icon';
    userAvatar.style.width = '32px'; // Độ rộng mong muốn
    userAvatar.style.height = 'auto'; // Chiều cao tự động điều chỉnh
    userAvatar.style.marginRight = '10px'; // Điều chỉnh khoảng cách
    userAvatar.style.marginLeft = '100px'; // Điều chỉnh khoảng cách
    userIcon.appendChild(userAvatar);
    // Tạo phần tử hiển thị tên người dùng
    var usernameDisplay = document.createElement('span');
    usernameDisplay.textContent = username;
    usernameDisplay.className = 'username-display';
    usernameDisplay.style.marginRight = '20px';
    usernameDisplay.style.marginLeft = '10px'; // Điều chỉnh khoảng cách
    usernameDisplay.style.color = '#000'; // Màu chữ đen
    usernameDisplay.style.fontWeight = 'bold'; // In đậm chữ

    // Tạo một container cho cả biểu tượng và tên người dùng
    var userContainer = document.createElement('div');
    userContainer.className = 'user-container';
    userContainer.style.display = 'flex';
    userContainer.style.alignItems = 'center';
    userContainer.appendChild(userIcon);
    userContainer.appendChild(usernameDisplay);

    // Thêm sự kiện click cho cả container chứa biểu tượng và tên người dùng
    userContainer.addEventListener('click', function() {
        var dropdown = document.getElementById('userDropdown');
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    });

    // Thêm container vào phần bên phải
    var rightSection = document.querySelector('.right-section');
    if (rightSection) {
        rightSection.appendChild(userContainer);
    } else {
        console.error('Không tìm thấy phần right-section');
    }

    // Cập nhật lời chào người dùng với tên người dùng
    var userGreeting = document.querySelector('.user-greeting span');
    if (userGreeting) {
        userGreeting.textContent = username;
    } else {
        console.error('Không tìm thấy span lời chào người dùng');
    }
}

// Ví dụ sử dụng với tên người dùng lấy từ cơ sở dữ liệu
updateHeader('Tên người dùng');


// Ví dụ sử dụng với tên người dùng lấy từ cơ sở dữ liệu
updateHeader('Tên người dùng');

function openChangePasswordForm() {
    document.getElementById('changePasswordModal').style.display = 'block';
}

// Hàm gửi yêu cầu thay đổi mật khẩu lên máy chủ
function changePassword(currentPassword, newPassword, confirmPassword) {
    // Tạo đối tượng FormData chứa dữ liệu form
    var formData = new FormData();
    formData.append('currentPassword', currentPassword);
    formData.append('newPassword', newPassword);
    formData.append('confirmPassword', confirmPassword);

    // Tạo request
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            var response = JSON.parse(this.responseText);
            // Xử lý kết quả trả về từ máy chủ
            handlePasswordChangeResponse(response);
        }
    };
    xhr.open('POST', 'PHP/change_password.php', true);
    xhr.send(formData);
}

// Hàm xử lý kết quả trả về từ máy chủ sau khi thay đổi mật khẩu
function handlePasswordChangeResponse(response) {
    // Hiển thị thông báo từ máy chủ
    alert(response.message);
    // Đóng form thay đổi mật khẩu nếu thành công
    if (response.success) {
        closeForm('changePasswordModal');
    }
}

// Hàm đóng form popup
function closeForm(formId) {
    document.getElementById(formId).style.display = 'none';
}
