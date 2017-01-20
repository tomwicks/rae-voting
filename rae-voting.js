$("#rae-vote").submit(function(e)
{
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
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

function refreshVotes(){
    $('#update-div').load('../wp-content/plugins/rae-voting/download-results.php');
}