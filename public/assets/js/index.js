var index = {
    postUrl: "/post.php",
    init: function () {
        index.registerEvents();
    },
    registerEvents: function () {
        $(document).on("click", "#post-text-button", function(e){
            e.preventDefault();

            index.play($(this));
        });
    },
    play: function (button) {
        var form = button.closest('form'),
            feedback = form.find('#feedback'),
            textContainer = form.find('#text-content'),
            htmlContainer = form.find('#html-content');

        /* Hide feedback */
        feedback.addClass('hidden').text('');

        $.ajax({
            url: index.postUrl,
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
    }
};

$(document).ready(function(){
    index.init();
});

