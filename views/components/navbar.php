<nav class="navbar navbar-default" role="navigation">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#">PHP Test Application</a>
  </div>
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <form class="navbar-form navbar-left" role="search" id="searchByCity">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Search by city" id="searchByCityValue">
      </div>
      <button type="submit" class="btn btn-default">Submit</button>
    </form>
  </div>
</nav>


<script>
  $('#searchByCity').submit(function(e) {
    e.preventDefault();
    console.log('searching');

    const searchValue = $('#searchByCityValue').val().toLowerCase();
    console.log(searchValue);

    // hide all rows initially
    $('#usersTableBody tr').hide();

    // check if any rows contain the search value
    let foundResults = false;
    $('#usersTableBody tr').each(function() {
      const city = $(this).find('td').eq(3).text().toLowerCase();
      console.log(city);

      if (city.includes(searchValue)) {
        $(this).show();
        foundResults = true; // set flag if a match is found
      }
    });

    // Create and display "Nothing found" message if no rows match
    if (!foundResults) {
      const noResultsDiv = $('<div id="noResults">Nothing found</div>');
      $('#usersTableBody').append(noResultsDiv);
    } else {
      // remove "Nothing found" message if results are found
      $('#noResults').remove();
    }
  });
</script>
