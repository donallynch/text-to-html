$(document).ready(function(){
    $(document).on("click", "#post-text-button", function(e){
        e.preventDefault();

        var form = $(this).closest('form'),
            feedback = form.find('#feedback'),
            textContainer = form.find('#text-content'),
            htmlContainer = form.find('#html-content');

        feedback.addClass('hidden').text('');

        $.ajax({
            url: "/post.php",
            type: 'POST',
            data: {'text': textContainer.val()}
        }).done(function(response) {

            if (response.status !== 200) {
                var error = 'ERROR: ' + response.errors;

                console.log(error);

                feedback.removeClass('hidden').text(error);
                return;
            }

            htmlContainer.val(response.payload.html);
        });
    });
});