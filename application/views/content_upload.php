<div class="content row tracking">
	<div class="container">
		<div class="main">     
			<div class="row">     
				<div class="col-12">
				  <div class="title">
					  Upload Your <span class="yellowtitle">XLSX Data</span>
				  </div>
				</div>
			</div>
			<div class="row mb-5"> 			
				<div class="col-12">
				<form class="" method="post" enctype="multipart/form-data">
					<div class="form-group row form-group-lg">
					  <div class="col-6">
						<input class="form-control input-lg" id="ex2" name="lampiran" type="file" accept=".xlsx" required>
					  </div>
					  <div class="col-3">
						<input class="form-control btn btn-dark" name="submit" value="Submit" type="submit">
					  </div>
					</div>
				</form>
				</div> 
			</div>
			<div class="row mb-10"> 
				<div class="col-12">			
					<table class="table table-striped table-bordered table-responsive">
					  <thead class="thead-dark">
						<tr>
						  <th scope="col">#</th>
						  <th scope="col">TGL_PICKUP</th>
						  <th scope="col">TGL_BRGKT</th>
						  <th scope="col">SHIPPER</th>
						  <th scope="col">ORIGIN</th>
						  <th scope="col">DEST</th>
						  <th scope="col">PENERUSAN</th>
						  <th scope="col">AWB</th>
						  <th scope="col">COLLY</th>
						  <th scope="col">KETERANGAN_ISI</th>
						  <th scope="col">KG_VOL</th>
						  <th scope="col">KG_ACT</th>
						  <th scope="col">SERVICE</th>
						  <th scope="col">VIA</th>
						  <th scope="col">PENERIMA</th>
						  <th scope="col">TGL_TERIMA</th>
						  <th scope="col">KETERANGAN</th>
						</tr>
					  </thead>
					  <tbody>		
						<?php 
							if(isset($data) AND $data != null){
								$i = 1;
								
								foreach($data as $val){
									echo '<tr>';
									echo '<th scope="row">'.$i.'</th>';
									echo '<td>'.$val['TGL_PICKUP'].'</td>';
									echo '<td>'.$val['TGL_BRGKT'].'</td>';
									echo '<td>'.$val['SHIPPER'].'</td>';
									echo '<td>'.$val['ORIGIN'].'</td>';
									echo '<td>'.$val['DEST'].'</td>';
									echo '<td>'.$val['PENERUSAN'].'</td>';
									echo '<td>'.$val['AWB'].'</td>';
									echo '<td>'.$val['COLLY'].'</td>';
									echo '<td>'.$val['KETERANGAN_ISI'].'</td>';
									echo '<td>'.$val['KG_VOL'].'</td>';
									echo '<td>'.$val['KG_ACT'].'</td>';
									echo '<td>'.$val['SERVICE'].'</td>';
									echo '<td>'.$val['VIA'].'</td>';
									echo '<td>'.$val['PENERIMA'].'</td>';
									echo '<td>'.$val['TGL_TERIMA'].'</td>';
									echo '<td>'.$val['KETERANGAN'].'</td>';
									$i++;
									echo '</tr>';
								}
								
							}else{
								echo '<tr>';
								echo '<td class="text-center" colspan="10">';
								if(isset($notif) AND $notif != null){
									echo $notif;
								}else{
									echo 'no data';
								}
								echo '</td>';
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