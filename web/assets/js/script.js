document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.chooseAnswer').forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default button action
            var answerId = this.getAttribute('data-answer-id');
            var userId = this.getAttribute('data-user-id');
            console.log('Answer ID:', answerId);

            // Set the hidden input value and submit the form
            document.getElementById('answer_id').value = answerId;
            document.getElementById('user_id').value = userId;
            document.getElementById('answerForm').submit();
        });
    });
    document.getElementById('win').addEventListener('click', function () {
        window.location.href = 'web/views/contactForm.php';

    });
    document.getElementById('bye').addEventListener('click', function () {
        window.location.href = 'web/views/goodBye.php';
    });
});
