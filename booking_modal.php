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
                  <option value="<?php echo $a['id']; ?>" data-price="<?php echo $a['price']; ?>">
                    <?php echo htmlspecialchars($a['name']); ?> — ₹<?php echo number_format($a['price'],2); ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Visit Date</label>
              <input required type="date" name="visit_date" class="form-control" min="<?php echo date('Y-m-d'); ?>">
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

<!-- Booking Modal Script -->
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

function calculateTotal() {
  var select = document.getElementById('attractionSelect');
  var ticketInput = document.getElementById('ticketCount');
  var totalPrice = document.getElementById('totalPrice');
  var price = parseFloat(select.options[select.selectedIndex]?.dataset.price || 0);
  var tickets = parseInt(ticketInput.value) || 0;
  var total = price * tickets;
  totalPrice.value = "₹ " + total.toFixed(2);
}

document.getElementById('attractionSelect').addEventListener('change', calculateTotal);
document.getElementById('ticketCount').addEventListener('input', calculateTotal);
</script>
