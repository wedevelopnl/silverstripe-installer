<div class="navbar section is-smaller">
    <div class="container">
        <div class="is-flex">
            <a href="$BaseHref" class="navbar-brand">
                $SiteConfig.Title
            </a>
            <nav class="nav item-right">
                <ul>
                    <% cached 'main-nav', $LastEdited %>
                        $MenustructureMenu('main-nav', 'Menus/Nav')
                    <% end_cached %>
                </ul>
            </nav>
        </div>
    </div>
</div>