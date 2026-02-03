 if($lastName==""){
            echo "<script>alert('LastName is required')</script>";
          }elseif($email==""){
            echo "<script>alert('Email is required')</script>";
          }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
             echo "<script>alert('Format is invalid. ->  EX. nikulgohil4508@gmail.com')</script>";
          }elseif ($password=="") {
             echo "<script>alert('Password is required')</script>";
          }elseif (!(strlen($password) > 6)){
            echo "<script>alert('Password length must be more than 6')</script>";
          }elseif (!preg_match('/[a-zA-Z]/', $password)) {
            echo "<script>alert('Password contains letter')</script>";
          }elseif (!preg_match('/[\W_]/', $password)) {
            echo "<script>alert('Password contains One Special Charcater.')</script>";
          }elseif ($confirmPassword=="") {
            echo "<script>alert('Confirm password is required')</script>";
          }elseif ($password !== $confirmPassword) {
            echo "<script>alert('Password and Confirm-Password does not match')</script>";
          }elseif($addres==""){
            echo "<script>alert('Address is required')</script>";
          }elseif ($phoneNumber=="") {
            echo "<script>alert('Phone-Number is required')</script>";
          }elseif(!(strlen($phoneNumber) == 10)){
            echo "<script>alert('Phone-Number is Must 10 DIGIT')</script>";
          }elseif ($gender=="") {
            echo "<scipt>alert('Gender is required')</script>";
          }elseif ($country=="") {
            echo "<script>alert('country is required')</script>";
          }elseif ($hobby=="") {
             echo "<script>alert('hobby is required')</script>";
          }elseif($image==""){
            echo "<script>alert('Image is required to upload')</script>";
          }
          else{