<nav class="navbar navbar-expand-lg mb-4 border-bottom">
  <div class="container-fluid">
    <a class="text-decoration-none" href="/"><h6 class="m-0 fw-bolder">Test Project</h6></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      </ul>
      <div id="searchbar">
      </div>
    </div>
  </div>
</nav>

<script>
  // Add search form to the navbar if we are on the main page
  if(window.location.pathname === '/'){
    $('#searchbar').append(`
    <form class="input-group" id="searchByCity" style="width: max-content;">
      <input id="searchByCityValue" type="text" class="form-control form-control-sm" placeholder="Search by city">
    </form>
    `);
  }
</script>
