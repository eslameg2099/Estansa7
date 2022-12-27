<!DOCTYPE html>
<html>
<head>
    <title>estansa7.com</title>
</head>
<body>

  <h3>{{ $details['title'] }}</h3>
  <img src="https://backend.estansa7.com/storage/8/logoee193b16.png"  width="250" height="250">

   
  

    <a href="{{url('https://est.ragabkalbida.com/api/verification/verify/'.$details['body'])}}">للتفعيل اضغط هنا</a>
    
    <p>Thank you {{ $details['user'] }} for use estansa7.com  </p>
</body>
</html>