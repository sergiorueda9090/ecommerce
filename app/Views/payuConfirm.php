<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

	echo '<h2>Transaction Summary</h2>

	<table>

	<tr>

	<td>Transaction status</td>

	<td>'.$estadoTx.'</td>

	</tr>

	<tr>

	<tr>

	<td>Transaction ID</td>

	<td>'.$transactionId.'</td>

	</tr>

	<tr>

	<td>Reference sale</td>

	<td>'.$reference_pol.'</td>

	</tr>

	<tr>

	<td>Reference transaction</td>

	<td>'.$referenceCode.'</td>

	</tr>

	<tr>';

	if($pseBank != null) {

		echo '<tr>

		<td>cus </td>

		<td>'.$cus.' </td>

		</tr>

		<tr>

		<td>Bank </td>

		<td>'.$pseBank.' </td>

		</tr>';

    }

	echo '<tr>

	<td>total amount</td>

	<td>$'.number_format($TX_VALUE).'</td>

	</tr>

	<tr>

	<td>Currency</td>

	<td>'.$currency.'</td>

	</tr>

	<tr>

	<td>Description</td>

	<td>'.($extra1).'</td>

	</tr>

	<tr>

	<td>Entity:</td>

	<td>'.($lapPaymentMethod).'</td>

	</tr>

	<tr>

	<td>Products:</td>

	<td>'.($products).'</td>

	</tr>

	<tr>

	<td>Payu:</td>

	<td>'.($payu).'</td>

	</tr>

	</table>';
	
?>

</body>
</html>