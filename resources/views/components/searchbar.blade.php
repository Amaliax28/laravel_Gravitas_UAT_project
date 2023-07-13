<div class="container-fluid p-0 w-100 ">
    <div class="row m-0 w-100 d-flex justify-content-between">
        <div class="col-12 col-md-auto p-0">
            <form action="#">
                <div class="search-group d-flex flex-row align-items-center" id="searchBox">
                    <button class="border-0 bg-transparent">
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18" viewBox="0 0 17 18" fill="none">
                            <path d="M16.6564 15.9488L12.4869 11.7621C13.559 10.5317 14.1464 8.98367 14.1464 7.37206C14.1464 3.60669 10.9733 0.543209 7.07318 0.543209C3.17309 0.543209 0 3.60669 0 7.37206C0 11.1374 3.17309 14.2009 7.07318 14.2009C8.53733 14.2009 9.93259 13.7746 11.1255 12.9652L15.3267 17.1836C15.5023 17.3597 15.7384 17.4568 15.9915 17.4568C16.2311 17.4568 16.4584 17.3686 16.6309 17.2083C16.9975 16.8677 17.0092 16.303 16.6564 15.9488ZM7.07318 2.32465C9.95597 2.32465 12.3012 4.58886 12.3012 7.37206C12.3012 10.1553 9.95597 12.4195 7.07318 12.4195C4.1904 12.4195 1.84518 10.1553 1.84518 7.37206C1.84518 4.58886 4.1904 2.32465 7.07318 2.32465Z" fill="#9CA3AF"/>
                          </svg>
                    </button>
                    <input type="text" name="search" id="search" placeholder="Search project, session, test cases, etc" class="w-100">
                </div>
            </form>
        </div>
        <div class="col-12 col-md-auto p-0 create-project-col ">
            {{$slot}}
        </div>
    </div>
</div>

<script>

        const searchInput = document.getElementById('search');
        const searchBox = document.getElementById('searchBox');

        searchInput.addEventListener('click', () => {
            searchBox.classList.add('search-box-enlarge');
            searchBox.classList.add('search-box-focus');

        });

        searchInput.addEventListener('blur', () => {
            searchBox.classList.remove('search-box-enlarge');
            searchBox.classList.remove('search-box-focus');
        });

</script>


