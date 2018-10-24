<?php
session_start();
require ('Connection.php');
if(!isset($_SESSION["id"])){
    header("index.php");

}
else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="indexcss.css">
    <title>Home|Student</title>
</head>
<body>
        <!-- Student Nave Bar -->
<div class="sidenav">
<?php
        require ('navbar.php');?>   
            <a href="market.php">Market</a>
            <a href="portfolio.php">Portfolio</a>
            <a href="studentaccnt.php">Account Settings</a>
            <a href="Logout.php">Logout</a>
</div>
                <!-- Main Body -->
<div id="main">
<div class="bar">
  <!-- Search Form -->
        <form action="viewstocks.php" method="POST" >
                     <input list="search" name="search"  >
                     <datalist id="search">
                     <?php
                        include 'restapi.php';
                            foreach($metadata as $value){
                                echo '<option value="' .$value ->{'symbol'}.'">' .$value ->{'name'}.'</option>';
                            }
                    ?> 
                    </datalist>
                <input type="submit" value="search" class="btn btn-outline-secondary">
        </form>
</div>
           <h4>NEWS</h4>     
           <!-- News Side -->
        <div class="news">
        
                <div class="card-columns" id="output" >
                        
                </div>
        </div>
</div>
</body>
<script>
           fetch('https://newsapi.org/v2/top-headlines?country=ph&category=business&apiKey=9149b4162da34504994d970545d5e501')
            .then((res)=>res.json())
            .then((data)=>{
                let output='';
                data.articles.forEach(function(post){
                    output +=`
                        <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="${post.urlToImage}" alt="No image exist"> </img>
                        <div class="card-body">
                        <div class="card-block text-left">
                            <h5 class="card-title"> ${post.source.name}</h5>
                            <p><a href="${post.url}" class="text-secondary" > ${post.title}</a></p>
                        </div>
                        </div>
                        </div>
                    `;
                });
                document.getElementById('output').innerHTML=output;
            })
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</html>
<?php
}
?>