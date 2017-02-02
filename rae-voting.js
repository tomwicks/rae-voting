// Tap country open correct form

$('.form-container').on('click', function(e) {
    e.stopPropagation();
});

$('.description-mobile .show-hidden').on('click', function() {
    $(this).html() == "Read Less" ? $(this).html('Read More') : $(this).html('Read Less');
    $('.hidden-expanded').toggleClass('active');
    return false;
}); 

// Tap country open correct form

$('.form').on('click', function (e) {
    $(".territory-voting .form").removeClass('active');
    $(".territory-voting .form-container").removeClass('active south-america north-america asia-oceania europe africa');
});

$(".vote-btn").on("click", function(e) {
    var id = $(this).attr('id');
    var cleanName = $(this).attr('name');

    $("#region").val(id);
    $(".territory-voting .vote-form").addClass(id);
    $(".territory-voting .form").toggleClass('active');
    $(".territory-voting .vote-form").toggleClass('active');
    $("#country").load('../wp-content/plugins/rae-voting/countries/' + id + '.html');
    $(".form-header h3").html("Vote For </br>" + cleanName);
    $('input[type="submit"]').val('Vote For ' + cleanName);
    $('input[type="submit"]').attr("name", cleanName);
    $('input[type="submit"]').attr("id", id);
});

$(".about-rae-link").on("click", function() {
    $(".territory-voting .form").toggleClass('active');
    $('.about-rae').toggleClass('active');
    return false;
});

$(".about-vote-link").on("click", function() {
    $(".territory-voting .form").toggleClass('active');
    $('.about-vote').toggleClass('active');
    return false;
});

// Form Submit with Validation

$("#rae-vote").submit(function(e) {
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    var errors = 0;

    $("#rae-vote :input").map(function(){
         if( !$(this).val() ) {
              $(this).css("background-color", "#FD6A6C");
              errors++;
        } else if ($(this).val()) {

        }   
    });
    if(errors > 0){
        
        return false;
    }

    $.ajax(
    {
        url : formURL,
        type: "POST",
        data : postData,
        success:function(data, textStatus, jqXHR) 
        {   
            var VotedFor = $('input[type="submit"]').attr("name");
            var VotedForId = $('input[type="submit"]').attr("id");
            var VotedForMessage = "You Voted for</br> " + VotedFor;
            var voteResult = $('.form-header h3').html();
            $(".form-header h3").html(VotedForMessage);
            $(refreshVotes);
            $('.form-container').removeClass('active');
            $('.vote-form').removeClass('active');
            $('.success').addClass('active');
            $('.success').addClass(VotedForId);
            $('#referral-box').val(data);
        },
        error: function(jqXHR, textStatus, errorThrown) 
        {
   
        }
    });

    e.preventDefault(); //STOP default action
    e.unbind(); //unbind. to stop multiple form submit.
});

// Refresh Votes After Submit

function refreshVotes(){
    $('#update-div').load('../wp-content/plugins/rae-voting/download-results.php')
    setTimeout(hideButtons, 700);
}

function hideButtons() {
   $('.fake-btn').addClass('hide');
}