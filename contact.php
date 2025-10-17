<?php require 'header.php'; ?>

<section id="contact" class="py-5">
  <div class="container">
    <h3 class="text-center mb-4">Feedback</h3>
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
</section>

<?php require 'footer.php'; ?>
