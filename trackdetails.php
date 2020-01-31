<?php
$id = $_GET['id'];
$output = '';
$curlSession = curl_init();
curl_setopt($curlSession, CURLOPT_URL, 'http://localhost:5000/chain');
curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
$jsonData = json_decode(curl_exec($curlSession));
$thisrun=0;
if (!empty($jsonData)) {
    for ($i = 0;$i != $jsonData->length;$i++) {
        $t = $jsonData->chain;
        $time = $t[$i]->timestamp;
        $t = $t[$i]->transactions;
        for ($k = 0;$k != count($t);$k++) {
            $flag = 0;
            if ($t[$k]->TransactionId == $id) {
                $thisrun=1;
                $pricesplit = preg_split("/\,/", $t[$k]->price);
                $quantitysplit = preg_split("/\,/", $t[$k]->quantity);
                $flag = 1;
                $total = 0;
                $check = 0;
                $kl = 0;
                for ($ia = 0;$ia != sizeof($pricesplit);$ia++) {
                    $kl = (int)$pricesplit[$ia] * (int)$quantitysplit[$ia];
                    $total += $kl;
                }
                if (!empty($time) and !empty($t[$k]->TransactionId) and !empty($t[$k]->price) and !empty($t[$k]->quantity) and !empty($t[$k]->productname)) {
                    $output .= "
						<table class=\"table table-bordered\">
						<thead>
	        						<th>Date</th>
	        						<th>Transaction#</th>
	        						<th>Product Bought</th>
	        						<th>Quantity</th>
									<th>Individual Price</th>
									<th>Total Price</th>
	        					</thead>
	        					<tbody id='tbody'>";

                    $output .= "<tr><td>" . date('d/m/Y', $time) . "</td><td>" . $t[$k]->TransactionId . "</td><td>" . $t[$k]->productname . "</td><td>" . $t[$k]->quantity . "</td><td>Rs. " . $t[$k]->price . "</td>";
                    $check = 1;
                } else {
                    $check = 0;
                }
                if ($flag == 1 and $check == 1) {
                    $output .= "<td>Rs. " . $total . "</td></tr>";
                }
            }
        }
    }
    $output .= "</tbody></table>";
}
else
{
    $output .= "No Transaction with that id found";
}
    
if($thisrun==0){
    $output = "No Transaction with that id found";
}
curl_close($curlSession);
echo $output;
?>
