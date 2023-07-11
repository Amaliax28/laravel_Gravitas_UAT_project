@if(session()->has('message'))
  <div class="position-fixed top-0 start-50 translate-middle-x" style="z-index: 1050;">
    <div class="alert alert-light shadow-sm alert-dismissible fade show position-relative" role="alert" style="background-color: rgba(255, 255, 255, 0.8);" id="myAlert">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  </div>
  {{ session()->forget('message') }}

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      setTimeout(function() {
        var alert = document.getElementById('myAlert');
        alert.classList.remove('show');
        alert.addEventListener('transitionend', function() {
          alert.parentNode.removeChild(alert);
        });
      }, 3000);
    });
  </script>
@endif
