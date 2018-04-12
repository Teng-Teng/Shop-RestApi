<?php




?>


<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Add Email Template</title>
    <style type="text/css">
        .active{
            display: inline-block;
        }
        .hidden{
            display: none;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="jumbotron">
        <h1 class="display-4">Let's add a new template</h1>
        <p class="lead">This is a restful api demo to add an email template to backend server by ajax and json</p>
        <hr class="my-4">

        <div><a id="select_c" href="#">Select</a>|<a id="insert_c" href="#">Insert</a>|<a id="update_c" href="#">Update</a>|<a id="delete_c" href="#">Delete</a></div>
        <div>
            <div class="select active">
                Product ID: <input type="text" name="sel_id"><br>
                Product Name:<input type="text" name="sel_name"><br>
                <button id="select" disabled>Select</button>
                <button id="selectAll" >SelectAll</button>
            </div>
            <div class="insert hidden">
                Product ID: <input type="text" name="ins_p_id"><br>
                <button >Insert</button>
            </div>
            <div class="update hidden">
                Product ID: <input type="text" name="upd_p_id"><br>
                Quantity from&nbsp;<input type="number" name="upd_p_q_orign">&nbsp;to&nbsp;<input type="number" name="upd_p_q_cur"><br>
                <button >Update</button>
            </div>
            <div class="delete hidden">
                Product ID: <input type="text" name="del_p_id"><br>
                <button >Delete</button>
            </div>
        </div>
        <br>
        <div id="result">

        </div>

        <div class="form-group">
            <label for="">Name:</label>
            <input type="text" id="tname" class="form-control" placeholder="Enter Template Name">
        </div>
        <div class="form-group">
            <label for="">Variable Name: (separate by;)</label>
            <input type="text" id="tvar" class="form-control" placeholder="Enter Template Variable Names">
        </div>
        <p class="lead">
            <button id="add_template" class="btn btn-primary btn-lg">
                Add Template
            </button>
        </p>
        <h1 class="lead" id="info"></h1>
    </div>

</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('a').click(function(){
            var para = $(this).attr('id').substr(0,6);
            $('.'+para).removeClass('hidden').addClass('active').siblings().removeClass('active').addClass('hidden');
        });

        $('input').change(function(){
            //disable select button when input is not filled.
            if($("input[name='sel_p_id']").val()!=""||$("input[name='sel_p_name']").val()!=""){
                $(".select button").attr('disabled',false);
            }else{
                $(".select button").attr('disabled',true);
            }

            //complete the jquery control for update and delete button.
        });

        $("#select").click(function(){
            var sel_id = $("input[name='sel_id']").val();

            $.ajax({
                // The URL for the request
                //url: "demo_get_post.php",
                url: "http://192.168.33.10/Shop-Rest/Shop-RestApi/find/select",
                // The data to send (will be converted to a query string)
                data: {
                    sel_id  : sel_id
                },
                // Whether this is a POST or GET request
                type: "POST",
                // The type of data we expect back
                dataType : "json",
                success : function(data, textStatus, jqXHR){
                    var id          = data.id;
                    var name        = data.name;
                    var price       = data.price;
                    var image_url   = data.image_url;
                    var description = data.description;

                    $('#result').html("");
                    var htmlTemplate =
                        `
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">NAME</th>
                                    <th scope="col">PRICE</th>
                                    <th scope="col">IMAGE_URL</th>
                                    <th scope="col">DESCRIPTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>`+ id +`</td>
                                    <td>`+ name +`</td>
                                    <td>`+ price +`</td>
                                    <td>`+ image_url +`</td>
                                    <td>`+ description +`</td>
                                </tr>
                            </tbody>
                        </table>

                        `;

                    $('#result').append(htmlTemplate);

                }
            })
                // Code to run if the request fails; the raw request and
                // status codes are passed to the function
                .fail(function( xhr, status, errorThrown ) {
                    alert( "Sorry, there was a problem!" );
                    console.log( "Error: " + errorThrown );
                    console.log( "Status: " + status );
                    console.dir( xhr );
                });
        });

        $("#selectAll").click(function(){
            $.ajax({
                // The URL for the request
                //url: "demo_get_post.php",
                url: "http://192.168.33.10/Shop-Rest/Shop-RestApi/find/selectAll",
                // The data to send (will be converted to a query string)
                data: {},
                // Whether this is a POST or GET request
                type: "POST",
                // The type of data we expect back
                dataType : "json",
                success : function(data, textStatus, jqXHR){
                    $('#result').html("");

                    var htmlForEachTemplate =
                        `<table class="table">
                            <thead>
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">NAME</th>
                            <th scope="col">PRICE</th>
                            <th scope="col">IMAGE_URL</th>
                            <th scope="col">DESCRIPTION</th>
                            </tr>
                            </thead>
                            <tbody>`;

                    $.each(data, function(key, value) {
                        var id          = value.id;
                        var name        = value.name;
                        var price       = value.price;
                        var image_url   = value.image_url;
                        var description = value.description;

                        htmlForEachTemplate +=
                            `
						    <tr>
                                <td>`+ id +`</td>
                                <td>`+ name +`</td>
                                <td>`+ price +`</td>
                                <td>`+ image_url +`</td>
                                <td>`+ description +`</td>
                            </tr>

	    				`;
                    });
                    htmlForEachTemplate +=
                        `</tbody>
                            </table> `
                    ;
                    $('#result').append(htmlForEachTemplate);
                }
            })
            // Code to run if the request fails; the raw request and
            // status codes are passed to the function
                .fail(function( xhr, status, errorThrown ) {
                    alert( "Sorry, there was a problem!" );
                    console.log( "Error: " + errorThrown );
                    console.log( "Status: " + status );
                    console.dir( xhr );
                });
        });


    })
</script>
</body>
</html>