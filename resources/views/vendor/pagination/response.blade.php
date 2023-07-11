@if ($paginator->hasPages())
    <nav class="d-flex justify-items-center justify-content-between">
        <div class="d-flex justify-content-between flex-fill d-sm-none">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">@lang('pagination.previous')</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
                    </li>
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">@lang('pagination.next')</span>
                    </li>
                @endif
            </ul>
        </div>

        <!--small screen-->
        <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
            <div>
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                            <span class="page-link" aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="7" height="11" viewBox="0 0 7 11" fill="none">
                                    <path d="M6.83434 9.41748C6.83434 10.4938 5.53303 11.0328 4.77196 10.2717L0.85448 6.35426C0.382683 5.88247 0.382684 5.11753 0.854482 4.64573L4.77196 0.728256C5.53303 -0.0328125 6.83434 0.506208 6.83434 1.58252L6.83434 9.41748Z" fill="#DBDBDB"/>
                                </svg>
                            </span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="7" height="11" viewBox="0 0 7 11" fill="none">
                                    <path d="M6.83434 9.41748C6.83434 10.4938 5.53303 11.0328 4.77196 10.2717L0.854481 6.35426C0.382683 5.88247 0.382684 5.11753 0.854482 4.64573L4.77196 0.728256C5.53303 -0.0328125 6.83434 0.506209 6.83434 1.58252L6.83434 9.41748Z" fill="#B2AEC0"/>
                                </svg>
                            </a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                        @endif

                        {{-- HERE IS THE 123 NUMBERS --}}
                        @if (is_array($element))
                            @php
                                $nextPageIndex = $paginator->currentPage()+1
                            @endphp
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item active" aria-current="page"><span class="page-link ">{{ $page }}</span></li>

                                @elseif ($page != $paginator->lastPage()) <!--if not the last page-->
                                    @if ($page == $nextPageIndex) <!--find the next pages only-->

                                        @if($element[$page] == $paginator->nextPageUrl()) <!-- number next to current page is active -->
                                            <li class="page-item "><a class="page-link " href="{{ $url }}">{{ $page }}</a></li>
                                        @else <!--the rest of the numbers -->

                                            <li class="page-item disabled"><a class="page-link " href="{{ $url }}">{{ $page }}</a></li>
                                        @endif
                                        @php
                                            $nextPageIndex = $nextPageIndex+1
                                        @endphp
                                    @else
                                        <li class="page-item" ><a class="page-link " href="{{ $url }}">{{ $page }}</a></li>
                                    @endif

                                @else
                                    @if($paginator->currentPage()+1 != $page)
                                        <li class="page-item disabled"  data-bs-toggle="tooltip" data-bs-placement="top" title="Please submit the response to proceed to the next page"><a class="page-link " href="{{ $url }}">{{ $page }}</a></li>
                                    @else
                                        <li class="page-item " ><a class="page-link " href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="7" height="11" viewBox="0 0 7 11" fill="none">
                                    <path d="M0.502577 1.58252C0.502577 0.506209 1.80389 -0.0328107 2.56496 0.728258L6.48243 4.64574C6.95423 5.11753 6.95423 5.88247 6.48243 6.35426L2.56495 10.2717C1.80389 11.0328 0.502577 10.4938 0.502577 9.41748V1.58252Z" fill="#B2AEC0"/>
                                </svg>
                            </a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                            <span class="page-link" aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="7" height="11" viewBox="0 0 7 11" fill="none">
                                    <path d="M0.502577 1.58252C0.502577 0.506209 1.80389 -0.0328106 2.56496 0.728258L6.48243 4.64574C6.95423 5.11753 6.95423 5.88247 6.48243 6.35426L2.56495 10.2717C1.80389 11.0328 0.502577 10.4938 0.502577 9.41748V1.58252Z" fill="#DBDBDB"/>
                                </svg>
                            </span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
@endif
