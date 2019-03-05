<nav class="d-md-block bg-light sidebar menucontent">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">

            <li class="nav-item mt-3">
                <a class="nav-link active text-success" href="{{ path('lbr_contact_index') }}">
                    <span data-feather="users"></span>
                    Contacts
                </a>
            </li>


            <li class="nav-item mt-3">
                <a class="nav-link active text-success" href="{{ path('lbr_organisation_index') }}">
                    <span data-feather="target"></span>
                    Organisation
                </a>
            </li>

            <li class="nav-item mt-3">
                <a class="nav-link active text-success" href="{{ path('lbr_evenement_index') }}">
                    <span data-feather="shopping-bag"></span>
                    Evénements
                </a>
            </li>

            <li class="nav-item mt-3">
                <a class="nav-link active text-success" href="{{ path('lbr_categorie_index') }}">
                    <span data-feather="tag"></span>
                    Catégories
                </a>
            </li>
            {% if is_granted('ROLE_ADMIN') == true %}

            <li class="nav-item mt-3">
                <a class="nav-link active text-success" href="{{ path('lbr_user_index') }}">
                    <span data-feather="coffee"></span>
                    Utilisateurs
                </a>
            </li>
            
            {% endif %}


        </ul>
    </div>
</nav> 