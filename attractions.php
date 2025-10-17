<?php
require 'db.php';
require 'header.php';

$attractions = $pdo->query("SELECT * FROM attractions WHERE status=1 ORDER BY id ASC")->fetchAll();
?>

<section class="py-5">
  <div class="container">
    <h2 class="mb-4 text-center">Popular Attractions</h2>
    <div class="row g-4">
      <?php foreach($attractions as $a): ?>
      <div class="col-md-4">
        <div class="card attraction-card shadow-sm h-100">
        <img src="images/<?php echo htmlspecialchars($a['image']); ?>" class="attraction-img card-img-top" alt="<?php echo htmlspecialchars($a['name']); ?>">  

          <div class="card-body d-flex flex-column">
            <h5 class="card-title"><?php echo htmlspecialchars($a['name']); ?></h5>
            <p class="card-text small"><?php echo htmlspecialchars($a['short_desc']); ?></p>
            <div class="mt-auto d-flex justify-content-between align-items-center">
              <strong>₹ <?php echo number_format($a['price'],2); ?></strong>
              <!--<a href="user_login.php" class="btn btn-sm btn-primary">Book</a> -->
              <button class="btn btn-sm btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#bookModal"
        data-attr-id="<?php echo $a['id']; ?>"
        data-attr-name="<?php echo htmlspecialchars($a['name']); ?>">
  Book
</button>
    
</button>

            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php require 'booking_modal.php'; ?>

<?php require 'footer.php'; ?>
<?php require 'footer.php'; ?>

<!-- Include Booking Modal -->
<?php include 'booking_modal.php'; ?>

<!-- Include Booking Script -->
<script>
var bookModal = document.getElementById('bookModal');
bookModal.addEventListener('show.bs.modal', function (event) {
  var button = event.relatedTarget;
  var attrId = button.getAttribute('data-attr-id');
  if (attrId) {
    document.getElementById('attractionSelect').value = attrId;
    calculateTotal();
  }
});

// --- Calculate Total Price ---
function calculateTotal() {
  var select = document.getElementById('attractionSelect');
  var ticketInput = document.getElementById('ticketCount');
  var totalPrice = document.getElementById('totalPrice');

  var price = parseFloat(select.options[select.selectedIndex]?.dataset.price || 0);
  var tickets = parseInt(ticketInput.value) || 0;
  var total = price * tickets;

  totalPrice.value = "₹ " + total.toFixed(2);
}

// Listen for changes
document.getElementById('attractionSelect').addEventListener('change', calculateTotal);
document.getElementById('ticketCount').addEventListener('input', calculateTotal);
</script>

