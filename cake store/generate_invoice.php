<?php
// Include the TCPDF library
require_once('tcpdf/tcpdf.php');

@include 'config.php';

session_start();

$user_id = (isset($_SESSION['user_id']))?$_SESSION['user_id']:'';

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Invoice');
$pdf->SetSubject('Invoice');
$pdf->SetKeywords('Invoice, TCPDF, PHP');

// Remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', '', 10);

// Retrieve orders data
$select_orders = $conn->prepare("SELECT * FROM `orders` WHERE id = ?");
$select_orders->execute([$_GET['order_id']]);

// Check if there are orders
if($select_orders->rowCount() > 0) {
    while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) { 
        // Add order details to PDF
        $html = '<h2>Invoice</h2>';
        $html .= '<hr>';
        $html .= '<p><strong>Placed on:</strong> ' . $fetch_orders['placed_on'] . '</p>';
        $html .= '<p><strong>Name:</strong> ' . $fetch_orders['name'] . '</p>';
        $html .= '<p><strong>Number:</strong> ' . $fetch_orders['number'] . '</p>';
        $html .= '<p><strong>Email:</strong> ' . $fetch_orders['email'] . '</p>';
        $html .= '<p><strong>Address:</strong> ' . $fetch_orders['address'] . '</p>';
        $html .= '<p><strong>Payment Method:</strong> ' . $fetch_orders['method'] . '</p>';
        $html .= '<p><strong>Your Orders:</strong> ' . $fetch_orders['total_products'] . '</p>';
        $html .= '<p><strong>Total Price:</strong> ' . $fetch_orders['total_price'] . '/-</p>';
        $html .= '<p><strong>Payment Status:</strong> <span style="color:' . ($fetch_orders['payment_status'] == 'pending' ? 'red' : 'green') . ';">' . $fetch_orders['payment_status'] . '</span></p>';
        
        // Add order details to PDF
        $pdf->writeHTML($html, true, false, true, false, '');
        
        // Add a new page for the next order
        $pdf->AddPage();
    }
} else {
    // If no orders are found
    $pdf->writeHTML('<p>No orders placed yet!</p>', true, false, true, false, '');
}

// Close and output PDF document
$pdf->Output('invoice.pdf', 'D');

?>
