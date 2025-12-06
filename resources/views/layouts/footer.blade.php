<footer class="main-footer bg-dark text-white mt-5">
    <div class="container py-5">
        <div class="row">
            <!-- About Section -->
            <div class="col-md-4 mb-4">
                <h5 class="font-weight-bold mb-3">
                    <i class="fas fa-motorcycle"></i> Ets Modeste
                </h5>
                <p class="text-white-50">
                    Votre partenaire de confiance pour l'achat de motos de qualité.
                    Nous offrons une large gamme de motos neuves et d'occasion.
                </p>
                <div class="social-links mt-3">
                    <a href="#" class="text-white-50 mr-3"><i class="fab fa-facebook fa-lg"></i></a>
                    <a href="#" class="text-white-50 mr-3"><i class="fab fa-twitter fa-lg"></i></a>
                    <a href="#" class="text-white-50 mr-3"><i class="fab fa-instagram fa-lg"></i></a>
                    <a href="#" class="text-white-50"><i class="fab fa-whatsapp fa-lg"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-md-4 mb-4">
                <h5 class="font-weight-bold mb-3">Liens Rapides</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ route('home') }}" class="text-white-50">
                            <i class="fas fa-chevron-right"></i> Accueil
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('cart.index') }}" class="text-white-50">
                            <i class="fas fa-chevron-right"></i> Mon Panier
                        </a>
                    </li>
                    @auth
                        @if(auth()->user()->is_admin)
                            <li class="mb-2">
                                <a href="{{ route('admin.dashboard') }}" class="text-white-50">
                                    <i class="fas fa-chevron-right"></i> Administration
                                </a>
                            </li>
                        @endif
                    @else
                        <li class="mb-2">
                            <a href="{{ route('login') }}" class="text-white-50">
                                <i class="fas fa-chevron-right"></i> Connexion
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('register') }}" class="text-white-50">
                                <i class="fas fa-chevron-right"></i> Inscription
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-md-4 mb-4">
                <h5 class="font-weight-bold mb-3">Contact</h5>
                <ul class="list-unstyled text-white-50">
                    <li class="mb-2">
                        <i class="fas fa-map-marker-alt"></i> Yaoundé, Cameroun
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-phone"></i> +237 XXX XXX XXX
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-envelope"></i> contact@etsmodeste.com
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-clock"></i> Lun - Sam: 8h - 18h
                    </li>
                </ul>
            </div>
        </div>

        <hr class="bg-white-50 my-4">

        <!-- Copyright -->
        <div class="row">
            <div class="col-md-6 text-center text-md-left">
                <p class="mb-0 text-white-50">
                    &copy; {{ date('Y') }} Ets Modeste. Tous droits réservés.
                </p>
            </div>
            <div class="col-md-6 text-center text-md-right">
                <p class="mb-0 text-white-50">
                    <i class="fas fa-shield-alt"></i> Paiement sécurisé |
                    <i class="fas fa-truck"></i> Livraison rapide
                </p>
            </div>
        </div>
    </div>
</footer>

<style>
.main-footer a {
    transition: color 0.3s ease;
}

.main-footer a:hover {
    color: #fff !important;
    text-decoration: none;
}

.social-links a {
    transition: all 0.3s ease;
}

.social-links a:hover {
    color: #075e7f !important;
    transform: translateY(-3px);
}
</style>
