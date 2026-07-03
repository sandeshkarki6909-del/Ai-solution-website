<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors',1);

include "../config/database.php";

$message="";
$error_message="";

if(isset($_POST['submit']))
{
    $fullname=mysqli_real_escape_string($conn,$_POST['fullname']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $phone=mysqli_real_escape_string($conn,$_POST['phone']);
    $company=mysqli_real_escape_string($conn,$_POST['company']);
    $country=mysqli_real_escape_string($conn,$_POST['country']);
    $job_title=mysqli_real_escape_string($conn,$_POST['job_title']);
    $job_details=mysqli_real_escape_string($conn,$_POST['job_details']);

    if(empty($fullname)||empty($email)||empty($phone)||empty($company)||empty($country)||empty($job_title)||empty($job_details))
    {
        $error_message="All fields are required!";
    }
    elseif(!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
        $error_message="Invalid Email Address";
    }
    else
    {
        $sql="INSERT INTO contacts
        (name,email,phone,company,country,job_title,job_details,created_at)
        VALUES
        ('$fullname','$email','$phone','$company','$country','$job_title','$job_details',NOW())";

        if(mysqli_query($conn,$sql))
        {
            $message="Inquiry submitted successfully.";
        }
        else
        {
            $error_message=mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Contact Us | AI-Solutions</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Segoe UI',sans-serif;
}

body{
background:#f5f8fc;
}

/* Navigation */

.navbar{

background:#071330;

padding:15px 0;

}

.navbar-brand{

font-size:28px;

font-weight:bold;

color:white!important;

}

.nav-link{

color:white!important;

margin-left:18px;

}

.nav-link:hover{

color:#38bdf8!important;

}

.btn-admin{

background:#2563eb;

border-radius:30px;

padding:8px 20px!important;

}

/* Hero */

.hero{

background:linear-gradient(135deg,#071330,#1E3A8A,#2563EB);

padding:90px 0;

color:white;

text-align:center;

}

.hero h1{

font-size:52px;

font-weight:700;

}

.hero p{

margin-top:20px;

font-size:18px;

color:#dbeafe;

}

/* Contact Cards */

.contact-info{

margin-top:-60px;

position:relative;

z-index:10;

}

.info-card{

background:white;

padding:30px;

border-radius:15px;

box-shadow:0 10px 30px rgba(0,0,0,.08);

text-align:center;

transition:.3s;

height:100%;

}

.info-card:hover{

transform:translateY(-8px);

}

.info-card i{

font-size:40px;

color:#2563EB;

margin-bottom:20px;

}

.info-card h5{

font-weight:600;

}

/* Form */

.contact-section{

padding:80px 0;

}

.contact-form{

background:white;

padding:40px;

border-radius:20px;

box-shadow:0 10px 30px rgba(0,0,0,.08);

}

.contact-form h3{

margin-bottom:25px;

font-weight:700;

color:#071330;

}

.form-control{

height:50px;

border-radius:10px;

}

textarea.form-control{

height:auto;

}

.btn-send{

background:#2563EB;

color:white;

padding:14px;

border:none;

border-radius:10px;

font-weight:600;

width:100%;

transition:.3s;

}

.btn-send:hover{

background:#1d4ed8;

}

/* Company */

.company-box{

background:linear-gradient(135deg,#071330,#1E3A8A);

color:white;

padding:40px;

border-radius:20px;

height:100%;

}

.company-box h3{

margin-bottom:20px;

}

.company-box i{

margin-right:10px;

color:#38bdf8;

}

.company-box p{

margin-bottom:20px;

}

/* Footer */

.footer{

background:#020617;

color:white;

padding:60px 0;

}

.footer a{

display:block;

color:#cbd5e1;

text-decoration:none;

margin-bottom:10px;

}

.footer a:hover{

color:#38bdf8;

}

.copyright{

margin-top:30px;

text-align:center;

color:#94a3b8;

}

</style>

</head>

<body>

<!-- Navigation -->

<nav class="navbar navbar-expand-lg">

<div class="container">

<a class="navbar-brand"
href="index.html">

AI-Solutions

</a>

<button class="navbar-toggler"
data-bs-toggle="collapse"
data-bs-target="#menu">

<span class="navbar-toggler-icon"></span>

</button>

<div class="collapse navbar-collapse"
id="menu">

<ul class="navbar-nav ms-auto">

<li class="nav-item">
<a class="nav-link"
href="index.html">Home</a>
</li>

<li class="nav-item">
<a class="nav-link"
href="services.html">Solutions</a>
</li>

<li class="nav-item">
<a class="nav-link"
href="projects.html">Portfolio</a>
</li>

<li class="nav-item">
<a class="nav-link"
href="events.html">Insights</a>
</li>

<li class="nav-item">
<a class="nav-link"
href="gallery.html">Gallery</a>
</li>

<li class="nav-item">
<a class="nav-link"
href="feedback.php">Reviews</a>
</li>

<li class="nav-item">
<a class="nav-link active"
href="contact.php">Contact</a>
</li>

<li class="nav-item">
<a class="nav-link btn-admin"
href="admin-login.php">Admin</a>
</li>

</ul>

</div>

</div>

</nav>

<!-- Hero -->

<section class="hero">

<div class="container">

<h1>Contact AI-Solutions</h1>

<p>

Let's discuss your next AI project.
We're here to help your business grow.

</p>

</div>

</section>

<!-- Contact Cards -->

<div class="container contact-info">

<div class="row g-4">

<div class="col-md-3">

<div class="info-card">

<i class="fas fa-phone"></i>

<h5>Phone</h5>

<p>+61 400 123 456</p>

</div>

</div>

<div class="col-md-3">

<div class="info-card">

<i class="fas fa-envelope"></i>

<h5>Email</h5>

<p>info@aisolutions.com</p>

</div>

</div>

<div class="col-md-3">

<div class="info-card">

<i class="fas fa-location-dot"></i>

<h5>Location</h5>

<p>Kathmandu, Nepal</p>

</div>

</div>

<div class="col-md-3">

<div class="info-card">

<i class="fas fa-headset"></i>

<h5>Support</h5>

<p>24 / 7 Assistance</p>

</div>

</div>

</div>

</div>

<!-- Contact Section -->

<section class="contact-section">

<div class="container">

<div class="row">

<div class="col-lg-7">

<div class="contact-form">

<h3>

Send Us Your Inquiry

</h3>
<?php if($message != ""){ ?>
<div class="alert alert-success alert-dismissible fade show">
    <?php echo $message; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php } ?>

<?php if($error_message != ""){ ?>
<div class="alert alert-danger alert-dismissible fade show">
    <?php echo $error_message; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php } ?>

<form action="" method="POST">

<div class="row">

<div class="col-md-6 mb-3">
<label>Full Name</label>
<input
type="text"
name="fullname"
class="form-control"
placeholder="Enter Full Name"
required>
</div>

<div class="col-md-6 mb-3">
<label>Email Address</label>
<input
type="email"
name="email"
class="form-control"
placeholder="Enter Email Address"
required>
</div>

</div>

<div class="row">

<div class="col-md-6 mb-3">
<label>Phone Number</label>
<input
type="text"
name="phone"
class="form-control"
placeholder="Phone Number"
required>
</div>

<div class="col-md-6 mb-3">
<label>Company</label>
<input
type="text"
name="company"
class="form-control"
placeholder="Company Name"
required>
</div>

</div>

<div class="row">

<div class="col-md-6 mb-3">
<label>Country</label>
<input
type="text"
name="country"
class="form-control"
placeholder="Country"
required>
</div>

<div class="col-md-6 mb-3">
<label>Job Title</label>
<input
type="text"
name="job_title"
class="form-control"
placeholder="Job Title"
required>
</div>

</div>

<div class="mb-4">

<label>Project Details</label>

<textarea
name="job_details"
rows="6"
class="form-control"
placeholder="Describe your project requirements..."
required></textarea>

</div>

<button
type="submit"
name="submit"
class="btn-send">

Submit Inquiry

</button>

</form>

</div>

</div>

<!-- Company Information -->

<div class="col-lg-5">

<div class="company-box">

<h3>

Why Choose AI-Solutions?

</h3>

<p>

We specialise in Artificial Intelligence,
Software Development,
Web Development and
Digital Transformation solutions.

</p>

<p>

<i class="fas fa-check-circle"></i>

Professional Developers

</p>

<p>

<i class="fas fa-check-circle"></i>

AI & Automation Experts

</p>

<p>

<i class="fas fa-check-circle"></i>

Secure Database Systems

</p>

<p>

<i class="fas fa-check-circle"></i>

24/7 Technical Support

</p>

<hr>

<h5>

Contact Information

</h5>

<p>

<i class="fas fa-envelope"></i>

info@aisolutions.com

</p>

<p>

<i class="fas fa-phone"></i>

+61 400 123 456

</p>

<p>

<i class="fas fa-location-dot"></i>

Kathmandu, Nepal

</p>

</div>

</div>

</div>

</div>

</section>
<!-- Footer -->

<footer class="footer">

<div class="container">

<div class="row">

<div class="col-lg-4">

<h4>AI-Solutions</h4>

<p>

We provide AI-powered software,
web development, automation,
and digital transformation
solutions for modern businesses.

</p>

</div>

<div class="col-lg-4">

<h4>Quick Links</h4>

<a href="index.html">Home</a>

<a href="services.html">Solutions</a>

<a href="projects.html">Portfolio</a>

<a href="events.html">Insights</a>

<a href="gallery.html">Gallery</a>

<a href="feedback.php">Reviews</a>

<a href="contact.php">Contact</a>

</div>

<div class="col-lg-4">

<h4>Follow Us</h4>

<p>

<i class="fab fa-facebook"></i>
Facebook

</p>

<p>

<i class="fab fa-instagram"></i>
Instagram

</p>

<p>

<i class="fab fa-linkedin"></i>
LinkedIn

</p>

<p>

<i class="fab fa-x-twitter"></i>
Twitter

</p>

</div>

</div>

<div class="copyright">

© 2026 AI-Solutions |
Innovate • Develop • Transform

</div>

</div>

</footer>

<!-- Chatbot -->

<button
class="chat-btn"
onclick="openChat()">

💬

</button>

<div
class="chat-box"
id="chatBox">

<div class="chat-header">

🤖 AI Assistant

</div>

<div class="chat-body">

<p id="reply">

Hello 👋<br>

Welcome to AI-Solutions.<br>

How may I help you today?

</p>

<input

type="text"

id="question"

placeholder="Ask me anything...">

<button onclick="sendMessage()">

Send

</button>

</div>

</div>

<style>

.chat-btn{

position:fixed;

right:25px;

bottom:25px;

width:65px;

height:65px;

border:none;

border-radius:50%;

background:#2563EB;

color:white;

font-size:26px;

box-shadow:0 10px 25px rgba(0,0,0,.3);

z-index:999;

}

.chat-box{

position:fixed;

right:25px;

bottom:100px;

width:340px;

display:none;

background:white;

border-radius:15px;

overflow:hidden;

box-shadow:0 10px 35px rgba(0,0,0,.2);

z-index:999;

}

.chat-header{

background:#2563EB;

color:white;

padding:15px;

font-weight:bold;

}

.chat-body{

padding:20px;

}

.chat-body p{

background:#f1f5f9;

padding:12px;

border-radius:10px;

}

.chat-body input{

width:100%;

padding:10px;

margin-top:15px;

border:1px solid #ddd;

border-radius:8px;

}

.chat-body button{

margin-top:10px;

width:100%;

padding:10px;

background:#2563EB;

border:none;

color:white;

border-radius:8px;

}

</style>

<script>

function openChat(){

let chat=document.getElementById("chatBox");

chat.style.display=
chat.style.display==="block"
?
"none"
:
"block";

}

const knowledge=[

{

keywords:["hello","hi","hey"],

answer:"Hello 👋 Welcome to AI-Solutions."

},

{

keywords:["services","service"],

answer:"We provide AI Development, Web Development, Software Development and IT Consultancy."

},

{

keywords:["contact"],

answer:"You can contact us by completing the inquiry form on this page."

},

{

keywords:["price","cost","quotation"],

answer:"Please submit your project details through the contact form for a free quotation."

},

{

keywords:["projects","portfolio"],

answer:"Please visit our Portfolio page to explore our completed projects."

},

{

keywords:["gallery"],

answer:"Our Gallery showcases project images, workshops and company events."

},

{

keywords:["feedback"],

answer:"You can submit your review from the Reviews page."

},

{

keywords:["events"],

answer:"We organise AI workshops and digital technology events."

},

{

keywords:["admin"],

answer:"Administrators can securely log in through the Admin Login page."

},

{

keywords:["bye","thanks"],

answer:"Thank you for visiting AI-Solutions. Have a wonderful day! 😊"

}

];

function sendMessage(){

let input=document.getElementById("question");

let text=input.value.toLowerCase();

let answer="Sorry, I couldn't understand your question.";

for(let item of knowledge){

if(item.keywords.some(word=>text.includes(word))){

answer=item.answer;

break;

}

}

document.getElementById("reply").innerHTML=answer;

input.value="";

}

document
.getElementById("question")
.addEventListener("keypress",function(e){

if(e.key==="Enter"){

sendMessage();

}

});

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>