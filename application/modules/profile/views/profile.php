

<div class="container">
	<div class="row p-2">
		<h2 class="text-center">Profile Admin <?= getenv('APP_NAME');?></h2>

		<div class="col-md-12 p-3 card">
			<table class="table">
				<thead>
				<tr>
					<th scope="col">Nama</th>
					<th scope="col">Tahun</th>
					<th scope="col">Nama Panggilan</th>
					<th scope="col">Contact Person</th>
				</tr>
				</thead>
				<tbody>
			<?php
			foreach (get_admin() as $item) {
echo '
    <tr>
    <td>'.$item['nama'].'</td>
      <td>'.$item['tahun'].'</td>
      <td>'.$item['nama_panggilan'].'</td>
      <td>'.$item['contact'].'</td>
    </tr>';
			}
			
			?>
				</tbody>
			</table>
		</div>

	</div>
</div>

