<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
<script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-xl-4">
            <form method="post" id="form1">
                @csrf
                <div class="form-group">
                    <label>Name : </label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label>Country : </label>
                    <select name="country" id="country" class="form-control">
                        <option>Select Country</option>
                        @foreach($data as $cdata)
                        <option value="{{$cdata->id}}">{{$cdata->country_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>State : </label>
                    <select name="state" id="state" class="form-control">
                        
                    </select>
                </div>

                <div class="form-group">
                    <label>City : </label>
                    <select name="city" id="city" class="form-control">
                        
                    </select>
                </div>
                <input type="submit" class="btn btn-success">
            </form>
        </div>
        <!-- form end -->

        <div class="col-xl-8">
            <table class="table table-striped" id="mytable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Country</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
<script>
    $(document).ready(function(){

        //state fetch
        $("#country").change(function(){
            var cid=$("#country").val();
            var _token=$("input[name=_token]").val();
            $.ajax({
                url : '/getState',
                type: 'POST',
                data:{cid:cid,_token:_token},
                success:function(data)
                {
                    $("#state").html(data);
                }
            });
        });

        //for city fetch
        $("#state").change(function(){
            var sid=$("#state").val();
            var _token=$("input[name=_token]").val();
            $.ajax({
                url : '/getCity',
                type: 'POST',
                data:{sid:sid,_token:_token},
                success:function(data)
                {
                    $("#city").html(data);
                }
            });
        });

        //insert form data
        $("#form1").on("submit",function(e){
            e.preventDefault();
            $.ajax({
                url: '/insert',
                type: 'POST',
                data: new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                success:function(data)
                {
                    $("#msg").html('Data Saved');
                    $("#form1").trigger('reset');
                }
            });
        });


        //for show data
        function show()
        {
            $.ajax({
                url : '/show',
                type: 'GET',
                success:function(data)
                {
                    var i;
                    var html="";
                    for(i=0;i<data.length;i++)
                    {
                        html+="<tr>"+
                                    "<td>"+data[i].sid+"</td>"+
                                    "<td>"+data[i].name+"</td>"+
                                    "<td>"+data[i].country_name+"</td>"+
                                    "<td>"+data[i].state_name+"</td>"+
                                    "<td>"+data[i].city_name+"</td>"+
                                    "<td><a href='/edit/"+data[i].sid+"' class='btn btn-info'>Edit</a></td>"+
                              "</tr>";
                    }
                    $("#mytable").append(html);
                }
            });
        }
        show();
    });
</script>
</body>
</html>