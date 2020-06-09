<table class="table table-striped table-sm table-hover w-100">
	<tbody>
		<tr>
			<th class="w-25">Car Name</th>
			<td class="w-75"><?php echo $title ?></td>
		</tr>
		<tr>
			<th class="w-25">Price</th>
			<td class="w-75">Rp. <?php echo number_format($payment_price) ?></td>
		</tr>
		<tr>
			<th class="w-25">Time</th>
			<td class="w-75"><?php echo $time." ".$unit ?></td>
		</tr>
	</tbody>
</table>