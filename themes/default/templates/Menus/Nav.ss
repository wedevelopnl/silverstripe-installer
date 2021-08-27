<% loop $Items %>
    <li class="$LinkedPage.LinkingMode">
        <a href="$Link"<% if $OpenInNewWindow %> target="_blank"<% end_if %><% if $LinkType == 'url' %> rel="nofollow noopener"<% end_if %>>
            $Title
        </a>
    </li>
<% end_loop %>