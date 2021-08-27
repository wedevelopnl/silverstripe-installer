<h2 class="title is-5 is-family-primary is-lowercase">
    $Title
</h2>
<nav class="nav is-vertical is-small is-lowercase">
    <ul>
        <% loop $Items %>
            <li class="$LinkedPage.LinkingMode">
                <a href="$Link"<% if $OpenInNewWindow %> target="_blank"<% end_if %><% if $LinkType == 'url' %> rel="nofollow noopener"<% end_if %>>
                    <span class="svg-icon item-first is-size-8"><% include Icons/ChevronRightLight %></span>$Title
                </a>
            </li>
        <% end_loop %>
    </ul>
</nav>