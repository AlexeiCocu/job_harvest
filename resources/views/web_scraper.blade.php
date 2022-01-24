<!doctype html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test Web Scraper</title>

    <style>
        .div_header{
            text-align: center;
        }

        #job_search_results{
            padding: 20px;
        }
    </style>
</head>
<body>


<div class="div_header">
    <h3 id="updating_text" style="display: none">Updating Database job list...</h3>


    <button id="update_btn_db">Update job list in DB</button>

    <br><br>

    <form id="form">
        <label for="job_search">Job Search</label>
        <input id="job_search" type="text">
        <button id="btn_search">Search</button>
    </form>

    <br><br>
</div>


<div id="job_search_results"></div>





<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>

    // update DB job list
    $( "#update_btn_db" ).click(function() {
        updateJobsDB();
    });

    function updateJobsDB() {
        $.ajax({
            type: 'POST',
            url: '{{route('web_scraper')}}',
            headers: {
                'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
            },
            data: {
                update_btn: true,
            },

            beforeSend: function () {
                $('#updating_text').show();
                $('#update_btn_db').hide();
                $('#form').hide();
            },
            complete: function () {
                $('#updating_text').hide();
                $('#update_btn_db').show();
                $('#form').show();
            },

            success: function (data) {


            },
            error: function (data) {
                console.log(data)
            }
        })
    }
    // END update DB job list

    // search job
    $( "#btn_search" ).click(function(e) {
        e.preventDefault();
        $('#job_search_results').empty();
        searchFullText();
    });





    function searchFullText() {

        const search_value = $('#job_search').val();

        $.ajax({
            type: 'POST',
            url: '{{route('web_scraper')}}',
            headers: {
                'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute('content')
            },
            data: {
                search_full_text: true,
                query_val: search_value,
            },

            success: function (data) {
                $('#job_search_results').html(data);
                console.log(data)

            },
            error: function (data) {
                console.log(data)
            }
        })
    }
    // END search job

</script>

</body>
</html>



