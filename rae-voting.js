// Tap country open correct form

$(".vote-btn").on("click", function() {
    var id = $(this).attr('id');
    var cleanName = $(this).attr('name');

    $("#region").val(id);
    $(".territory-voting .form-container").addClass(id);
    $(".territory-voting .form").toggleClass('active');
    $("#country").load('../wp-content/plugins/rae-voting/countries/' + id + '.html');
    $(".form-header h3").html("Vote For </br>" + cleanName)
});

// Form Submit with Validation

$("#rae-vote").submit(function(e) {
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    var errors = 0;

    $("#rae-vote :input").map(function(){
         if( !$(this).val() ) {
              $(this).css("background-color", "red");
              errors++;
        } else if ($(this).val()) {
              $(this).css("background-color", "green");
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
            $(refreshVotes);
            alert(data);
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
    $('#update-div').load('../wp-content/plugins/rae-voting/download-results.php');
}