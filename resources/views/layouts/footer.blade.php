<footer class="neu-footer">
    <div class="container">
        <div class="row">
            <!-- About Section -->
            <div class="col-md-4 mb-4">
                <h5 class="font-weight-bold mb-3">
                    <i class="fas fa-motorcycle"></i> Ets Modeste
                </h5>
                <p class="text-muted">
                    Votre partenaire de confiance pour l'achat de motos de qualité.
                    Nous offrons une large gamme de motos neuves et d'occasion.
                </p>
                <div class="social-links mt-4">
                    <a href="#" class="neu-social-link">
                        <i class="fab fa-facebook fa-lg"></i>
                    </a>
                    <a href="#" class="neu-social-link">
                        <i class="fab fa-twitter fa-lg"></i>
                    </a>
                    <a href="#" class="neu-social-link">
                        <i class="fab fa-instagram fa-lg"></i>
                    </a>
                    <a href="#" class="neu-social-link">
                        <i class="fab fa-whatsapp fa-lg"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-md-4 mb-4">
                <h5 class="font-weight-bold mb-3">Liens Rapides</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ route('home') }}">
                            <i class="fas fa-chevron-right"></i> Accueil
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('cart.index') }}">
                            <i class="fas fa-chevron-right"></i> Mon Panier
                        </a>
                    </li>
                    @auth
                        @if(auth()->user()->is_admin)
                            <li class="mb-2">
                                <a href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-chevron-right"></i> Administration
                                </a>
                            </li>
                        @endif
                    @else
                        <li class="mb-2">
                            <a href="{{ route('login') }}">
                                <i class="fas fa-chevron-right"></i> Connexion
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('register') }}">
                                <i class="fas fa-chevron-right"></i> Inscription
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-md-4 mb-4">
                <h5 class="font-weight-bold mb-3">Contact</h5>
                <ul class="list-unstyled">
                    <li class="mb-2 text-muted">
                        <i class="fas fa-map-marker-alt text-gradient"></i> Dapaong - TOGO
                    </li>
                    <li class="mb-2 text-muted">
                        <i class="fas fa-phone text-gradient"></i> 90 90 85 85
                    </li>
                    <li class="mb-2 text-muted">
                        <i class="fas fa-envelope text-gradient"></i> etsmodeste@gmail.com
                    </li>
                    <li class="mb-2 text-muted">
                        <i class="fas fa-clock text-gradient"></i> 7H - 17H
                    </li>
                </ul>
            </div>
        </div>

        <hr style="border-top: 1px solid var(--shadow-dark); opacity: 0.2;">

        <!-- Copyright -->
        <div class="row py-3">
            <div class="col-md-6 text-center text-md-left">
                <p class="mb-0 text-muted">
                    &copy; {{ date('Y') }} Ets Modeste. Tous droits réservés.
                </p>
            </div>
            <div class="col-md-6 text-center text-md-right">
                <p class="mb-0 text-muted">
                    <i class="fas fa-shield-alt text-gradient"></i> Paiement sécurisé |
                    <i class="fas fa-truck text-gradient"></i> Livraison rapide
                </p>
            </div>
        </div>
    </div>
</footer>
