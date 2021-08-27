<footer class="footer has-background-primary has-text-white has-links-white">
    <div class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-4-desktop">
                    <h2 class="title is-4 is-uppercase is-family-primary">
                        $SiteConfig.Title
                    </h2>
                </div>
                <div class="column is-4-desktop">
                    <% cached 'footer-top-nav', $LastEdited %>
                        $MenustructureMenu('footer-top-nav', 'Menus/NavTitled')
                    <% end_cached %>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <div class="is-flex is-flex-wrap-wrap">
                <div class="has-text-weight-semibold">
                    &copy; $SiteConfig.Title $Now.Year
                </div>
                <nav class="nav ml-auto">
                    <ul>
                    <% cached 'footer-bottom-nav', $LastEdited %>
                        $MenustructureMenu('footer-bottom-nav', 'Menus/Nav')
                    <% end_cached %>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</footer>