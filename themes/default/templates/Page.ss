<!DOCTYPE html>
<html lang="$ContentLocale">
<head>
    <% base_tag %>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <link rel="shortcut icon" href="$ThemeDir/images/logo-simple.svg">
    $PageMetaTags
    $SiteConfig.CustomHeadCode.RAW
</head>
<body class="$ClassName.ShortName">
<% include Navbar %>
    $SiteConfig.CustomBodyCode.RAW
    $Layout
<% include Footer %>
</body>
</html>
