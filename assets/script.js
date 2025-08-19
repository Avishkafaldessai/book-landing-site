// Year in footer
document.getElementById('year').textContent = new Date().getFullYear();

// 10-second modal
document.addEventListener('DOMContentLoaded', function() {
  setTimeout(function() {
    var purchaseModal = new bootstrap.Modal(document.getElementById('purchaseModal'));
    purchaseModal.show();
  }, 10000);
});
