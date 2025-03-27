<!doctype html>
<html lang="en">

[block slug="header"]

<?php
use App\Services\FrontendSearchService;

$link = $_SERVER['PHP_SELF'];
$link_array = explode('/', $link);
$slug = end($link_array);
$response = [];

// Is this the right place for this?
if ($slug === 'build') {
    $response = [
        'title' => 'API Overview',
        'last_updated' => date('Y/m/d'),
        'body' => '<h2 id="APIOverview-Introduction"> Introduction</h2><p /><p>Welcome to the FakeAPI! This API allows developers to access a collection of fictional resources, providing an easy way to experiment with API design and integration. Whether you are building a new application or testing out HTTP requests, FakeAPI is here to assist. This data should appear!!!</p><span class="confluence-embedded-file-wrapper image-center-wrapper confluence-embedded-manual-size"><img class="confluence-embedded-image image-center" alt="CLV demo.jpg" width="351" loading="lazy" src="https://spoke-dev.atlassian.net/wiki/download/thumbnails/4194307/CLV%20demo.jpg?version=1&amp;modificationDate=1731724275311&amp;cacheVersion=1&amp;api=v2&amp;width=351&amp;height=184" data-image-src="https://spoke-dev.atlassian.net/wiki/download/attachments/4194307/CLV%20demo.jpg?version=1&amp;modificationDate=1731724275311&amp;cacheVersion=1&amp;api=v2" data-height="184" data-width="351" data-unresolved-comment-count="0" data-linked-resource-id="5144579" data-linked-resource-version="1" data-linked-resource-type="attachment" data-linked-resource-default-alias="CLV demo.jpg" data-base-url="https://spoke-dev.atlassian.net/wiki" data-linked-resource-content-type="image/jpeg" data-linked-resource-container-id="4194307" data-linked-resource-container-version="19" data-media-id="a9373420-dc8f-4220-a345-39c43d9d2566" data-media-type="file" srcset="https://spoke-dev.atlassian.net/wiki/download/thumbnails/4194307/CLV%20demo.jpg?version=1&amp;modificationDate=1731724275311&amp;cacheVersion=1&amp;api=v2&amp;width=702&amp;height=368 2x, https://spoke-dev.atlassian.net/wiki/download/thumbnails/4194307/CLV%20demo.jpg?version=1&amp;modificationDate=1731724275311&amp;cacheVersion=1&amp;api=v2&amp;width=351&amp;height=184 1x"></span><p /><p>If you haven’t read our <a href="/wiki/spaces/HC/pages/3407888/How+to+Get+Started+with+Your+New+SaaS+Account" data-linked-resource-id="3407888" data-linked-resource-version="1" data-linked-resource-type="page">How to Get Started with Your New SaaS Account</a> article, we suggest starting there:</p><p /><h2 id="APIOverview-BaseURL">Base URL</h2><p /><p>All API requests start with the base URL:</p><p /><div class="code panel pdl conf-macro output-block" style="border-width: 1px;" data-hasbody="true" data-macro-name="code" data-macro-id="ce0acc1a-6bd5-4969-906f-30f7e07b75f1"><div class="codeContent panelContent pdl">
<pre class="syntaxhighlighter-pre" data-syntaxhighlighter-params="brush: java; gutter: false; theme: Confluence" data-theme="Confluence">https://api.fakeapi.com/v1/</pre>
</div></div><p /><h2 id="APIOverview-Authentication">Authentication</h2><p /><p>FakeAPI uses API keys to authenticate requests. You can obtain your API key by signing up on the <a href="https://www.fakeapi.com/signup" class="external-link" rel="nofollow">website</a>.</p><p /><h3 id="APIOverview-HowtoUseYourAPIKey">How to Use Your API Key</h3><p /><p>Include your API key in the `Authorization` header with the prefix `Bearer`.</p><p /><div class="code panel pdl conf-macro output-block" style="border-width: 1px;" data-hasbody="true" data-macro-name="code" data-macro-id="1ceaf1ba-da50-4846-a87d-7fecbcdbe95d"><div class="codeContent panelContent pdl">
<pre class="syntaxhighlighter-pre" data-syntaxhighlighter-params="brush: java; gutter: false; theme: Confluence" data-theme="Confluence">Authorization: Bearer YOUR_API_KEY</pre>
</div></div><p /><h2 id="APIOverview-Endpoints">Endpoints</h2><p /><h3 id="APIOverview-1.GET/items">1. GET /items</h3><p /><p>Retrieve a list of items.</p><p /><p><strong>Request</strong></p><p /><div class="code panel pdl conf-macro output-block" style="border-width: 1px;" data-hasbody="true" data-macro-name="code" data-macro-id="87ada742-22dc-4cee-b106-8f68c017fe2e"><div class="codeContent panelContent pdl">
<pre class="syntaxhighlighter-pre" data-syntaxhighlighter-params="brush: java; gutter: false; theme: Confluence" data-theme="Confluence">GET /items HTTP/1.1

Host: http://api.fakeapi.com 

Authorization: Bearer YOUR_API_KEY</pre>
</div></div><p /><p><strong>Response</strong></p><p /><p>json</p><div class="code panel pdl conf-macro output-block" style="border-width: 1px;" data-hasbody="true" data-macro-name="code" data-macro-id="e7a258d3-4229-482b-9b72-14f6047a3ce2"><div class="codeContent panelContent pdl">
<pre class="syntaxhighlighter-pre" data-syntaxhighlighter-params="brush: java; gutter: false; theme: Confluence" data-theme="Confluence">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Item One&quot;,
            &quot;description&quot;: &quot;A description of item one.&quot;
        },
        {
            &quot;id&quot;: 2,
            &quot;name&quot;: &quot;Item Two&quot;,
            &quot;description&quot;: &quot;A description of item two.&quot;
        }
    ]
}</pre>
</div></div><p /><p />',
    ];
} else {
    $response = FrontendSearchService::content(htmlspecialchars($slug));
}

?>

<body>

    [block slug="navigation" id="navigation-top"]

    <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white antialiased">
        <!-- Page content starts -->
        <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
            <article class="mx-auto sm:w-2/3 lg:w-3/5 format format-sm sm:format-base lg:format-lg format-blue">
                <article class="format format-sm sm:format-base lg:format-lg format-blue">
                    <h1 class='mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl'>
                        <?php echo $response['title']; ?>
                    </h1>
                    <p class='my-5'> Content last updated <?php echo $response['last_updated']; ?></p>

                    <?php
                    echo $response['body'];
                    ?>

                </article>
            </article>
        </div>
    </main>
    <script>
        $(document).ready(function() {
            $('a').each(function(tag) {
                // NOTE: There are a lot of bold assumptions here. 
                // May have to revisit depending on URL formatting
                // If there is an error in routing, start here.
                if ($(this).attr('href').includes('/wiki/')) {
                    let split_path = $(this).attr('href').split('/');
                    let new_path = split_path.at(-1).replaceAll('+', '-').toLowerCase();
                    $(this).attr('href', new_path);
                }
            })
        });
    </script>

</body>

</html>
