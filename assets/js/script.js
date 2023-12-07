function downloadGame(gameId, userId) {
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: "lib/download-game.php",
        data: {
            gameId: gameId,
            userId: userId
        },
        success: function (response) {
            location.reload();
        },
        error: function (error) {
            console.log(error);
        }
    })
}

function uninstallGame(gameId, userId) {
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: "lib/uninstall-game.php",
        data: {
            gameId: gameId,
            userId: userId
        },
        success: function (response) {
            location.reload();
        },
        error: function (error) {
            console.log(error);
        }
    })
}

function submitProfileEditForm(event) {
    event.preventDefault();
    let formData = $('#profileUpdateForm').serialize();
    var errorMessageElement = $('#profileEditModal').find('.error-message');
    $.ajax({
        type: 'POST',
        url: 'lib/update-profile.php',
        data: formData,
        success: function (response) {
            if (response.status === 'error') {
                errorMessageElement.text(response.message);
            } else {
                $('#profileEditModal').modal('hide');
                location.reload();
            }
        },
        error: function (error) {
            errorMessageElement.text(error.responseText);
        }
    });
}

function submitLoginForm() {
    preventDefault();
    let formData = $('#loginForm').serialize();
    var errorMessageElement = $('#loginForm').find('.error-message');
    $.ajax({
        type: 'POST',
        url: 'lib/login-user.php',
        data: formData,
        success: function (response) {
            if (response === 'error') {
                errorMessageElement.text(response.message);
            }
        },
        error: function (error) {
            errorMessageElement.text(error.responseText);
        }
    });

}

function openProfileEditModal(profileDataObj) {
    let updateModal = $('#profileEditModal');
    let profileForm = updateModal.find('#profileUpdateForm');
    profileForm.find('[name="nickname"]').val(profileDataObj.nickname);
    profileForm.find('[name="bio"]').text(profileDataObj.bio);
    profileForm.find('[name="userId"]').val(profileDataObj.id);
    updateModal.modal('show');
}