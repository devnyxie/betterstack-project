<nav class="navbar navbar-default" role="navigation">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="/">Test Application</a>
  </div>
  <div class="collapse navbar-collapse navbar-ex1-collapse">
  
  </div>
</nav>

<script>
  // Add search form to the navbar if we are on the main page
  if(window.location.pathname === '/'){
    $('.navbar-ex1-collapse').append(`
    <form class="navbar-form navbar-left" role="search" id="searchByCity">
      <div class="form-group search-container" >
        <input type="text" class="form-control" placeholder="Search by city" id="searchByCityValue">
      </div>
      <button type="submit" class="btn btn-default">Submit</button>
    </form>
    `);
  }
</script>
