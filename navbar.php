<nav id="sidebar" class='bg-transparent ' >
		
		<div class="sidebar-list">

				<a href="index.php?page=home" class="nav-item nav-home border border-warning bg-info text-white rounded-right mb-2"><span class='icon-field'><i class="fa fa-home"></i></span> Home</a>
				<a href="index.php?page=categories" class="nav-item nav-categories border border-warning bg-info text-white rounded-right mb-2"><span class='icon-field'><i class="fa fa-list"></i></span> Category List</a>
				<a href="index.php?page=voting_list" class="nav-item nav-voting_list nav-manage_voting border border-warning bg-info text-white rounded-right mb-2"><span class='icon-field'><i class="fa fa-poll-h"></i></span> Voting List</a>
				<?php if($_SESSION['login_type'] == 1): ?>
				<a href="index.php?page=users" class="nav-item nav-users border border-warning bg-info text-white rounded-right mb-2"><span class='icon-field'><i class="fa fa-users"></i></span> Users</a>
			<?php endif; ?>
		</div>
		<div class="container-fluid mt-5 p-3 nav-item nav-home border border-warning bg-danger text-white rounded-right">
		<div class="col-lg-12">
			<div class="text-white ">
				<b><a href="ajax.php?action=logout" class="text-white">
					<?php echo $_SESSION['login_name'] ?>
				</a></b>
			</div>
		</div>
	</div>

</nav>
<script>
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>