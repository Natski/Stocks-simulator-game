<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="regis.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Create Account</title>
</head>
<body>

<div class="body1">
      
    <div class="modal-content ">
            <h4>Registration</h4>
            <div class="col-6 form-input inside">
                   
                <form method="POST" action="regs.php">
                <div class="form-group">
                    <input type="text" name="student" class="form-control" placeholder="Student Number" required>
                </div>

                <div class="form-group">
                <input type="text" name="sfname" class="form-control" placeholder="Input First Name" required>
                </div>

                <div class="form-group">
                <input type="text" name="sinitial" class="form-control" placeholder="Input Middle initial" required>
                </div>

                <div class="form-group">
                <input type="text" name="slname" class="form-control" placeholder="Input Last Name" required>
                </div>

                <div class="form-group" class="form-control">
                <select  name="sec" id="sec" class="form-control" >
                    <option value="3-AFM">3-AFM</option>
                    <option value="3-BFM">3-BFM</option>
                    <option value="3-CFM">3-CFM</option>
                </select>
                </div>

                <div>
                <label class="text-info" for="">If your Section is not on the list please check</label>
                <label class="text-info"> Checkbox: <input type="checkbox" id="myCheck"  onclick="myFunction()"></label>
                </div>

                <div class="form-group">
                <input type="text" id="section" class="form-control" name="sec" disabled style="display:none" placeholder="Input your Course Section" required>
                </div>

                <div class="form-group">
                <input type="password" name="spass" class="form-control" placeholder="Input Password" required>
                </div>

                <div class="form-group">
                <input type="password" name="sren" class="form-control" placeholder="Re-Enter Password" required>
                </div>

                <input type="Submit" class="btn btn-success btn-block" value="Register"><br>
                <input type="reset" class=" col-sm-5 btn btn-danger " style="margin-left: 10px;">
                <input type="button" onclick="location.href='index.php';" class="col-sm-5  btn btn-primary " value="Back to Login" style="margin-left: 50px;">

            </form>
        </div>
            
        </div>
    </div>
</div>
</body>
<script>
		function myFunction() {
			var checkBox = document.getElementById("myCheck");
			var text = document.getElementById("section");
			if (checkBox.checked == true){
				text.style.display = "block";
				document.getElementById("sec").style.display = "none";
				document.getElementById("sec").disabled = true;
				document.getElementById("section").disabled = false;
			} else {
			   text.style.display = "none";
			   document.getElementById("sec").style.display = "block";
			   document.getElementById("section").disabled = true;
			   document.getElementById("sec").disabled = false;
			}
		}
		</script>
</html>