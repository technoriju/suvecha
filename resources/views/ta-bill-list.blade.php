<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TA Tables</title>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans">


    <style>
 table {
  border: 1px solid #ccc;
  border-collapse: collapse;
  margin: 0;
  padding: 0;
  width: 100%;
  table-layout: fixed;
}

table caption {
  font-size: 1.5em;
  margin: .5em 0 .75em;
}

table tr {
  background-color: #f8f8f8;
  border: 1px solid #ddd;
  padding: .35em;
}

table th,
table td {
  padding: .625em;
  text-align: center;
}

table th {
  font-size: .85em;
  letter-spacing: .1em;
  text-transform: uppercase;
}

@media screen and (max-width: 600px) {
  table {
    border: 0;
  }

  table caption {
    font-size: 1.3em;
  }

  table thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }

  table tr {
    border-bottom: 3px solid #ddd;
    display: block;
    margin-bottom: .625em;
  }

  table td {
    border-bottom: 1px solid #ddd;
    display: block;
    font-size: .8em;
    text-align: right;
  }

  table td::before {

    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }

  table td:last-child {
    border-bottom: 0;
  }
}

body {
  font-family: "Open Sans", sans-serif;
  line-height: 1.25;
}
span{
  padding-bottom: 10px;
}
    </style>
  </head>
  <body>
<table>
  <center><h2>TA Data</h2></center>
  <h4>
    <form action="" method="post">
    Date <input type="date" name="dateFrom">
    To <input type="date" name="dateTo">
    Role <select name="role">
        <option value="">Select any Role</option>
        @if(isset($role) && count($role)>0)
        @foreach($role as $val2)
           <option value="{{$val2->id}}">{{$val2->name}}</option>
        @endforeach
        @endif
        </select>
    Employee <select name="emp">
        <option value="">Select any Employee</option>
        @if(isset($employee) && count($employee)>0)
        @foreach($employee as $val3)
            <option value="{{$val3->id}}">{{$val3->employee_name}}</option>
        @endforeach
        @endif
         </select>
     <button>Search</button>
    </form>
  </h4>
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Date</th>
      <th scope="col">From Headquarter</th>
      <th scope="col">To Headquarter</th>
      <th scope="col">Area</th>
      <th scope="col">Station</th>
      <th scope="col">Kilometer</th>
      <th scope="col">Amount</th>

    </tr>
  </thead>
  <tbody>
    @if(isset($data) && count($data)>0)
    @foreach($data as $val)
    @php
        $hq2 = '';
        $list = AreaList2($val->area_id);
        foreach($list as $hq):
        $hq2 .= $hq->area_name.' | ';
        endforeach;
    @endphp
    <tr>
      <td data-label="Date">{{$val->employee_name}}</td>
      <td data-label="Date">{{$val->date}}</td>
      <td data-label="From Headquarter">{{$val->headown}}</td>
      <td data-label="To Headquarter">{{$val->headquarter_name}}</td>
      <td data-label="Area">{{$hq2}}</td>
      <td data-label="Station">{{($val->station == 3)?'Headquarter':(($val->station == 1)?'X-Station':'Out-Station')}}</td>
      <td data-label="Kilometer">{{$val->distance}}</td>
      <td data-label="Amount">{{$val->total_amount}}</td>
    </tr>
    @endforeach
    @endif
    {{-- <tr>
    <td data-label="Date">04/01/2016</td>
      <td data-label="From Headquarter">Kolkata</td>
      <td data-label="To Headquarter">Delhi</td>
      <td data-label="Area">03/01/2016 - 03/31/2016</td>
      <td data-label="Station">outtation</td>
      <td data-label="Kilometer">2km</td>
      <td data-label="Amount">100Rs</td>
    </tr>
    <tr>
     <td data-label="Date">04/01/2016</td>
      <td data-label="From Headquarter">Kolkata</td>
      <td data-label="To Headquarter">Delhi</td>
      <td data-label="Area">03/01/2016 - 03/31/2016</td>
      <td data-label="Station">Intation</td>
      <td data-label="Kilometer">2km</td>
      <td data-label="Amount">100Rs</td>
    </tr> --}}
  </tbody>

</table>
  </body>
</html>
