document.addEventListener('DOMContentLoaded', function () {
  const buttons = document.querySelectorAll('.toggle-btn');

  buttons.forEach(function (btn) {
    btn.addEventListener('click', function () {
      const id = btn.getAttribute('data-id');
      const row = btn.closest('tr');
      const statusCell = row.querySelector('.status-cell');

      btn.disabled = true;

      fetch('toggle.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'id=' + encodeURIComponent(id)
      })
        .then(function (response) { return response.json(); })
        .then(function (data) {
          if (data.success) {
            statusCell.textContent = data.status == 1 ? 'مفعّل (1)' : 'غير مفعّل (0)';
          } else {
            alert('حدث خطأ أثناء تحديث الحالة');
          }
        })
        .catch(function () {
          alert('تعذر الاتصال بالخادم');
        })
        .finally(function () {
          btn.disabled = false;
        });
    });
  });
});
