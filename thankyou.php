<style>
    *{
        margin: 0;
        padding: 0;
    }
    
.logo{
	margin-left: 50px;
	margin-top: 24px;
	box-shadow: 5px ;

}
.background{
	position: relative;
	background-color: white;
	box-shadow: 1px 1px 10px black;
	width: 100%;
	height: 80px;
	position: sticky;
	top: 0;
}
.email{
	display:flex;
	margin-top: 40px;
}
.email h6{
margin-top: 35px;
font-size: 20px;
margin-left: 50px;
	text-align: center;
}
.text h1{
text-align: center;
font-size: 75px;
margin-top: 40px;
}
.text h3{
margin-top: 20px;
text-align: center;
font-size: 35px;
}
.email_image{
margin-left: 300px;
justify-content: center;
}
.invoice{
	display:flex;
	margin-top: 40px;
}
.invoice h6{
margin-top: 35px;
font-size: 20px;
margin-left: 350px;
	text-align: center;
}
.invoice img{
	margin-left: 50px;
}
.invoice h6 a{
	color: black;
}
</style>
<?php $cart_id=$_GET['cart_id']; ?>
<div class="background">
    <div class="col-xl-3 col-lg-2 position-absolute">
        <div class="header__logo ">
            <a href="./index.php"><img class="logo"  src="img/logo.png" alt=""></a>
        </div>
    </div>
</div>

<div class="text">
    <h1>THANK YOU</h1>
    <h3>Your order was completed successfully.</h3>
</div>
<div class="email">
    <img src="adminpanel/image/email.jpg" class="email_image" width="160px" height="120px">
    <h6><span>An email receipt including the details about your order has been <br>sent to the email address provided.Please keep it for your records.</span></h6>

</div>
<div class="invoice">
    <h6><span>You can visit the My Account page at any time to check the status<br> of your order.Or click here to <a href="invoice.php?cart_id=<?php echo $cart_id; ?>">print a copy of your receipt.</a></span></h6>
    <img src="adminpanel/image/pdf.jpg" class="email_image" width="120px" height="120px">

</div>


