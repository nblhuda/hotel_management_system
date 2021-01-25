<html>
    <head>
    <style>    
* {    
  box-sizing: border-box;    
}    
.page-body{
            margin: 0;
            padding: 50px 200px;
            background-image: url(Background4.jpg);
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
  body {        
        height: auto;
        margin : 0;
        /* Center and scale the image nicely */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    input[type=text], select, textarea {    
    width: 100%;    
    padding: 12px;    
    border: 1px solid rgb(70, 68, 68);    
    border-radius: 4px;    
    resize: vertical;    
    }    
    input[type=email], select, textarea {    
    width: 100%;    
    padding: 12px;    
    border: 1px solid rgb(70, 68, 68);    
    border-radius: 4px;    
    resize: vertical;    
    }    
        
    label {    
    padding: 12px 12px 12px 0;    
    display: inline-block;    
    }    
        
    input[type=submit] {    
    background-color: rgb(37, 116, 161);    
    color: white;    
    padding: 12px 20px;    
    border: none;    
    border-radius: 4px;    
    cursor: pointer;    
    float: right;    
    }    
        
    input[type=submit]:hover {    
    background-color: #45a049;    
    }    
        
    .container1 {    
    border-radius: 5px;    
    background-color: #f2f2f2;    
    padding: 50px;    
    }    
        
    .col-25 {    
    float: left;    
    width: 25%;    
    margin-top: 6px;    
    }    
        
    .col-75 {    
    float: left;    
    width: 75%;    
    margin-top: 6px;    
    }    
        
    /* Clear floats after the columns */    
    .row:after {    
    content: "";    
    display: table;    
    clear: both;    
    }    
 
    
/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */    
</style>  
    </head>
    <body>
        <!-- Masthead-->
        <header class="masthead" style="display : block">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-10 align-self-end mb-4" style="background: #0000002e;">
                        <h1 class="text-uppercase text-white font-weight-bold">Feedback</h1>
                        <hr class="divider my-4" />
                    </div>
                </div>
            </div>
        </header>


        <div class="page-body">
            <h2 style="color:white; text-align:center">FEEDBACK FORM</h2>    
            <div class="container1"> 
            <form  action="" id="manage-feedback" >    

                <div class="row">
                    Please help us to serve you better by taking a couple of minutes.   <br><br>
                </div>

                <div class="row" style="color:#5756CE">
                    How satisfied were you with our Service?   
                </div>
                <div class="row">    
                    <div class="col-25">    
                        <label for="rate">Rate</label>    
                    </div> 

                    <div class="col-75">    
                        <input type="radio" id="excellent" name="rate" value="4">
                        <label for="excellent">Excellent</label><br>
                        <input type="radio" id="good" name="rate" value="3">
                        <label for="good">Good</label><br>
                        <input type="radio" id="neutral" name="rate" value="2">
                        <label for="neutral">Neutral</label><br>
                        <input type="radio" id="poor" name="rate" value="1">
                        <label for="poor">Poor</label>
                    </div>    
                </div>    

                <div class="row" style="color:#5756CE">   
                        If you have specific feedback, please write to us...
                </div>
                <div class="row">   
                    <div class="col-25">   
                 
                    <label for="feedback">Feedback</label>    
                </div>    
                <div class="col-75">    
                    <textarea id="feedback" name="feedback" placeholder="Write something.." style="height:200px"></textarea>    
                </div>    
                </div>    
                <div class="row">    
                <input type="submit" value="Submit">    
                </div>    
            </form>    
            </div>  
            </div>
    </body>

</html>

<!-- js function -->
<script>
	
	// save the data to database function
	$('#manage-feedback').submit(function(e){
		e.preventDefault()
		start_load()		
		$.ajax({
			url:'admin/ajax.php?action=save_feedback',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){	
				console.log(resp)
				if(resp>0)
				{
					alert_toast("Thank you for your feedback!",'success')
					setTimeout(function(){
						location.reload()
					},1500)	
				}												
			}
		})
	})
</script>