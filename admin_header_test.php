<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Admin</title>
</head>
<body>

	<input type="checkbox" id="nav-toggle">
	<div class="sidebar">

		<div class="sidebar-brand">
			<h1>Put logo here</h1>
		</div>

		<div class="sidebar-menu">
			<ul>
				<li>
					<a href="admin.php">
						<span class="las la-igloo"></span>
						<span>Dashboard</span>
					</a>
				</li>

				<li>
					<a href="admin-orders.php">
						<span class="las la-shopping-bag"></span>
						<span>Account</span>
					</a>
				</li>

				<li>
					<a href="admin-products.php">
						<span class="las la-utensils"></span>
						<span>Set my schedule</span>
					</a>
				</li>

				<li>
					<a href="customer.php">
						<span class="las la-users"></span>
						<span>Announcement</span>
					</a>
				</li>

				<li>
					<a href="reports.php">
						<span class="las la-receipt"></span>
						<span>Unifast Grantee Records</span>
					</a>
				</li>

				<li>
					<a href="adminlogout.php">
						<span class="las la-user-circle"></span>
						<span>My Appointments</span>
					</a>
				</li>
				<li></li>

			</ul>
		</div>
	</div>

	<div class="main-content">
		<header>
				<h2>
					<label for="nav-toggle">
						<span class="fa fa-bars"></span>
					</label>
				</h2>

				<div class="user-wrapper">
					<span class="fa fa-user"></span>
					<small>Admin_</small>
					
				</div>
		</header>




<style>
    :root {
	--main-color: #222831;
	--color-dark: #1D2231;
	--text-grey: #555;
}

* {
	padding: 0;
	margin: 0;
	box-sizing: border-box;
	list-style-type: none;
	text-decoration: none;
	font-family: 'Poppins', sans-serif;
}

.sidebar {
	width: 300px;
	position: fixed;
	top: 0;
	left: 0;
	height: 100%;
	background: var(--main-color);
	z-index: 100;
	transition: width 300ms;
    background: green;
}
.sidebar-brand {
	height: 90px;
	color: #fff;
	text-align: center;
	line-height: 90px;
}
.sidebar-brand span {
	display: inline-block;
	padding-right: 1rem;
}
.sidebar-menu {
	margin-top: 80px;
    background: teal;
}
.sidebar-menu li{
	width: 100%;
	margin-bottom: 20px;
    background: brown;
}

.sidebar-menu a {
	padding-left: 1rem;
	color: #fff;
	font-size: 1rem;
}
.sidebar-menu a.active {
	background: #fff;
	padding-top: 1rem;
	padding-bottom: 1rem;
	color: var(--main-color);
	border-radius: 30px 0 0 30px;
}
.sidebar-menu a span:first-child {
	font-size: 1.5rem;
	padding-right: 1rem;
}
#nav-toggle:checked + .sidebar {
	width: 70px;
}
.sidebar-menu li{
	padding-left: 5px;
}
#nav-toggle:checked + .sidebar .sidebar-brand h2 span,
#nav-toggle:checked + .sidebar li a{
	padding-left: 1rem;
}

#nav-toggle:checked + .sidebar .sidebar-brand h2 span:last-child,
#nav-toggle:checked + .sidebar li a span:last-child {
	display: none;
}
#nav-toggle:checked ~ .main-content {
	margin-left: 70px;
}
#nav-toggle:checked ~ .main-content header{
	width: calc(100% - 70px);
	left: 70px;
	

}

.main-content {
	transition: margin-left 300ms;
	margin-left: 300px;
}

header {
	background: #fff;
	display: flex;
	justify-content: space-between;
	box-shadow: 2px 2px 5px rgba(0,0,0,0.2);
	position: fixed;
	left: 300px;
	width: calc(100% - 300px);
	top: 0;
	z-index: 100;
	transition: left 300ms;
	padding: 8px 20px;
}
.la-user {
	margin: 5px;
	font-size: 20px;
}

#nav-toggle {
	display: none;
}

header h2 {
	color: #222;
}
header label span {
	font-size: 1.7rem;
	padding-right: 1rem;
}

.user-wrapper {
	display: flex;
	align-items: center;
	margin-right: 3rem;
}

.user-wrapper small {
	display: inline-block;
	color: var(--text-grey);
}
</style>