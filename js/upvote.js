document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.np-upvote-btn').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      var postId = btn.getAttribute('data-post');
      var countSpan = btn.nextElementSibling;
      btn.disabled = true;
      fetch(ajaxurl, {
        method: 'POST',
        credentials: 'same-origin',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'action=np_upvote&post_id=' + postId
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          countSpan.textContent = data.data.count;
        }
        btn.disabled = false;
      });
    });
  });
});