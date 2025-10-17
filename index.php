<?php
// index.php
require 'db.php';
$attractions = $pdo->query("SELECT * FROM attractions WHERE status=1 ORDER BY id ASC")->fetchAll();
require 'header.php';
?>

<!-- Hero Section -->
<section class="hero-section text-white d-flex align-items-center" style="background-image:url('images/hero.jpg'); background-size:cover; background-position:center; height:90vh;">
  <div class="container text-center">
    <h1 class="display-4 fw-bold">Welcome to ThemePark — Fun for Everyone</h1>
    <p class="lead mb-4">Rides, adventures and memories — book your visit today!</p>
    <a href="#attractions" class="btn btn-primary btn-lg me-2">Explore Attractions</a>
    <button class="btn btn-outline-light btn-lg" data-bs-toggle="modal" data-bs-target="#bookModal">Book Now</button>
  </div>
</section>

<!-- Attractions Section -->
<section id="attractions" class="py-5">
  <div class="container">
    <h2 class="mb-4 text-center fw-bold">Popular Attractions</h2>
    <div class="row g-4">
      <?php foreach($attractions as $a): ?>
      <div class="col-md-4">
        <div class="card attraction-card shadow-sm h-100">
          <img src="images/<?php echo htmlspecialchars($a['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($a['name']); ?>">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title"><?php echo htmlspecialchars($a['name']); ?></h5>
            <p class="card-text small"><?php echo htmlspecialchars($a['short_desc']); ?></p>
            <div class="mt-auto d-flex justify-content-between align-items-center">
              <strong>₹ <?php echo number_format($a['price'],2); ?></strong>
              <button class="btn btn-sm btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#bookModal"
                data-attr-id="<?php echo $a['id']; ?>"
                data-attr-name="<?php echo htmlspecialchars($a['name']); ?>">
                Book
              </button>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- About Section -->
<section id="about" class="py-5 bg-light">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6 mb-4 mb-md-0">
        <h3 class="fw-bold">About Our Park</h3>
        <p>ThemePark offers thrilling rides, family attractions, food courts, and memorable events. Enjoy a safe and fun environment with trained staff and easy online booking.</p>
        <ul>
          <li>Safe & certified rides</li>
          <li>Family & kids zones</li>
          <li>Group discounts & events</li>
        </ul>
      </div>
      <div class="col-md-6">
        <img src="images/park.jpg" class="img-fluid rounded shadow" alt="Theme Park Overview">
      </div>
    </div>
  </div>
</section>

<!-- Contact Section -->
 <!--
<section id="contact" class="py-5">
  <div class="container">
    <h3 class="text-center mb-4 fw-bold">Feedback Form</h3>
    <?php if(isset($_GET['contact']) && $_GET['contact']=='success'): ?>
      <div class="alert alert-success">Thanks — we received your message.</div>
    <?php endif; ?>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <form action="contact_submit.php" method="post" class="card p-4 shadow-sm">
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input required name="name" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input required type="email" name="email" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Message</label>
            <textarea required name="message" rows="4" class="form-control"></textarea>
          </div>
          <div class="text-end">
            <button class="btn btn-primary">Send Message</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section> -->

<!-- Booking Modal -->
<div class="modal fade" id="bookModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="booking_submit.php" method="post">
        <div class="modal-header">
          <h5 class="modal-title">Book Tickets</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
        <div class="row g-3">
  <div class="col-md-6">
    <label class="form-label">Full Name</label>
    <input required name="full_name" class="form-control">
  </div>
  <div class="col-md-6">
    <label class="form-label">Email</label>
    <input required type="email" name="email" class="form-control">
  </div>
  <div class="col-md-6">
    <label class="form-label">Phone</label>
    <input name="phone" class="form-control">
  </div>

  <div class="col-md-6">
    <label class="form-label">Attraction</label>
    <select required name="attraction_id" id="attractionSelect" class="form-select">
      <option value="">Choose...</option>
      <?php foreach($attractions as $a): ?>
        <option value="<?php echo $a['id']; ?>"
          data-price="<?php echo $a['price']; ?>">
          <?php echo htmlspecialchars($a['name']); ?> — ₹<?php echo number_format($a['price'],2); ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="col-md-6">
    <label class="form-label">Visit Date</label>
    <input required type="date" name="visit_date" class="form-control"
       min="<?php echo date('Y-m-d'); ?>">

  </div>

  <div class="col-md-6">
    <label class="form-label">Tickets</label>
    <input required type="number" min="1" value="1" name="tickets" id="ticketCount" class="form-control">
  </div>

  <div class="col-md-12">
    <label class="form-label fw-bold">Total Price:</label>
    <input type="text" id="totalPrice" class="form-control" readonly value="₹ 0.00">
  </div>
</div>

        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
          <button class="btn btn-primary" type="submit">Confirm Booking</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'booking_modal.php'; ?>


<?php require 'footer.php'; ?>

<!-- Modal Prefill Script -->
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
<!-- End Modal Prefill Script -->
