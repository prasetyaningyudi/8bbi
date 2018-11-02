<div class="content row tracking">
	<div class="container">
		<div class="main">     
			<div class="row">     
				<div class="col-12">
				  <div class="title">
					  Enter your <span class="yellowtitle">Tracking #</span>
				  </div>
				</div>
			</div>
			<div class="row mb-5"> 			
				<div class="col-12">
				<form class="" method="post">
					<div class="form-group row form-group-lg">
					  <div class="col-6">
						<input class="form-control input-lg" id="ex2" name="track_numb" type="text" required>
					  </div>
					  <div class="col-3">
						<input class="form-control btn btn-dark" name="submit" value="TRACK" type="submit">
					  </div>
					</div>
				</form>
				</div> 
			</div>
			<div class="row mb-10"> 
				<div class="col-12">			
					<table class="table table-striped table-bordered table-responsive-lg">
					  <thead class="thead-dark">
						<tr>
						  <th scope="col">#</th>
						  <th scope="col">Tracking Number</th>
						  <th scope="col">Date</th>
						  <th scope="col">Time</th>
						  <th scope="col">Location</th>
						  <th scope="col">Status</th>
						  <th scope="col">Services</th>
						</tr>
					  </thead>
					  <tbody>		
						<?php 
							if(isset($data) AND $data != null){
								$i = 1;
								
								foreach($data as $val){
									echo '<tr>';
									echo '<th scope="row">'.$i.'</th>';
									echo '<td>'.$val->bbi_number.'</td>';
									echo '<td>'.$val->process_date.'</td>';
									echo '<td>'.$val->process_time.'</td>';
									echo '<td>'.$val->LOCATION_NAME.'</td>';
									echo '<td>'.$val->status.'</td>';
									echo '<td>'.$val->services.'</td>';
									$i++;
									echo '</tr>';
								}
								
							}else{
								echo '<tr>';
								echo '<td class="text-center" colspan="10">No Data</td>';
								echo '</tr>';
							}
						?>
					  </tbody>
					</table>			
				</div> 			 			
			</div> 			
		</div>  
	</div>  
</div>