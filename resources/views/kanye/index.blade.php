<!DOCTYPE html>
<html>

<head>
    <title>Kanye West Quotes</title>
</head>

<body>
    <h1>Kanye West Quotes</h1>

    <div id="quotes_container"></div>

    <button id="get_quotes_data">Refresh Quotes</button>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $('body').on('click', '#get_quotes_data', function(e) {
            e.preventDefault();
            let fd = new FormData();
            fd.append('_token', "{{ csrf_token() }}");
            $.ajax({
                url: "{{ route('get-quotes-data') }}",
                type: "POST",
                data: fd,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(result) {
                    let html = '';
                    if (result.status) {
                        result.data.forEach(element => { 
                            html += '<p class="card-text">'+element.quote+'</p>' 
                        });
                        $('#quotes_container').html(html);
                    } else {
                    }
                },
                
            });
        })
    </script>
</body>

</html>
