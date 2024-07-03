function sendNewPassword(button) {
    var email = document.getElementById("forgotEmail").value; // Lấy giá trị của email từ input
    button.disabled = true; // Disable button để ngăn chặn double submit

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(this.responseText);
            showAlert(response.message, response.success, response.password);
            button.disabled = false; // Enable button lại sau khi hoàn thành yêu cầu
        }
    };
    xhr.open("POST", "PHP/send_new_password.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("email=" + encodeURIComponent(email));
}
// JavaScript code to handle password change
$(document).ready(function() {
    $('#changePasswordForm').submit(function(e) {
        e.preventDefault(); // Prevent form submission
        var currentPassword = $('#currentPassword').val();
        var newPassword = $('#newPassword').val();
        var confirmPassword = $('#confirmPassword').val();

        // Send AJAX request to server
        $.ajax({
            type: 'POST',
            url: 'PHP/change_password.php',
            data: {
                currentPassword: currentPassword,
                newPassword: newPassword,
                confirmPassword: confirmPassword
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                    // Clear form fields or do any additional action
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                alert('Lỗi: ' + error);
            }
        });
    });
});