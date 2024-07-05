<form id="search-form" method="GET" action="{{ url('/post-search') }}">
    <div class="form-group d-flex justify-content-around pb-5">
        <input type="text" name="query" class="form-control col-lg-10" placeholder="Search...">
        <button type="submit" class="btn btn-primary">Search</button>
    </div>
</form>
