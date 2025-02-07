@extends('layouts.frontend')

@section('content')

<!-- Domain Search -->
<section class="blog section" id="blog">
    <div class="blog__container container">
        <h2 class="section__title" style="text-align: center">
            Find The Best Domain
        </h2>

        <!-- Domain Search Form -->
        <form action="{{ route('domain.search') }}" method="GET" class="search-bar" style="text-align: center; margin-top: 20px; margin-bottom: 30px;">
            <input 
                type="text" 
                name="domain" 
                placeholder="Search for domain..." 
                value="{{ request('domain') }}" 
                style="width: 50%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;"
            />
            <select name="zone" style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                <option value="com" {{ request('zone') == 'com' ? 'selected' : '' }}>.com</option>
                <option value="net" {{ request('zone') == 'net' ? 'selected' : '' }}>.net</option>
                <option value="org" {{ request('zone') == 'org' ? 'selected' : '' }}>.org</option>
            </select>
            <button 
                type="submit" 
                style="padding: 10px 15px; margin-left: 10px; background-color: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer;">
                Search
            </button>
        </form>

        <!-- Display Domain Search Results -->
        @if (isset($domains) && count($domains) > 0)
            <div class="domain-results" style="text-align: center;">
                @foreach ($domains as $domain)
                    <div class="domain-item" style="margin-bottom: 20px;">
                        <h3>{{ $domain['domain'] }}.{{ request('zone', 'com') }}</h3>
                        <p>Created: {{ $domain['create_date'] ?? 'N/A' }}</p>
                    </div>
                @endforeach
            </div>

            <!-- Pagination Links -->
            @if ($domains->hasMorePages())
                <div class="pagination" style="text-align: center;">
                    <a href="{{ $domains->nextPageUrl() }}" class="btn btn-primary">Next</a>
                </div>
            @endif
        @else
            <p style="text-align: center;">No domains found.</p>
        @endif
    </div>
</section>
@endsection
