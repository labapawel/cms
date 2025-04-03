<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moja Strona</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Nagłówek z menu -->
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">Moja Strona</div>
                <nav>
                    <ul>
                        @foreach($menu as $page)
                            @if($page->slug == '')
                                <li><a href="{{ route('home') }}">{{ $page->title }}</a></li>
                                @else
                                <li><a href="{{ route('page', ['slug' => $page->slug]) }}">{{ $page->title }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    
    <!-- Content section -->
    <section class="content">
        <div class="container">
                    @yield('content')
        </div>
    </section>
    
    <!-- Stopka -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>O nas</h3>
                    <p>Jesteśmy firmą z wieloletnim doświadczeniem, specjalizującą się w tworzeniu nowoczesnych rozwiązań internetowych.</p>
                </div>
                
                <div class="footer-column">
                    <h3>Linki</h3>
                    <ul>
                    @foreach($menu as $page)
                            @if($page->slug == '')
                                <li><a href="{{ route('home') }}">{{ $page->title }}</a></li>
                                @else
                                <li><a href="{{ route('page', ['slug' => $page->slug]) }}">{{ $page->title }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3>Kontakt</h3>
                    <ul>
                        <li>Email: kontakt@mojastrona.pl</li>
                        <li>Telefon: +48 123 456 789</li>
                        <li>Adres: ul. Przykładowa 123, Warszawa</li>
                    </ul>
                </div>
            </div>
            
            <div class="copyright">
                <p>&copy; 2025 Moja Strona. Wszelkie prawa zastrzeżone.</p>
            </div>
        </div>
    </footer>
</body>
</html>