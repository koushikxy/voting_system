<style>


	.candidate {
		margin: auto;
		width: 70vw;
		padding:0 60px;
		margin-bottom: 4em;
		border: 3px solid black;
		background: orange;

	}

	.candidate_name {
		margin: 4px;
		margin-left: 3.4em;
		margin-right: 3em;
		width: 100%;
	}

	.img-field {
		height: 8vh;
		width: 4.3vw;
		padding: .3em;
		background: black;
		position: absolute;
		left: -.7em;
		top: -.7em;
	}

	.candidate img {
		height: 100%;
		width: 100%;
		margin: auto;
	}

	.vote-field {
		position: absolute;
		padding: 11px;
		right: 0;
		bottom: -.4em;
	}
</style>

<div class="containe-fluid">
	<?php include('db_connect.php');
	$voting = $conn->query("SELECT * FROM voting_list where  is_default = 1 ");
	foreach ($voting->fetch_array() as $key => $value) {
		$$key = $value;
	}
	$votes = $conn->query("SELECT * FROM votes where voting_id = $id ");
	$v_arr = array();
	while ($row = $votes->fetch_assoc()) {
		if (!isset($v_arr[$row['voting_opt_id']]))
			$v_arr[$row['voting_opt_id']] = 0;

		$v_arr[$row['voting_opt_id']] += 1;
	}
	$opts = $conn->query("SELECT * FROM voting_opt where voting_id=" . $id);
	$opt_arr = array();
	while ($row = $opts->fetch_assoc()) {
		$opt_arr[$row['category_id']][] = $row;

	}

	?>
	<div class="row">
		<div class="col-lg-11 d-flex">
			<div class="card col-md-6 bg-danger mr-4 ml-4">
				<div class="card-body text-white">
					<h4><center><b>Total Voters</b></center></h4>
					<hr>
					<h3 class="text-center"><b>
							<?php echo $conn->query('SELECT * FROM users where type = 2 ')->num_rows ?>
						</b></h3>
				</div>
			</div>
			<div class="card col-md-6 bg-success ml-4">
				<div class="card-body text-white">
					<h4><center><b>Total Votes</b></center></h4>
					<hr>
					<h3 class="text-center"><b>
							<?php echo $conn->query('SELECT distinct(user_id) FROM votes where voting_id = ' . $id)->num_rows ?>
						</b></h3>
				</div>
			</div>
		</div>
	</div>

	<div class="row mt-4">
		<div class="col-lg-12">
			<div class="card border border-2 border-warning bg-light">
				<div class="card-body">
					<div class="text-center bg-warning p-4">
						<h3><b>
								<?php echo $title ?>
							</b></h3>
						<small><b>
								<?php echo $description; ?>
							</b></small>
					</div>
					<?php
					$cats = $conn->query("SELECT * FROM category_list where id in (SELECT category_id from voting_opt where voting_id = '" . $id . "' )");
					while ($row = $cats->fetch_assoc()):
						?>
						<hr>
						<div class="row mb-4">
							<div class="col-md-12">
								<div class="text-center">
									<h3><b>
											<?php echo $row['category'] ?>
										</b></h3>
								</div>
							</div>
						</div>
						<div class="row mt-3">
							<?php foreach ($opt_arr[$row['id']] as $candidate) {
								?>
								<div class="candidate" style="position: relative;">
									<div class="img-field">
										<img src="assets/img/<?php echo $candidate['image_path'] ?>" alt="">
									</div>
									<div class="candidate_name">
										<?php echo $candidate['opt_txt'] ?>
									</div>
									<div class="vote-field">
										<span class="badge badge-success">
											<large><b>
													<?php echo isset($v_arr[$candidate['id']]) ? number_format($v_arr[$candidate['id']]) : 0 ?>
												</b></large>
										</span>
									</div>
								</div>
							<?php } ?>
						</div>
					<?php endwhile; ?>
				</div>
			</div>

		</div>
	</div>
</div>

</div>
<script>

</script>