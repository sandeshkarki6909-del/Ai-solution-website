<?php
include "../config/database.php";

$success = "";
$error = "";

if(isset($_POST['submit']))
{
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $rating = mysqli_real_escape_string($conn,$_POST['rating']);
    $message = mysqli_real_escape_string($conn,$_POST['message']);

    if(empty($name) || empty($email) || empty($rating) || empty($message))
    {
        $error="Please fill in all fields.";
    }
    elseif(!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
        $error="Please enter a valid email address.";
    }
    else
    {
        $sql="INSERT INTO feedback
        (name,email,rating,message)
        VALUES
        ('$name','$email','$rating','$message')";

        if(mysqli_query($conn,$sql))
        {
            $success="Thank you! Your feedback has been submitted successfully.";
        }
        else
        {
            $error="Database Error : ".mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1">

<title>

Customer Feedback

</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

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

background:#f4f8fc;

}

/* Navigation */

.navbar{

background:#071330;

padding:15px 0;

}

.navbar-brand{

color:white!important;

font-size:28px;

font-weight:bold;

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

padding:8px 18px!important;

border-radius:30px;

}

/* Hero */

.hero{

background:linear-gradient(135deg,#071330,#1e3a8a,#2563eb);

padding:90px 0;

text-align:center;

color:white;

}

.hero h1{

font-size:50px;

font-weight:bold;

}

.hero p{

font-size:18px;

margin-top:20px;

}

/* Feedback Section */

.feedback-section{

padding:80px 0;

}

.feedback-card{

background:white;

padding:40px;

border-radius:20px;

box-shadow:0 10px 30px rgba(0,0,0,.08);

}

.feedback-card h3{

margin-bottom:30px;

font-weight:bold;

color:#071330;

}

.form-control,

.form-select{

height:50px;

border-radius:10px;

}

textarea.form-control{

height:auto;

}

.btn-submit{

width:100%;

background:#2563eb;

color:white;

padding:14px;

border:none;

border-radius:10px;

font-weight:600;

transition:.3s;

}

.btn-submit:hover{

background:#1d4ed8;

}

.info-box{

background:linear-gradient(135deg,#071330,#1e3a8a);

color:white;

padding:40px;

border-radius:20px;

height:100%;

}

.info-box h3{

margin-bottom:25px;

}

.info-box i{

color:#38bdf8;

margin-right:10px;

}

.info-box p{

margin-bottom:18px;

}

/* Footer */

.footer{

background:#020617;

color:white;

padding:60px 0;

margin-top:60px;

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

text-align:center;

margin-top:30px;

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

href="index.html">

Home

</a>

</li>

<li class="nav-item">

<a class="nav-link"

href="services.html">

Solutions

</a>

</li>

<li class="nav-item">

<a class="nav-link"

href="projects.html">

Portfolio

</a>

</li>

<li class="nav-item">

<a class="nav-link"

href="events.html">

Insights

</a>

</li>

<li class="nav-item">

<a class="nav-link"

href="gallery.html">

Gallery

</a>

</li>

<li class="nav-item">

<a class="nav-link active"

href="feedback.php">

Reviews

</a>

</li>

<li class="nav-item">

<a class="nav-link"

href="contact.php">

Contact

</a>

</li>

<li class="nav-item">

<a class="nav-link btn-admin"

href="admin-login.php">

Admin

</a>

</li>

</ul>

</div>

</div>

</nav>

<!-- Hero -->

<section class="hero">

<div class="container">

<h1>

Customer Feedback

</h1>

<p>

We appreciate your feedback and suggestions.
Your opinion helps us improve our AI services.

</p>

</div>

</section>

<!-- Feedback -->

<section class="feedback-section">

<div class="container">

<div class="row">

<div class="col-lg-7">

<div class="feedback-card">

<h3>

Share Your Experience

</h3>
<?php if($success!=""){ ?>

<div class="alert alert-success alert-dismissible fade show">

<?php echo $success; ?>

<button
type="button"
class="btn-close"
data-bs-dismiss="alert">
</button>

</div>

<?php } ?>

<?php if($error!=""){ ?>

<div class="alert alert-danger alert-dismissible fade show">

<?php echo $error; ?>

<button
type="button"
class="btn-close"
data-bs-dismiss="alert">
</button>

</div>

<?php } ?>

<form method="POST">

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">

Full Name

</label>

<input

type="text"

name="name"

class="form-control"

placeholder="Enter your full name"

required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Email Address

</label>

<input

type="email"

name="email"

class="form-control"

placeholder="Enter your email"

required>

</div>

</div>

<div class="mb-3">

<label class="form-label">

Rating

</label>

<select

name="rating"

class="form-select"

required>

<option value="">Choose Rating</option>

<option value="5">⭐⭐⭐⭐⭐ Excellent</option>

<option value="4">⭐⭐⭐⭐ Good</option>

<option value="3">⭐⭐⭐ Average</option>

<option value="2">⭐⭐ Poor</option>

<option value="1">⭐ Very Poor</option>

</select>

</div>

<div class="mb-4">

<label class="form-label">

Feedback Message

</label>

<textarea

name="message"

rows="6"

class="form-control"

placeholder="Write your feedback here..."

required></textarea>

</div>

<button

type="submit"

name="submit"

class="btn-submit">

<i class="fa-solid fa-paper-plane me-2"></i>

Submit Feedback

</button>

</form>

</div>

</div>

<!-- Right Side -->

<div class="col-lg-5">

<div class="info-box">

<h3>

Why Your Feedback Matters

</h3>

<p>

Your opinions help us improve our AI solutions and deliver better services to all our clients.

</p>

<hr>

<p>

<i class="fas fa-check-circle"></i>

Improve Customer Experience

</p>

<p>

<i class="fas fa-check-circle"></i>

Enhance AI Services

</p>

<p>

<i class="fas fa-check-circle"></i>

Improve Website Performance

</p>

<p>

<i class="fas fa-check-circle"></i>

Increase Customer Satisfaction

</p>

<hr>

<h4>

Contact Us

</h4>

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

<h4>

AI-Solutions

</h4>

<p>

Providing AI-powered software, web applications,
automation systems and digital transformation
solutions for modern businesses.

</p>

</div>

<div class="col-lg-4">

<h4>

Quick Links

</h4>

<a href="index.html">Home</a>

<a href="services.html">Solutions</a>

<a href="projects.html">Portfolio</a>

<a href="events.html">Insights</a>

<a href="gallery.html">Gallery</a>

<a href="feedback.php">Reviews</a>

<a href="contact.php">Contact</a>

</div>

<div class="col-lg-4">

<h4>

Follow Us

</h4>

<p><i class="fab fa-facebook me-2"></i>Facebook</p>

<p><i class="fab fa-instagram me-2"></i>Instagram</p>

<p><i class="fab fa-linkedin me-2"></i>LinkedIn</p>

<p><i class="fab fa-x-twitter me-2"></i>Twitter</p>

</div>

</div>

<div class="copyright">

© 2026 AI-Solutions | Innovate • Design • Transform

</div>

</div>

</footer>
<!-- ===================== -->
<!-- Floating AI Chatbot -->
<!-- ===================== -->

<button class="chat-btn" onclick="toggleChat()">
    💬
</button>

<div class="chat-container" id="chatContainer">

    <div class="chat-header">

        <span>🤖 AI Assistant</span>

        <button onclick="toggleChat()">✖</button>

    </div>

    <div class="chat-body">

        <div class="bot-message" id="chatResponse">

            Hello 👋<br><br>

            Welcome to <b>AI-Solutions</b>.<br>

            Ask me anything about our services.

        </div>

    </div>

    <div class="chat-footer">

        <input

        type="text"

        id="chatInput"

        placeholder="Type your question...">

        <button onclick="sendMessage()">

        Send

        </button>

    </div>

</div>

<style>

/* Chatbot */

.chat-btn{

position:fixed;

bottom:25px;

right:25px;

width:65px;

height:65px;

border:none;

border-radius:50%;

background:#2563eb;

color:white;

font-size:28px;

cursor:pointer;

box-shadow:0 10px 25px rgba(0,0,0,.25);

z-index:9999;

transition:.3s;

}

.chat-btn:hover{

transform:scale(1.1);

}

.chat-container{

position:fixed;

right:25px;

bottom:100px;

width:340px;

background:white;

border-radius:15px;

overflow:hidden;

display:none;

box-shadow:0 10px 30px rgba(0,0,0,.2);

z-index:9999;

}

.chat-header{

background:#071330;

color:white;

padding:15px;

display:flex;

justify-content:space-between;

align-items:center;

font-weight:bold;

}

.chat-header button{

background:none;

border:none;

color:white;

font-size:18px;

cursor:pointer;

}

.chat-body{

padding:20px;

height:220px;

overflow-y:auto;

background:#f8fafc;

}

.bot-message{

background:#e9f2ff;

padding:12px;

border-radius:10px;

line-height:1.6;

}

.chat-footer{

padding:15px;

background:white;

}

.chat-footer input{

width:100%;

padding:10px;

border:1px solid #ddd;

border-radius:8px;

margin-bottom:10px;

}

.chat-footer button{

width:100%;

padding:10px;

background:#2563eb;

color:white;

border:none;

border-radius:8px;

font-weight:bold;

}

</style>

<script>

function toggleChat(){

let chat=document.getElementById("chatContainer");

if(chat.style.display==="block"){

chat.style.display="none";

}

else{

chat.style.display="block";

}

}

const knowledge=[

{

keys:["hi","hello","hey"],

reply:"Hello 👋 Welcome to AI-Solutions."

},

{

keys:["services","service"],

reply:"We provide AI Development, Web Development, Software Development, Mobile App Development and IT Consultancy."

},

{

keys:["feedback"],

reply:"Thank you for visiting our feedback page. Your opinions help us improve our services."

},

{

keys:["contact"],

reply:"Please visit our Contact page or email us at info@aisolutions.com."

},

{

keys:["projects","portfolio"],

reply:"Our Portfolio page showcases completed AI and software projects."

},

{

keys:["gallery"],

reply:"The Gallery page displays company events and completed projects."

},

{

keys:["events"],

reply:"We regularly organise AI workshops and technology seminars."

},

{

keys:["price","pricing","cost"],

reply:"Pricing depends on your project requirements. Please contact us for a free quotation."

},

{

keys:["admin"],

reply:"Administrators can log in using the Admin Login page."

},

{

keys:["thank","thanks"],

reply:"You're welcome 😊"

},

{

keys:["bye"],

reply:"Thank you for visiting AI-Solutions. Have a wonderful day!"

}

];

function sendMessage(){

let input=document.getElementById("chatInput");

let text=input.value.toLowerCase().trim();

if(text==="") return;

let answer="Sorry, I couldn't understand your question.<br><br>Try asking about:<br>• Services<br>• Projects<br>• Contact<br>• Feedback<br>• Pricing<br>• Admin Login";

for(let item of knowledge){

if(item.keys.some(word=>text.includes(word))){

answer=item.reply;

break;

}

}

document.getElementById("chatResponse").innerHTML=answer;

input.value="";

}

document.getElementById("chatInput")

.addEventListener("keypress",function(e){

if(e.key==="Enter"){

sendMessage();

}

});

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>