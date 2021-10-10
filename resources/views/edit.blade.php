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
	<div class="col-xl-6">
		<form method="post">
			@csrf
			<div class="form-group">
				<label>Name : </label>
				<input type="text" name="name" id="name" class="form-control" value="{{$data[0]->name}}">
			</div>
			<div class="form-group">
				<label>Country : </label>
				<select name="country" id="country" class="form-control">
					<option>Select Country</option>
					@foreach($country_data as $clist)
						<option value="{{$clist->id}}" 
						@if($data[0]->country==$clist->id)
							{{'selected'}}
						@endif
						>{{$clist->country_name}}</option>
					@endforeach
				</select>
			</div>

			<div class="form-group">
				<label>State : </label>
					<select name="state" id="state" class="form-control">
						<option>Select State</option>
						@foreach($state_data as $slist)
						<option value="{{$slist->id}}"
						@if($data[0]->state==$slist->id)
						{{'selected'}}
						@endif	
						>{{$slist->state_name}}</option>
						@endforeach
					</select>
			</div>

			<div class="form-group">
				<label>City : </label>
				<select name="city" id="city" class="form-control">
					<option>Select City</option>
					@foreach($city_data as $clist)
					<option value="{{$clist->id}}"
					@if($data[0]->city==$clist->id)
					{{'selected'}}
					@endif	
					>{{$clist->city_name}}</option>
					@endforeach
				</select>
			</div>
		</form>
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
	});
</script>
</body>
</html>