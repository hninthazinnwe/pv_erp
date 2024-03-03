<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <!-- <link rel="stylesheet" href="{{asset('/css/select2.min.css')}}"> -->
    </head>
    <body>
    <div class="container">
        <select class="js-example-basic-single" name="state">
        <option value="AL">Alabama</option>
        <option value="WY">AAAAAAA</option>
        <option value="WY">Wyoming</option>
        </select>

        <select class="js-example-basic-multiple" name="states[]" multiple="multiple">
        <option value="AL">Alabama</option>
        <option value="AL">Alabama</option>
        <option value="WY">AAAAAAA</option>
        <option value="WY">Wyoming</option>
        <option value="WY">Wyoming</option>
        </select>
    </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
            $('.js-example-basic-multiple').select2();
        });
    </script>
</html>