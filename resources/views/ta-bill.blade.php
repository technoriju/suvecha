<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TA Contact</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <style>

      * {
      box-sizing: border-box;
      }
    /*  html, body {
      padding: 0;
      margin: 0;
      font-family: Roboto, Arial, sans-serif;
      font-size: 14px;
      color: #666;
      }*/
      input,select, textarea {
      outline: none;
      }
      .select{
        font-size: 13px;
        padding: 10px;
        margin-left: 5px;
        margin-bottom: 8px;
      }
      .ta_form {
        font-family: Roboto, Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
      background: #63c2ba;
      }
      h1 {
      margin-top: 0;
      font-weight: 500;
      }
      form {
      position: relative;
      width: 85%;
      left: 10px;
      border-radius: 30px;
      background: #fff;
      }
      .form-left-decoration,
      .form-right-decoration {
      content: "";
      position: absolute;
      width: 50px;
      height: 20px;
      border-radius: 20px;
      background: #63c2ba;
      }
      .form-left-decoration {
      bottom: 60px;
      left: -30px;
      }
      .form-right-decoration {
      top: 60px;
      right: -30px;
      }
      .form-left-decoration:before,
      .form-left-decoration:after,
      .form-right-decoration:before,
      .form-right-decoration:after {
      content: "";
      position: absolute;
      width: 50px;
      height: 20px;
      border-radius: 30px;
      background: #fff;
      }
      .form-left-decoration:before {
      top: -20px;
      }
      .form-left-decoration:after {
      top: 20px;
      left: 10px;
      }
      .form-right-decoration:before {
      top: -20px;
      right: 0;
      }
      .form-right-decoration:after {
      top: 20px;
      right: 10px;
      }
      .circle {
      position: absolute;
      bottom: 80px;
      left: -55px;
      width: 20px;
      height: 20px;
      border-radius: 50%;
      background: #fff;
      }
      .form-inner {
      padding: 40px;
      }
      .form-inner input,
      .form-inner select,
      .form-inner textarea {
      display: block;
      width: 100%;
      padding: 15px;
      margin-bottom: 10px;
      border: none;
      border-radius: 20px;
      background: #d0dfe8;
      }
      .form-inner textarea {
      resize: none;
      }
      button {
      width: 100%;
      padding: 10px;
      margin-top: 20px;
      border-radius: 20px;
      border: none;
      border-bottom: 4px solid #2a8d84;
      background: #63c2ba;
      font-size: 16px;
      font-weight: 400;
      color: #fff;
      }
      button:hover {
      background: #1c5853;
      }
      @media (min-width: 568px) {
      form {
      width: 60%;
      }
      }
    </style>
  </head>
  <body class="ta_form">
    <form action="{{ $url }}" method="post" enctype="multipart/form-data" class="decor">
        @csrf
            <div class="form-left-decoration"></div>
            <div class="form-right-decoration"></div>
            <div class="circle"></div>
            <div class="form-inner">
                <h1>TA Form</h1>
                <label class="select">Select Date</label>
                <input type="date" name="date" placeholder="Date">

                <label class="select">From Headquarter</label>
                <select name="headquarter_id_own" id="headquarter_id0" onchange="Area(getAttribute('id'));" required>
                    <option value="">Choose any Headquarter</option>
                    @if(isset($headquarter) && count($headquarter) > 0)
                        @foreach ($headquarter as $val)
                            <option value="{{ $val->id }}">{{ $val->headquarter_name }}</option>
                        @endforeach
                    @endif
                </select>

            <label class="select">To Headquarter</label>
            <select name="headquarter_id" id="headquarter_id1" onchange="Area(getAttribute('id'));" required>
                <option value="">Choose any Headquarter</option>
                @if(isset($headquarter_all) && count($headquarter_all) > 0)
                @foreach ($headquarter_all as $val)
                    <option value="{{ $val->id }}">{{ $val->headquarter_name }}</option>
                @endforeach
                @endif
            </select>

                <label class="select">Area</label>
                        <select name="area_id[]" id="area_id" multiple>
                            <option value="0">Choose Station first</option>
                        </select>
                <label class="select">Station</label>
                        <select name="station" required>
                        <option value="">Choose Station</option>
                        <option value="1">X-Station</option>
                        <option value="2">Out-Station</option>
                        <option value="3">Headquarter</option>
                </select>
                        <button type="submit" onclick="return Submit()">Submit</button>
                    </div>
    </form>
    <script src="{{ url('/')}}/assets/workflow/js/jquery-3.5.1-min.js"></script>
    <script>
        function Area(id)
        {
            var suffix = id.match(/\d+/);
            var head = $('#headquarter_id'+suffix).val();
            $.ajax({
                type:"POST",
                url: "/ta-bill/areaTa",
                data: {'_token': "{{csrf_token()}}", 'headquarter_id':head},
                success: function(data)
                {
                    $('#area_id').html(data);
                }
            })
        }

        function Submit()
        {
            var x = confirm("Are you sure want to Submit!");
            if(x == true) { return true; } else { return false; }
        }
    </script>
  </body>
</html>
