@extends('layouts.frontend')

@section('content')
<!--==================== DOMAIN SEARCH ====================-->
<section class="domain-search section" id="domain-search">
    <div class="container">
        <h2 class="section__title" style="text-align: center">
            Find The Best Domain
        </h2>

        <!-- Domain Search Form -->
        <form id="domain-search-form" class="search-bar" style="text-align: center; margin-top: 20px; margin-bottom: 30px;">
            <input 
                type="text" 
                id="domain" 
                name="domain" 
                placeholder="Search for domain..." 
                value="{{ request('domain') }}"
                style="width: 50%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;"
            />
            <select id="zone" name="zone" style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
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
        <div id="domain-results" class="domain-results" style="display: flex; flex-wrap: wrap; justify-content: center;">
            @if (isset($domains) && count($domains) > 0)
                @foreach ($domains as $domain)
                    <div class="domain-item" style="margin: 10px; padding: 15px; width: 300px; border: 1px solid #ddd; border-radius: 8px; background-color: #f9f9f9; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); text-align: left;">
                        <h3 style="margin-bottom: 10px; font-size: 18px; font-weight: bold; color: #333;">{{ $domain['domain'] }}.{{ request('zone', 'com') }}</h3>
                        
                        <!-- Display 'isDead' status inside a colored box -->
                        <div style="display: inline-block; padding: 5px 10px; font-size: 14px; font-weight: bold; border-radius: 4px; background-color: {{ $domain['isDead'] === 'False' ? 'green' : 'red' }}; color: #fff;">
                            Status: {{ $domain['isDead'] === 'False' ? 'Tersedia' : 'Tidak Tersedia' }}
                        </div>
                    </div>
                @endforeach
            @else
                <p>No domains found.</p>
            @endif
        </div>
    </div>
</section>

<script>
    document.getElementById('domain-search-form').addEventListener('submit', function(e) {
        e.preventDefault();  // Prevent default form submission

        // Get input values
        let domain = document.getElementById('domain').value;
        let zone = document.getElementById('zone').value;

        // Make AJAX request
        fetch("{{ route('domain.search') }}?domain=" + domain + "&zone=" + zone)
            .then(response => response.json())
            .then(data => {
                let resultDiv = document.getElementById('domain-results');
                resultDiv.innerHTML = ''; // Clear previous results

                if (data.status === 'success' && data.data.length > 0) {
                    data.data.forEach(domain => {
                        let domainItem = document.createElement('div');
                        domainItem.classList.add('domain-item');
                        domainItem.style.margin = '10px';
                        domainItem.style.padding = '15px';
                        domainItem.style.width = '300px';
                        domainItem.style.border = '1px solid #ddd';
                        domainItem.style.borderRadius = '8px';
                        domainItem.style.backgroundColor = '#f9f9f9';
                        domainItem.style.boxShadow = '0 4px 6px rgba(0, 0, 0, 0.1)';
                        domainItem.style.textAlign = 'left';

                        let domainName = document.createElement('h3');
                        domainName.style.marginBottom = '10px';
                        domainName.style.fontSize = '18px';
                        domainName.style.fontWeight = 'bold';
                        domainName.style.color = '#333';
                        domainName.textContent = domain.domain + '.' + zone;

                        let domainStatus = document.createElement('div');
                        domainStatus.style.display = 'inline-block';
                        domainStatus.style.padding = '5px 10px';
                        domainStatus.style.fontSize = '14px';
                        domainStatus.style.fontWeight = 'bold';
                        domainStatus.style.borderRadius = '4px';
                        domainStatus.style.backgroundColor = domain.isDead === 'False' ? 'green' : 'red';
                        domainStatus.style.color = '#fff';
                        domainStatus.textContent = domain.isDead === 'False' ? 'Available' : 'Unavailable';

                        domainItem.appendChild(domainName);
                        domainItem.appendChild(domainStatus);
                        resultDiv.appendChild(domainItem);
                    });
                } else {
                    resultDiv.innerHTML = '<p>No domains found.</p>';
                }
            })
            .catch(error => {
                document.getElementById('domain-results').innerHTML = '<p>Failed to fetch data from the API.</p>';
            });
    });
</script>
@endsection
