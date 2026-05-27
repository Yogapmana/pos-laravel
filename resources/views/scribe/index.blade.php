<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Laravel API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://localhost";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.10.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.10.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-endpoints" class="tocify-header">
                <li class="tocify-item level-1" data-unique="endpoints">
                    <a href="#endpoints">Endpoints</a>
                </li>
                                    <ul id="tocify-subheader-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="endpoints-POSTlivewire-964474b5-update">
                                <a href="#endpoints-POSTlivewire-964474b5-update">POST livewire-964474b5/update</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETlivewire-964474b5-livewire-js">
                                <a href="#endpoints-GETlivewire-964474b5-livewire-js">GET livewire-964474b5/livewire.js</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETlivewire-964474b5-livewire-min-js-map">
                                <a href="#endpoints-GETlivewire-964474b5-livewire-min-js-map">GET livewire-964474b5/livewire.min.js.map</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETlivewire-964474b5-livewire-csp-min-js-map">
                                <a href="#endpoints-GETlivewire-964474b5-livewire-csp-min-js-map">GET livewire-964474b5/livewire.csp.min.js.map</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTlivewire-964474b5-upload-file">
                                <a href="#endpoints-POSTlivewire-964474b5-upload-file">POST livewire-964474b5/upload-file</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETlivewire-964474b5-preview-file--filename-">
                                <a href="#endpoints-GETlivewire-964474b5-preview-file--filename-">GET livewire-964474b5/preview-file/{filename}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETlivewire-964474b5-js--component--js">
                                <a href="#endpoints-GETlivewire-964474b5-js--component--js">GET livewire-964474b5/js/{component}.js</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETlivewire-964474b5-css--component--css">
                                <a href="#endpoints-GETlivewire-964474b5-css--component--css">GET livewire-964474b5/css/{component}.css</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETlivewire-964474b5-css--component--global-css">
                                <a href="#endpoints-GETlivewire-964474b5-css--component--global-css">GET livewire-964474b5/css/{component}.global.css</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETup">
                                <a href="#endpoints-GETup">GET up</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETlogin">
                                <a href="#endpoints-GETlogin">Display the login form</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTlogin">
                                <a href="#endpoints-POSTlogin">Authenticate user and log them in</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTlogout">
                                <a href="#endpoints-POSTlogout">Log the user out and invalidate the session</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTmidtrans-notification">
                                <a href="#endpoints-POSTmidtrans-notification">Handle Midtrans payment notification webhook</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GET-">
                                <a href="#endpoints-GET-">GET /</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETpos">
                                <a href="#endpoints-GETpos">GET pos</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETreceipt--orderId--download">
                                <a href="#endpoints-GETreceipt--orderId--download">Download receipt as PDF</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETreceipt--orderId--print">
                                <a href="#endpoints-GETreceipt--orderId--print">Display receipt for printing</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETadmin-dashboard">
                                <a href="#endpoints-GETadmin-dashboard">GET admin/dashboard</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETadmin-products">
                                <a href="#endpoints-GETadmin-products">GET admin/products</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETadmin-categories">
                                <a href="#endpoints-GETadmin-categories">GET admin/categories</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETadmin-tables">
                                <a href="#endpoints-GETadmin-tables">GET admin/tables</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETadmin-users">
                                <a href="#endpoints-GETadmin-users">GET admin/users</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETadmin-orders">
                                <a href="#endpoints-GETadmin-orders">GET admin/orders</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETadmin-activity-log">
                                <a href="#endpoints-GETadmin-activity-log">GET admin/activity-log</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETadmin-reports">
                                <a href="#endpoints-GETadmin-reports">GET admin/reports</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETadmin-reports-export-excel">
                                <a href="#endpoints-GETadmin-reports-export-excel">Export sales report to Excel</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETadmin-reports-export-pdf">
                                <a href="#endpoints-GETadmin-reports-export-pdf">Export sales report to PDF</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETstorage--path-">
                                <a href="#endpoints-GETstorage--path-">GET storage/{path}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTstorage--path-">
                                <a href="#endpoints-PUTstorage--path-">PUT storage/{path}</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: May 26, 2026</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<aside>
    <strong>Base URL</strong>: <code>http://localhost</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>This API is not authenticated.</p>

        <h1 id="endpoints">Endpoints</h1>

    

                                <h2 id="endpoints-POSTlivewire-964474b5-update">POST livewire-964474b5/update</h2>

<p>
</p>



<span id="example-requests-POSTlivewire-964474b5-update">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/livewire-964474b5/update" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/livewire-964474b5/update"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTlivewire-964474b5-update">
</span>
<span id="execution-results-POSTlivewire-964474b5-update" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTlivewire-964474b5-update"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTlivewire-964474b5-update"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTlivewire-964474b5-update" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTlivewire-964474b5-update">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTlivewire-964474b5-update" data-method="POST"
      data-path="livewire-964474b5/update"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTlivewire-964474b5-update', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTlivewire-964474b5-update"
                    onclick="tryItOut('POSTlivewire-964474b5-update');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTlivewire-964474b5-update"
                    onclick="cancelTryOut('POSTlivewire-964474b5-update');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTlivewire-964474b5-update"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>livewire-964474b5/update</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTlivewire-964474b5-update"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTlivewire-964474b5-update"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETlivewire-964474b5-livewire-js">GET livewire-964474b5/livewire.js</h2>

<p>
</p>



<span id="example-requests-GETlivewire-964474b5-livewire-js">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/livewire-964474b5/livewire.js" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/livewire-964474b5/livewire.js"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETlivewire-964474b5-livewire-js">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">content-type: application/javascript; charset=utf-8
expires: Wed, 26 May 2027 14:32:40 GMT
cache-control: max-age=31536000, public
accept-ranges: bytes
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;"></code>
 </pre>
    </span>
<span id="execution-results-GETlivewire-964474b5-livewire-js" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETlivewire-964474b5-livewire-js"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETlivewire-964474b5-livewire-js"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETlivewire-964474b5-livewire-js" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETlivewire-964474b5-livewire-js">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETlivewire-964474b5-livewire-js" data-method="GET"
      data-path="livewire-964474b5/livewire.js"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETlivewire-964474b5-livewire-js', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETlivewire-964474b5-livewire-js"
                    onclick="tryItOut('GETlivewire-964474b5-livewire-js');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETlivewire-964474b5-livewire-js"
                    onclick="cancelTryOut('GETlivewire-964474b5-livewire-js');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETlivewire-964474b5-livewire-js"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>livewire-964474b5/livewire.js</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETlivewire-964474b5-livewire-js"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETlivewire-964474b5-livewire-js"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETlivewire-964474b5-livewire-min-js-map">GET livewire-964474b5/livewire.min.js.map</h2>

<p>
</p>



<span id="example-requests-GETlivewire-964474b5-livewire-min-js-map">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/livewire-964474b5/livewire.min.js.map" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/livewire-964474b5/livewire.min.js.map"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETlivewire-964474b5-livewire-min-js-map">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">content-type: application/javascript; charset=utf-8
expires: Wed, 26 May 2027 14:32:40 GMT
cache-control: max-age=31536000, public
accept-ranges: bytes
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;"></code>
 </pre>
    </span>
<span id="execution-results-GETlivewire-964474b5-livewire-min-js-map" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETlivewire-964474b5-livewire-min-js-map"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETlivewire-964474b5-livewire-min-js-map"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETlivewire-964474b5-livewire-min-js-map" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETlivewire-964474b5-livewire-min-js-map">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETlivewire-964474b5-livewire-min-js-map" data-method="GET"
      data-path="livewire-964474b5/livewire.min.js.map"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETlivewire-964474b5-livewire-min-js-map', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETlivewire-964474b5-livewire-min-js-map"
                    onclick="tryItOut('GETlivewire-964474b5-livewire-min-js-map');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETlivewire-964474b5-livewire-min-js-map"
                    onclick="cancelTryOut('GETlivewire-964474b5-livewire-min-js-map');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETlivewire-964474b5-livewire-min-js-map"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>livewire-964474b5/livewire.min.js.map</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETlivewire-964474b5-livewire-min-js-map"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETlivewire-964474b5-livewire-min-js-map"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETlivewire-964474b5-livewire-csp-min-js-map">GET livewire-964474b5/livewire.csp.min.js.map</h2>

<p>
</p>



<span id="example-requests-GETlivewire-964474b5-livewire-csp-min-js-map">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/livewire-964474b5/livewire.csp.min.js.map" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/livewire-964474b5/livewire.csp.min.js.map"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETlivewire-964474b5-livewire-csp-min-js-map">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">content-type: application/javascript; charset=utf-8
expires: Wed, 26 May 2027 14:32:40 GMT
cache-control: max-age=31536000, public
accept-ranges: bytes
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;"></code>
 </pre>
    </span>
<span id="execution-results-GETlivewire-964474b5-livewire-csp-min-js-map" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETlivewire-964474b5-livewire-csp-min-js-map"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETlivewire-964474b5-livewire-csp-min-js-map"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETlivewire-964474b5-livewire-csp-min-js-map" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETlivewire-964474b5-livewire-csp-min-js-map">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETlivewire-964474b5-livewire-csp-min-js-map" data-method="GET"
      data-path="livewire-964474b5/livewire.csp.min.js.map"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETlivewire-964474b5-livewire-csp-min-js-map', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETlivewire-964474b5-livewire-csp-min-js-map"
                    onclick="tryItOut('GETlivewire-964474b5-livewire-csp-min-js-map');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETlivewire-964474b5-livewire-csp-min-js-map"
                    onclick="cancelTryOut('GETlivewire-964474b5-livewire-csp-min-js-map');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETlivewire-964474b5-livewire-csp-min-js-map"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>livewire-964474b5/livewire.csp.min.js.map</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETlivewire-964474b5-livewire-csp-min-js-map"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETlivewire-964474b5-livewire-csp-min-js-map"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTlivewire-964474b5-upload-file">POST livewire-964474b5/upload-file</h2>

<p>
</p>



<span id="example-requests-POSTlivewire-964474b5-upload-file">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/livewire-964474b5/upload-file" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/livewire-964474b5/upload-file"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTlivewire-964474b5-upload-file">
</span>
<span id="execution-results-POSTlivewire-964474b5-upload-file" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTlivewire-964474b5-upload-file"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTlivewire-964474b5-upload-file"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTlivewire-964474b5-upload-file" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTlivewire-964474b5-upload-file">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTlivewire-964474b5-upload-file" data-method="POST"
      data-path="livewire-964474b5/upload-file"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTlivewire-964474b5-upload-file', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTlivewire-964474b5-upload-file"
                    onclick="tryItOut('POSTlivewire-964474b5-upload-file');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTlivewire-964474b5-upload-file"
                    onclick="cancelTryOut('POSTlivewire-964474b5-upload-file');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTlivewire-964474b5-upload-file"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>livewire-964474b5/upload-file</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTlivewire-964474b5-upload-file"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTlivewire-964474b5-upload-file"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETlivewire-964474b5-preview-file--filename-">GET livewire-964474b5/preview-file/{filename}</h2>

<p>
</p>



<span id="example-requests-GETlivewire-964474b5-preview-file--filename-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/livewire-964474b5/preview-file/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/livewire-964474b5/preview-file/architecto"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETlivewire-964474b5-preview-file--filename-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: XSRF-TOKEN=eyJpdiI6Ink3L3ltc3VnMUhOQVRCMW56Sy9kUEE9PSIsInZhbHVlIjoibDdOdUxLc1Q4TG03UmhZS1FlS0VZMytOMDFKWkZMTEZTZndQWUlpYTBTLzRmMHdVdXdjTDFkRE5VcjRub1ZXb2ZHUVprcDd1V1RoREU1bDZSb3R0c1gxdXczajVaQWFxMUtZTVppZjAvTmxZVUlNOFFPUTQzcks2ZUc1RjJOZm8iLCJtYWMiOiI1MDRjNjc1NmQ0ZTJiOTcxNjg1NTYzYTExZWJlMzA2NGJiMTc0YjY3ZDU2OTIxMzg0MDRmMmE4ZTAyNzY4ZWJmIiwidGFnIjoiIn0%3D; expires=Tue, 26 May 2026 16:32:40 GMT; Max-Age=7200; path=/; samesite=lax; laravel-session=eyJpdiI6IjBwOHErUXNuSHdvV0paT1MyWTd2M0E9PSIsInZhbHVlIjoiVHFjWmRZSVFJSGtTZzBPSHNsSjdrZ0g4Mnl3WlpFaVNIUlV3WVh5K2JsSTh5cGx0SWpyRnpQL2F4cW9SOSt2enpoa0NzZDBRRmZ5YmZ4UlErMnFhOWR2TXg2VjBNZTJCRC9SckhMbDVybENjeS9KRUJuM29RSzRCU0hSK1crNWsiLCJtYWMiOiJlZDcwMjgzNDk0NmM5YzM2NTcyYmEzY2E0Zjc0NTAwNzg4ZmM3MGY0MmJkNzJhNjg0N2Q0YzIxM2RiNzhhYjUxIiwidGFnIjoiIn0%3D; expires=Tue, 26 May 2026 16:32:40 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETlivewire-964474b5-preview-file--filename-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETlivewire-964474b5-preview-file--filename-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETlivewire-964474b5-preview-file--filename-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETlivewire-964474b5-preview-file--filename-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETlivewire-964474b5-preview-file--filename-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETlivewire-964474b5-preview-file--filename-" data-method="GET"
      data-path="livewire-964474b5/preview-file/{filename}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETlivewire-964474b5-preview-file--filename-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETlivewire-964474b5-preview-file--filename-"
                    onclick="tryItOut('GETlivewire-964474b5-preview-file--filename-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETlivewire-964474b5-preview-file--filename-"
                    onclick="cancelTryOut('GETlivewire-964474b5-preview-file--filename-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETlivewire-964474b5-preview-file--filename-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>livewire-964474b5/preview-file/{filename}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETlivewire-964474b5-preview-file--filename-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETlivewire-964474b5-preview-file--filename-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>filename</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="filename"                data-endpoint="GETlivewire-964474b5-preview-file--filename-"
               value="architecto"
               data-component="url">
    <br>
<p>Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETlivewire-964474b5-js--component--js">GET livewire-964474b5/js/{component}.js</h2>

<p>
</p>



<span id="example-requests-GETlivewire-964474b5-js--component--js">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/livewire-964474b5/js/architecto.js" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/livewire-964474b5/js/architecto.js"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETlivewire-964474b5-js--component--js">
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Server Error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETlivewire-964474b5-js--component--js" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETlivewire-964474b5-js--component--js"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETlivewire-964474b5-js--component--js"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETlivewire-964474b5-js--component--js" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETlivewire-964474b5-js--component--js">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETlivewire-964474b5-js--component--js" data-method="GET"
      data-path="livewire-964474b5/js/{component}.js"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETlivewire-964474b5-js--component--js', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETlivewire-964474b5-js--component--js"
                    onclick="tryItOut('GETlivewire-964474b5-js--component--js');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETlivewire-964474b5-js--component--js"
                    onclick="cancelTryOut('GETlivewire-964474b5-js--component--js');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETlivewire-964474b5-js--component--js"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>livewire-964474b5/js/{component}.js</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETlivewire-964474b5-js--component--js"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETlivewire-964474b5-js--component--js"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>component</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="component"                data-endpoint="GETlivewire-964474b5-js--component--js"
               value="architecto"
               data-component="url">
    <br>
<p>Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETlivewire-964474b5-css--component--css">GET livewire-964474b5/css/{component}.css</h2>

<p>
</p>



<span id="example-requests-GETlivewire-964474b5-css--component--css">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/livewire-964474b5/css/architecto.css" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/livewire-964474b5/css/architecto.css"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETlivewire-964474b5-css--component--css">
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Server Error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETlivewire-964474b5-css--component--css" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETlivewire-964474b5-css--component--css"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETlivewire-964474b5-css--component--css"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETlivewire-964474b5-css--component--css" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETlivewire-964474b5-css--component--css">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETlivewire-964474b5-css--component--css" data-method="GET"
      data-path="livewire-964474b5/css/{component}.css"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETlivewire-964474b5-css--component--css', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETlivewire-964474b5-css--component--css"
                    onclick="tryItOut('GETlivewire-964474b5-css--component--css');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETlivewire-964474b5-css--component--css"
                    onclick="cancelTryOut('GETlivewire-964474b5-css--component--css');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETlivewire-964474b5-css--component--css"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>livewire-964474b5/css/{component}.css</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETlivewire-964474b5-css--component--css"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETlivewire-964474b5-css--component--css"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>component</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="component"                data-endpoint="GETlivewire-964474b5-css--component--css"
               value="architecto"
               data-component="url">
    <br>
<p>Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETlivewire-964474b5-css--component--global-css">GET livewire-964474b5/css/{component}.global.css</h2>

<p>
</p>



<span id="example-requests-GETlivewire-964474b5-css--component--global-css">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/livewire-964474b5/css/architecto.global.css" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/livewire-964474b5/css/architecto.global.css"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETlivewire-964474b5-css--component--global-css">
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Server Error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETlivewire-964474b5-css--component--global-css" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETlivewire-964474b5-css--component--global-css"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETlivewire-964474b5-css--component--global-css"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETlivewire-964474b5-css--component--global-css" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETlivewire-964474b5-css--component--global-css">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETlivewire-964474b5-css--component--global-css" data-method="GET"
      data-path="livewire-964474b5/css/{component}.global.css"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETlivewire-964474b5-css--component--global-css', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETlivewire-964474b5-css--component--global-css"
                    onclick="tryItOut('GETlivewire-964474b5-css--component--global-css');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETlivewire-964474b5-css--component--global-css"
                    onclick="cancelTryOut('GETlivewire-964474b5-css--component--global-css');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETlivewire-964474b5-css--component--global-css"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>livewire-964474b5/css/{component}.global.css</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETlivewire-964474b5-css--component--global-css"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETlivewire-964474b5-css--component--global-css"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>component</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="component"                data-endpoint="GETlivewire-964474b5-css--component--global-css"
               value="architecto"
               data-component="url">
    <br>
<p>Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETup">GET up</h2>

<p>
</p>



<span id="example-requests-GETup">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/up" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/up"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETup">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;up&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETup" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETup"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETup"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETup" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETup">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETup" data-method="GET"
      data-path="up"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETup', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETup"
                    onclick="tryItOut('GETup');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETup"
                    onclick="cancelTryOut('GETup');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETup"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>up</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETup"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETup"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETlogin">Display the login form</h2>

<p>
</p>



<span id="example-requests-GETlogin">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETlogin">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">content-type: text/html; charset=utf-8
cache-control: no-cache, private
set-cookie: XSRF-TOKEN=eyJpdiI6IlR6d3dFWWlpWmxRcExVTkI1NkZKZ1E9PSIsInZhbHVlIjoiZm5lQjJnYW5rZFZGVzZ4MVp6UXJBMjliZXk1VkI5SkRvRDFRRkVRbTVFeWVBd2VyT3VFVFY4aFNVclM2L2UraUQ4QkNhL2VOWWhKVnFzV3Fkb1FYOGR0NDNpSU5KbW9GNGJvSlkvZ1V1SGtoOC9uRHhFUXdQNVd4WjBMWHZNTlIiLCJtYWMiOiIyZjMyMmIyNmMzMzdiMzc1NWU3MTFkNzg5YzZjOGYyNzI2YmM2N2QzZDBkYjgwMTBhMmY0MDI0MTdlOGZjYjVkIiwidGFnIjoiIn0%3D; expires=Tue, 26 May 2026 16:32:40 GMT; Max-Age=7200; path=/; samesite=lax; laravel-session=eyJpdiI6IkVMVUpabkg1KzVOaHFWUXM2U0o0WGc9PSIsInZhbHVlIjoicEcwdUZlSU8rV3B6WTdjZ1k5c2pXanNpWVVYYkRLbzN2eFVwSFRGcVkzSHBkMkkrWCtVQ3RVZFl5cTQxbGJvbDN6aWJlQjI1Q2lOa2FEbUFBVEwzOVIwSzgvdGJMdHRhK3hRWnZlMzZXczhMOFlCZVR6K3FwYUZaME44eXJ4dkkiLCJtYWMiOiIxM2Y5ZmM5ZWU3OWYyNDhkM2UyNjc0YWZlNzBiZDVhYzllZTBkZDdmMGVhZmE5MGMzZjRmOTg1NDQ4ZWY1NDIxIiwidGFnIjoiIn0%3D; expires=Tue, 26 May 2026 16:32:40 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">&lt;!DOCTYPE html&gt;
&lt;html lang=&quot;id&quot;&gt;
&lt;head&gt;
    &lt;meta charset=&quot;utf-8&quot;&gt;
    &lt;meta name=&quot;viewport&quot; content=&quot;width=device-width, initial-scale=1.0&quot;&gt;
    &lt;title&gt;Login - Dapur Bunda Bahagia&lt;/title&gt;
    &lt;script src=&quot;https://cdn.tailwindcss.com&quot;&gt;&lt;/script&gt;
    &lt;link rel=&quot;preconnect&quot; href=&quot;https://fonts.googleapis.com&quot;&gt;
    &lt;link rel=&quot;preconnect&quot; href=&quot;https://fonts.gstatic.com&quot; crossorigin&gt;
    &lt;link href=&quot;https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&amp;family=Plus+Jakarta+Sans:wght@600;700&amp;display=swap&quot; rel=&quot;stylesheet&quot;&gt;
    &lt;script&gt;
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: &#039;#0F172A&#039;,
                        slate: &#039;#64748B&#039;,
                        sage: &#039;#059669&#039;,
                        success: &#039;#22C55E&#039;,
                        warning: &#039;#EAB308&#039;,
                        error: &#039;#EF4444&#039;,
                        info: &#039;#0EA5E9&#039;,
                    },
                    fontFamily: {
                        heading: [&#039;Plus Jakarta Sans&#039;, &#039;sans-serif&#039;],
                        body: [&#039;DM Sans&#039;, &#039;sans-serif&#039;],
                    },
                }
            }
        }
    &lt;/script&gt;
    &lt;style&gt;
        body { font-family: &#039;DM Sans&#039;, sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: &#039;Plus Jakarta Sans&#039;, sans-serif; }
    &lt;/style&gt;
&lt;/head&gt;
&lt;body class=&quot;bg-slate-50 min-h-screen flex items-center justify-center p-6&quot;&gt;

    &lt;div class=&quot;w-full max-w-md&quot;&gt;
        &lt;!-- Logo &amp; Title --&gt;
        &lt;div class=&quot;text-center mb-8&quot;&gt;
            &lt;div class=&quot;inline-flex items-center justify-center w-16 h-16 bg-navy rounded-xl mb-4&quot;&gt;
                &lt;svg class=&quot;w-8 h-8 text-white&quot; fill=&quot;none&quot; stroke=&quot;currentColor&quot; viewBox=&quot;0 0 24 24&quot;&gt;
                    &lt;path stroke-linecap=&quot;round&quot; stroke-linejoin=&quot;round&quot; stroke-width=&quot;2&quot; d=&quot;M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253&quot;&gt;&lt;/path&gt;
                &lt;/svg&gt;
            &lt;/div&gt;
            &lt;h1 class=&quot;text-2xl font-bold text-navy&quot;&gt;Dapur Bunda Bahagia&lt;/h1&gt;
            &lt;p class=&quot;text-slate mt-2&quot;&gt;Sistem Informasi Restoran&lt;/p&gt;
        &lt;/div&gt;

        &lt;!-- Login Card --&gt;
        &lt;div class=&quot;bg-white rounded-xl border border-slate-200 shadow-sm p-8&quot;&gt;
            &lt;h2 class=&quot;text-xl font-semibold text-navy mb-6&quot;&gt;Masuk ke Akun Anda&lt;/h2&gt;

            
            &lt;form method=&quot;POST&quot; action=&quot;/login&quot; class=&quot;space-y-5&quot;&gt;
                &lt;input type=&quot;hidden&quot; name=&quot;_token&quot; value=&quot;kAuOjkgSSLMKVjiwAXSjXRUWEi1eRB5py4eBX50i&quot; autocomplete=&quot;off&quot;&gt;
                &lt;!-- Email Field --&gt;
                &lt;div&gt;
                    &lt;label for=&quot;email&quot; class=&quot;block text-sm font-medium text-navy mb-1.5&quot;&gt;Alamat Email&lt;/label&gt;
                    &lt;input
                        type=&quot;email&quot;
                        id=&quot;email&quot;
                        name=&quot;email&quot;
                        value=&quot;&quot;
                        required
                        autofocus
                        class=&quot;w-full h-11 px-4 border border-slate-200 rounded-lg text-body bg-white placeholder-slate-400
                               hover:border-navy focus:outline-none focus:border-2 focus:border-navy focus:ring-2 focus:ring-navy/10
                               &quot;
                        placeholder=&quot;admin@dapur.com&quot;
                    &gt;
                &lt;/div&gt;

                &lt;!-- Password Field --&gt;
                &lt;div&gt;
                    &lt;label for=&quot;password&quot; class=&quot;block text-sm font-medium text-navy mb-1.5&quot;&gt;Kata Sandi&lt;/label&gt;
                    &lt;input
                        type=&quot;password&quot;
                        id=&quot;password&quot;
                        name=&quot;password&quot;
                        required
                        class=&quot;w-full h-11 px-4 border border-slate-200 rounded-lg text-body bg-white placeholder-slate-400
                               hover:border-navy focus:outline-none focus:border-2 focus:border-navy focus:ring-2 focus:ring-navy/10
                               &quot;
                        placeholder=&quot;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&quot;
                    &gt;
                &lt;/div&gt;

                &lt;!-- Remember Me --&gt;
                &lt;div class=&quot;flex items-center&quot;&gt;
                    &lt;input
                        type=&quot;checkbox&quot;
                        id=&quot;remember&quot;
                        name=&quot;remember&quot;
                        class=&quot;w-4 h-4 rounded border-slate-300 text-navy focus:ring-navy/20&quot;
                    &gt;
                    &lt;label for=&quot;remember&quot; class=&quot;ml-3 text-sm text-slate&quot;&gt;Ingat saya&lt;/label&gt;
                &lt;/div&gt;

                &lt;!-- Submit Button --&gt;
                &lt;button
                    type=&quot;submit&quot;
                    class=&quot;w-full h-11 bg-navy hover:bg-navy-800 text-white font-semibold rounded-lg transition-all duration-200 shadow-sm hover:shadow-md flex items-center justify-center gap-2&quot;
                &gt;
                    &lt;span&gt;Masuk&lt;/span&gt;
                    &lt;svg class=&quot;w-4 h-4&quot; fill=&quot;none&quot; stroke=&quot;currentColor&quot; viewBox=&quot;0 0 24 24&quot;&gt;
                        &lt;path stroke-linecap=&quot;round&quot; stroke-linejoin=&quot;round&quot; stroke-width=&quot;2&quot; d=&quot;M14 5l7 7m0 0l-7 7m7-7H3&quot;&gt;&lt;/path&gt;
                    &lt;/svg&gt;
                &lt;/button&gt;
            &lt;/form&gt;
        &lt;/div&gt;

        &lt;!-- Footer --&gt;
        &lt;p class=&quot;text-center text-slate text-sm mt-6&quot;&gt;
            &amp;copy; 2026 Dapur Bunda Bahagia. All rights reserved.
        &lt;/p&gt;
    &lt;/div&gt;

&lt;/body&gt;
&lt;/html&gt;</code>
 </pre>
    </span>
<span id="execution-results-GETlogin" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETlogin"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETlogin"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETlogin" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETlogin">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETlogin" data-method="GET"
      data-path="login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETlogin', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETlogin"
                    onclick="tryItOut('GETlogin');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETlogin"
                    onclick="cancelTryOut('GETlogin');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETlogin"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETlogin"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETlogin"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTlogin">Authenticate user and log them in</h2>

<p>
</p>



<span id="example-requests-POSTlogin">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"gbailey@example.net\",
    \"password\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "gbailey@example.net",
    "password": "architecto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTlogin">
</span>
<span id="execution-results-POSTlogin" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTlogin"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTlogin"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTlogin" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTlogin">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTlogin" data-method="POST"
      data-path="login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTlogin', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTlogin"
                    onclick="tryItOut('POSTlogin');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTlogin"
                    onclick="cancelTryOut('POSTlogin');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTlogin"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTlogin"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTlogin"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTlogin"
               value="gbailey@example.net"
               data-component="body">
    <br>
<p>Must be a valid email address. Example: <code>gbailey@example.net</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTlogin"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTlogout">Log the user out and invalidate the session</h2>

<p>
</p>



<span id="example-requests-POSTlogout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/logout" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/logout"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTlogout">
</span>
<span id="execution-results-POSTlogout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTlogout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTlogout"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTlogout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTlogout">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTlogout" data-method="POST"
      data-path="logout"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTlogout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTlogout"
                    onclick="tryItOut('POSTlogout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTlogout"
                    onclick="cancelTryOut('POSTlogout');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTlogout"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>logout</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTlogout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTlogout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTmidtrans-notification">Handle Midtrans payment notification webhook</h2>

<p>
</p>



<span id="example-requests-POSTmidtrans-notification">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/midtrans/notification" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/midtrans/notification"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTmidtrans-notification">
</span>
<span id="execution-results-POSTmidtrans-notification" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTmidtrans-notification"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTmidtrans-notification"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTmidtrans-notification" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTmidtrans-notification">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTmidtrans-notification" data-method="POST"
      data-path="midtrans/notification"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTmidtrans-notification', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTmidtrans-notification"
                    onclick="tryItOut('POSTmidtrans-notification');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTmidtrans-notification"
                    onclick="cancelTryOut('POSTmidtrans-notification');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTmidtrans-notification"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>midtrans/notification</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTmidtrans-notification"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTmidtrans-notification"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GET-">GET /</h2>

<p>
</p>



<span id="example-requests-GET-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GET-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: XSRF-TOKEN=eyJpdiI6Ild3QW1VNGhIU0xmSmcyczR5aENPUVE9PSIsInZhbHVlIjoiWXZKSFFGRzVyOWtpY0lNVDFIRm1RUGhyMGhmOG5VVmhZcmJPeDNUM1puRHAyTE9jQ0luOVFRbGlZY0trOGFjS2JZQmdtYXpsWktaWW1aWkEwYW9oZzYxVlM3Y1AvQ3JPeldzcENYRmZleVNYTTJHSnNuU0NTTExRanc2dGJBYVIiLCJtYWMiOiIwNTY1MzQzMGYwYjYzMWNhMGFmMGQ5ZGI4OTI4ZjcwNDljZTQ0MTMzZmJmY2U4NDNiNjVmN2UwM2MwMzRhZGM0IiwidGFnIjoiIn0%3D; expires=Tue, 26 May 2026 16:32:40 GMT; Max-Age=7200; path=/; samesite=lax; laravel-session=eyJpdiI6IjQyU2NsUUM5M095ZVY4dElJRDF6SlE9PSIsInZhbHVlIjoiVDFiNFQ5ancrYTRYellQcHBYTjF3b1ROSllZUjNZRGV5Z1hVM05sTEdnRWdRUXZObVBnMkRSUXBUbC9udkc0eEIrRGp2Uy96c09pQnl1KzFyTjlza0dHLzIxU0NGaWwrSWdhbU5jakpPQkZnSVJFVkhFUXJ2NS9PM3BUQ1RWc1MiLCJtYWMiOiI5ZGVhMzk0ODczZjZhZjY2NTAxZTU4MzU5MjhhZDYxNmFlMzNmOTEyNjdhYmE4MTI3YmYzZjQ0YWFiMGYwNzM4IiwidGFnIjoiIn0%3D; expires=Tue, 26 May 2026 16:32:40 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GET-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GET-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GET-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GET-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GET-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GET-" data-method="GET"
      data-path="/"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GET-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GET-"
                    onclick="tryItOut('GET-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GET-"
                    onclick="cancelTryOut('GET-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GET-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>/</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GET-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GET-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETpos">GET pos</h2>

<p>
</p>



<span id="example-requests-GETpos">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/pos" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/pos"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETpos">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: XSRF-TOKEN=eyJpdiI6InB6akYyOEVibmdrczd2UzZNek9MVkE9PSIsInZhbHVlIjoiREt4cDNLYmpCbTZBMG4vRFdQRDViT2NsTGZzV25zM052YWxXNVJRTDI2YWJrRkt5TXhncVBUdEM4VVhNUnlaQ2t6MllHRDN0TlNQeDZmSGdLcE9RM1k3bC91eG04NTZtc1BqbUlrSjNkTXBtOURoK3VPTGhqNUtvYm81MmhCYXkiLCJtYWMiOiI0NGYxNmYzMjU3ZmQyM2U1YjYzM2RmZTE4ZmIzOTdiYzMwOTcwMjhmMjEyMGU3OTRlY2ExNmVhNTUzODUyZjBiIiwidGFnIjoiIn0%3D; expires=Tue, 26 May 2026 16:32:40 GMT; Max-Age=7200; path=/; samesite=lax; laravel-session=eyJpdiI6IjJkMTl6eGRjVXJ4Qmg5OWh3UHlKYVE9PSIsInZhbHVlIjoiZitSTnM0bW1naGU4TndNMDdrV1Z0YndxaWYrRmdsRUUySk9RL3VER284eTF5aGhWcGY1SEo5Mkkra0NQbU0wYkF6MVpKbTFlMUdHRWZxc1czWkRFZ20rTTBGb0tXNE9KaktNdm9CZjE5RHBVM1BscHhHNzNXVGxzRGlXTjBUZUciLCJtYWMiOiIyNjllNjAzMTI3YmQ4MDI5NTMzODY3MWJhNjdkMjM2Y2FhOGU2N2U4MTExYjQ3MzgyMDBjNTQ1MWZjMjQyODNlIiwidGFnIjoiIn0%3D; expires=Tue, 26 May 2026 16:32:40 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETpos" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETpos"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETpos"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETpos" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETpos">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETpos" data-method="GET"
      data-path="pos"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETpos', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETpos"
                    onclick="tryItOut('GETpos');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETpos"
                    onclick="cancelTryOut('GETpos');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETpos"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>pos</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETpos"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETpos"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETreceipt--orderId--download">Download receipt as PDF</h2>

<p>
</p>



<span id="example-requests-GETreceipt--orderId--download">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/receipt/architecto/download" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/receipt/architecto/download"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETreceipt--orderId--download">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: XSRF-TOKEN=eyJpdiI6InFISW5lWTBtVFB6eFc4NHV4NzF6b0E9PSIsInZhbHVlIjoiUzhyaU5ra0RtcVBlZ0dUQ0xqMThaZWxWR094RGZuYmlDY21JcW5QeVVHUVhVT2o4b01JNGF5THhPU3k0eDBLL29sR0x1cXpZSG9ZSUZxS2FiY2FZYnpvUWxQdVpXZStFbzdpeExubWxhbHVmRTV2SmJmRE1VQm90YXBMS0crQTEiLCJtYWMiOiIwZDUxOTcxYTZjOTZlYTY1NzVlZTU0NWE3NGU1MGY1MGI4ODE3YjY4YmFiNWI0YTgzNTg5YTFiNGM1MWJiYjRlIiwidGFnIjoiIn0%3D; expires=Tue, 26 May 2026 16:32:40 GMT; Max-Age=7200; path=/; samesite=lax; laravel-session=eyJpdiI6ImhJUEZtR3FXcnBZVHY2ZEhPT2tjNlE9PSIsInZhbHVlIjoibnJUeG1mUUFvbEwzajJTZ2UzWnZrS1EwV3grZGhCOVhGN2t6ZldCOVhuNDE2WktlQnZQT1N0K0xwYTllS2JQRTlrUjF4U21xTzkreDk0bGh6aHpDKzUyTU5VeDZBemx2c05zK3pJSy80R0tBbzFadndoRmRJdnA3UUFvT2dlazgiLCJtYWMiOiIwNWRjNjExYmYyMTA1YWM4ZjI3NzUxMzMxYTc5NmNkZDJmNDUzMjJiYjVhM2RiMjhiYWQxNzA3MjE3YTEyY2VlIiwidGFnIjoiIn0%3D; expires=Tue, 26 May 2026 16:32:40 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETreceipt--orderId--download" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETreceipt--orderId--download"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETreceipt--orderId--download"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETreceipt--orderId--download" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETreceipt--orderId--download">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETreceipt--orderId--download" data-method="GET"
      data-path="receipt/{orderId}/download"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETreceipt--orderId--download', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETreceipt--orderId--download"
                    onclick="tryItOut('GETreceipt--orderId--download');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETreceipt--orderId--download"
                    onclick="cancelTryOut('GETreceipt--orderId--download');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETreceipt--orderId--download"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>receipt/{orderId}/download</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETreceipt--orderId--download"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETreceipt--orderId--download"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>orderId</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="orderId"                data-endpoint="GETreceipt--orderId--download"
               value="architecto"
               data-component="url">
    <br>
<p>Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETreceipt--orderId--print">Display receipt for printing</h2>

<p>
</p>



<span id="example-requests-GETreceipt--orderId--print">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/receipt/architecto/print" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/receipt/architecto/print"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETreceipt--orderId--print">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: XSRF-TOKEN=eyJpdiI6ImJZbWlvR1p3WFJnYVhFVFZUenljQ2c9PSIsInZhbHVlIjoiYldzRUl1MFNORkVkVUJkWXhQZi9QUDZsa2FOQjFteFljOXJuUDM2ZXc3bWVOV25tTVE1aEcxYzRxZmY5OFl0T2taSWl4OVR4M1gyN0NVbk85a0Y5SjRrK0p1cWdUbXpJUDhmUUhqcmhFZm11K000a252UkEwdUJKSFlObkt0UkYiLCJtYWMiOiJhZWMxM2RiNzhjZGJmZjVjMzc1ZjJjMmJmMTczNWE0YzE3YTViNDExOWRmNzEzMjc5NzVhMGM4YTlhNmZhNjgyIiwidGFnIjoiIn0%3D; expires=Tue, 26 May 2026 16:32:40 GMT; Max-Age=7200; path=/; samesite=lax; laravel-session=eyJpdiI6InhCbnArYWc2SGtidjNhdEhDQStCaEE9PSIsInZhbHVlIjoiYTVoUGFVVFR3dkNNemRXTjkvSWJCM0RWOVpFemdCV1pDKzNsaFZKcFhLckxHYnNtZW04NmN3TUVLT1d2Z3dYWU1DcGcyblU1UUJoNGYyWWgyamIwTDZBaGNRRUZqWDhxVlB2U1RXalJObWNPemdvc2dJWTJUNXU0dXRSZEFqMmgiLCJtYWMiOiJlZGM0M2NlYWQ3YzMyNTExMGUzMDgwZDY3MDk5ZGFmMWIxYjI0NThmZTE1NjFiZmZkMGM2YzhhOTc5OWI4OTVjIiwidGFnIjoiIn0%3D; expires=Tue, 26 May 2026 16:32:40 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETreceipt--orderId--print" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETreceipt--orderId--print"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETreceipt--orderId--print"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETreceipt--orderId--print" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETreceipt--orderId--print">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETreceipt--orderId--print" data-method="GET"
      data-path="receipt/{orderId}/print"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETreceipt--orderId--print', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETreceipt--orderId--print"
                    onclick="tryItOut('GETreceipt--orderId--print');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETreceipt--orderId--print"
                    onclick="cancelTryOut('GETreceipt--orderId--print');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETreceipt--orderId--print"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>receipt/{orderId}/print</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETreceipt--orderId--print"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETreceipt--orderId--print"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>orderId</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="orderId"                data-endpoint="GETreceipt--orderId--print"
               value="architecto"
               data-component="url">
    <br>
<p>Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETadmin-dashboard">GET admin/dashboard</h2>

<p>
</p>



<span id="example-requests-GETadmin-dashboard">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/admin/dashboard" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/dashboard"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETadmin-dashboard">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: XSRF-TOKEN=eyJpdiI6IjZvTHV5bnZuUHNhTjAvRnplNUZOVlE9PSIsInZhbHVlIjoiWHBzRk5SWjJrWDZ2UlcvRmpuV3ZTcmVFa24zLy9WMTBQbUZZSDZMVmpKQy9PRVJEeVpSdmhFR2ZWdW92UHY4SzhEMDQvd3NEMnYyNmU0R3FKUHUybEJuM3d0VytwV2xoLzgwWDZuN01PalNpakllcnVoVW4vTnYxck80UWpMbFgiLCJtYWMiOiIwNmUzNWRhMDg2MGIyYWYwZTBjMDE2ZjNlM2E1NzdiMTQ0YjE0NjBjZjRlMWY2M2IxOWQzOWI3OTc1MWRkYWIyIiwidGFnIjoiIn0%3D; expires=Tue, 26 May 2026 16:32:40 GMT; Max-Age=7200; path=/; samesite=lax; laravel-session=eyJpdiI6ImorQkdrYk1RcUl2SXkzRTFjYWdLR3c9PSIsInZhbHVlIjoiNk5mU3VkdmU0R2Fsd2d5REVxN2QzbFdUQ2NsRUFaZXE2NENqUkg1eW1odkcyNW5ZOFpKQVJnd05QN1VFd1lyTitZZDJxU2FuZnZUY29xUEl2anAzVWx1VWRjNmNNRkNRWDdadHI5c1lwU2tnRDJnNzBPamkzaWFtQ3dqN0ZLeUgiLCJtYWMiOiIzMzc2YjcyOGI4YzA1MzE5MDllMDMxMDA2ZTEwZTY1MmRmMDU5MTQxYWIwZDc3ZDYzYmRmMWNkOThiZGVkYWZjIiwidGFnIjoiIn0%3D; expires=Tue, 26 May 2026 16:32:40 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETadmin-dashboard" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETadmin-dashboard"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETadmin-dashboard"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETadmin-dashboard" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETadmin-dashboard">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETadmin-dashboard" data-method="GET"
      data-path="admin/dashboard"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETadmin-dashboard', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETadmin-dashboard"
                    onclick="tryItOut('GETadmin-dashboard');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETadmin-dashboard"
                    onclick="cancelTryOut('GETadmin-dashboard');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETadmin-dashboard"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>admin/dashboard</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETadmin-dashboard"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETadmin-dashboard"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETadmin-products">GET admin/products</h2>

<p>
</p>



<span id="example-requests-GETadmin-products">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/admin/products" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/products"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETadmin-products">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: XSRF-TOKEN=eyJpdiI6Ikp3UWJhdEppNXRHVG9VUWhQYUNJc0E9PSIsInZhbHVlIjoiZnhWQmNmYmFLby9ZZEpLa25LeUl4N2lrcEc2Y1F3ZVhCRDFSaGQwN3RQOUtlVXh2UCs3ckNOS2FEMCs0U3Voc0JadWMrS1hMVmRieDBoRUp5NGRweGtoV0lEZGZpWlpub1VPeXdKd09rTUhFUjA3S0V5b0lucitXbGt3ZWZCV0MiLCJtYWMiOiJlNTY3NTc2OTFjNTIwZGY2M2ZkNTVjYTYyMTY3MTMzMzFjYTliYjhmNTBhM2IwMTZlNzA4ZWNiNjZkMTdjNGRjIiwidGFnIjoiIn0%3D; expires=Tue, 26 May 2026 16:32:40 GMT; Max-Age=7200; path=/; samesite=lax; laravel-session=eyJpdiI6ImNSQ3p2OEFHUTdndldHTGwwN2xSSUE9PSIsInZhbHVlIjoiMlppbm1KaU1MMmIrNXQ3dXEzNEtNbDFONGI3alBsSTV2ZGJWQThERTVrTWV4YTdaOEw1QStZMzN1clo1UmZNTndpK3QxM0JZa2cwUW9CRTNiQ29wV0w5d3lUU21UQkIxcHRWb0oxdmQ4QlZScGZGbGFXcW9NSzdMblFYZ0tpM0giLCJtYWMiOiIxODMwODc2NGZmOTA3OWU0MjViNGMwYzcyNTU1MWI2ZTM3YmJjNDYyNjMwNjkxM2JhNTAxYTcyNjgzNzA2N2Q3IiwidGFnIjoiIn0%3D; expires=Tue, 26 May 2026 16:32:40 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETadmin-products" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETadmin-products"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETadmin-products"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETadmin-products" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETadmin-products">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETadmin-products" data-method="GET"
      data-path="admin/products"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETadmin-products', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETadmin-products"
                    onclick="tryItOut('GETadmin-products');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETadmin-products"
                    onclick="cancelTryOut('GETadmin-products');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETadmin-products"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>admin/products</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETadmin-products"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETadmin-products"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETadmin-categories">GET admin/categories</h2>

<p>
</p>



<span id="example-requests-GETadmin-categories">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/admin/categories" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/categories"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETadmin-categories">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: XSRF-TOKEN=eyJpdiI6IlpuY2hmQzhEZzVBZGNUOWVjRGJkU3c9PSIsInZhbHVlIjoiSUE1MU9XYTExNi9QbE12YS96dWMzdXNxdDRuWGYrOGFwNVJyaGRwalJkM2ZVMG9tL0x1K28yVnlwcDVCdWx3b1NtcVM3U3YzOVQxb1VJVlJndXE0U21jaGZlWkpGMmZIWUF2Y1djVE05bGgrbWU2Yi9SSnpVSmkyVkJ6MEt6ckoiLCJtYWMiOiI1MGM0MDA2MjA5MGRmMWYxMzExMjY0Y2M3MzFkMzY0ZTNlZWEyNjhhOTY0ZDUxZWZmNGVjNGJlNzlmZTIxMWE4IiwidGFnIjoiIn0%3D; expires=Tue, 26 May 2026 16:32:40 GMT; Max-Age=7200; path=/; samesite=lax; laravel-session=eyJpdiI6IjhrenQ1a0pKbWp2bldSbmRSRk1xTXc9PSIsInZhbHVlIjoiYjVxYlo4cXZidXFYN3F3cndMbmZZRUdwN3ozc3U4YUxWbVIwN3BselFuZENZdisrUVdYdUE5V2plWE9ReE1wd1ZRdHhJVVBwYWVZam8yTnBnQnV6Z2QyNEVrYzVPNk1jMDd3VSt6Ly82Q3lMY041VjFhR2Z2OWVtcHdZaE1Vc0kiLCJtYWMiOiI5YWRhYzE2NWM2YWQyYTRhYmRlYmI0YTUwMGMwMzVmZDEzMGQzNDM5MjcwZTNiNzJlNjBjM2VlZThkNGRiOTNiIiwidGFnIjoiIn0%3D; expires=Tue, 26 May 2026 16:32:40 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETadmin-categories" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETadmin-categories"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETadmin-categories"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETadmin-categories" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETadmin-categories">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETadmin-categories" data-method="GET"
      data-path="admin/categories"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETadmin-categories', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETadmin-categories"
                    onclick="tryItOut('GETadmin-categories');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETadmin-categories"
                    onclick="cancelTryOut('GETadmin-categories');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETadmin-categories"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>admin/categories</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETadmin-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETadmin-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETadmin-tables">GET admin/tables</h2>

<p>
</p>



<span id="example-requests-GETadmin-tables">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/admin/tables" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/tables"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETadmin-tables">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: XSRF-TOKEN=eyJpdiI6IjFtMXlXM25yaEZWTi9rUTdrRXlwU1E9PSIsInZhbHVlIjoibi8yZmJwNitZR2Y2ZFozRHlBZnc0bFlsRXFLR2FZTCtlUzZDdDQ5TXVsZnJtR2dkQWpqZlpVNTZVNTZVWEhCdzJSSEJrVTlPZUVNUEltcnVhcjE4OXcxSVdPSTdEV1hJRkxHZFFLRkFzWVRUalJyMVl2eXYyUUlDVmx0aDNBWU0iLCJtYWMiOiIzYzA1MzU1ZmJmNWJhMDVlMTM4ZjBkNGE5YTgzYjAyZDljOWY2NjQ4YzhiOTM2NWE3NTQ1YzY5MmY0OTBkZDMzIiwidGFnIjoiIn0%3D; expires=Tue, 26 May 2026 16:32:40 GMT; Max-Age=7200; path=/; samesite=lax; laravel-session=eyJpdiI6IkJlMTUrRndPVTBRbkEyZURvYmJqZFE9PSIsInZhbHVlIjoiVUZST3JtSVZsVk1yWVNDZElMQlZRaUZ3MWoyLzdGeTN2RTFWMEIydVpKZllhc09kWWt3RFMxZU0zbzE2TkJiNWlWdUdGQUVpck1OdTA5bUluTWpSdXBFQ216S0REZll2WWpKcGZKWGJPYkxlUm8rdjk3M0tyVlJhckFtMlk3bHoiLCJtYWMiOiJjNDlkYWY1NmJjNzZkYzM0NGQ3OWFiZmFjZDVkMGUxNGVjMjc1NmIyMzRlZjMwYmRlNGJiMGNlNjA0YWM0OTlmIiwidGFnIjoiIn0%3D; expires=Tue, 26 May 2026 16:32:40 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETadmin-tables" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETadmin-tables"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETadmin-tables"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETadmin-tables" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETadmin-tables">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETadmin-tables" data-method="GET"
      data-path="admin/tables"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETadmin-tables', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETadmin-tables"
                    onclick="tryItOut('GETadmin-tables');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETadmin-tables"
                    onclick="cancelTryOut('GETadmin-tables');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETadmin-tables"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>admin/tables</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETadmin-tables"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETadmin-tables"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETadmin-users">GET admin/users</h2>

<p>
</p>



<span id="example-requests-GETadmin-users">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/admin/users" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/users"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETadmin-users">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: XSRF-TOKEN=eyJpdiI6InAyc1FBci9KSU5GZVBoMCtHb1QyUkE9PSIsInZhbHVlIjoibVFCbENMelhrRzNsMkZmN0JUbCtQZk1KanJiUTJieVlhYjliZFMvNHkyNmExODdJSENHT2haWFFMZUV3R2Y1cXloVVJoOWdlTHJCNDhlcnpsNC95T1dVMXc1Y0lCZnJqclhIRkdDeXZXSlFNMklwOXpNb1JtY09aYVdDalZqQmkiLCJtYWMiOiI0YTA5NjAyY2VmMjdkMDQ4MDQ4YTU3MjJkMTFkMDY2MDE0ODJjNjdhZDJkY2Q4Njc1MWI5Yjc4NjRiOGMxMjgxIiwidGFnIjoiIn0%3D; expires=Tue, 26 May 2026 16:32:40 GMT; Max-Age=7200; path=/; samesite=lax; laravel-session=eyJpdiI6IkxjT2U4NU9nMkVGSFN4MXlWa05uRFE9PSIsInZhbHVlIjoiY1EvK2w3L1hoV2F2aEg1WXh6UENuVjlBcnZUdkdGcFBHR3QwWFpCR2hhblc4aTltTk01blZKbkVtTmV4TXNRMnZ1TGxwNFZyNlRTSkVpbzdzS1pyTkhMV3VLMkY2c1RyZ2tHWkdCZnpSeGl1WWhrRnZRVE5tYXZDQUd6TUVTSGciLCJtYWMiOiJlZWFjMTdmZTU1YTUyNjhkOTZlMzZmODQ4N2JjZmJlZjQ1ZTQ0OTk3MWY0MGM4NzRkN2E4ZTlmYjllY2RmOTIyIiwidGFnIjoiIn0%3D; expires=Tue, 26 May 2026 16:32:40 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETadmin-users" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETadmin-users"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETadmin-users"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETadmin-users" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETadmin-users">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETadmin-users" data-method="GET"
      data-path="admin/users"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETadmin-users', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETadmin-users"
                    onclick="tryItOut('GETadmin-users');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETadmin-users"
                    onclick="cancelTryOut('GETadmin-users');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETadmin-users"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>admin/users</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETadmin-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETadmin-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETadmin-orders">GET admin/orders</h2>

<p>
</p>



<span id="example-requests-GETadmin-orders">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/admin/orders" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/orders"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETadmin-orders">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: XSRF-TOKEN=eyJpdiI6Im9BMFRqTVBXd0d0NHE4WGdLVGI5b2c9PSIsInZhbHVlIjoiZE1saG1vTVcwMG8rYUhrSkJJS3daNldUeEFkTk94SkVwMXpIY0llUU8yYVFPZFNzN0JoL3pSSjU3U2ZaYnJrUy9sNTYzY3dPNlE1WDF1MEFMVC9hOVozM3g1TU9kakxNRS9RVHhzV3VaNC83OG9aM1hRam5pdDFGZDc5MjRvUWciLCJtYWMiOiIzMzJhODM3OWMyM2VkMGQ4NmNlYjUzOWVmNDgyZTZiZTgyMDdiYjFlOTJmZDZjMjBkZmNjZjFlMTBlZDYyZDg2IiwidGFnIjoiIn0%3D; expires=Tue, 26 May 2026 16:32:40 GMT; Max-Age=7200; path=/; samesite=lax; laravel-session=eyJpdiI6InNCaTBTclFmcjFhNFJlMDZUbTVGeEE9PSIsInZhbHVlIjoiWDgyQ0tMbTBqT3lsWFliQWduUGF3QU5vQSswTmx4Nkt6SW9XS0o1Y2dnYzJZYlhoSG9meWo1RGpKWkUzdUJxNVhaRU1GeTFkSVcvdVJJT0RQckxWMy9xTUFldnhtcjJxL0l0Y1NIc3JKUVF5bXhzMFV0aVN4MHFxUTZpN2crWTciLCJtYWMiOiI3YTJjMTFhOGVmZWU1M2I2ZGQ0Y2IyZjZlMDQ2ZGM0YjdjYzEzZDIxY2Y1ZTA2NzZkODRiN2ZkODg2ZWVmZjg0IiwidGFnIjoiIn0%3D; expires=Tue, 26 May 2026 16:32:40 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETadmin-orders" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETadmin-orders"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETadmin-orders"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETadmin-orders" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETadmin-orders">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETadmin-orders" data-method="GET"
      data-path="admin/orders"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETadmin-orders', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETadmin-orders"
                    onclick="tryItOut('GETadmin-orders');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETadmin-orders"
                    onclick="cancelTryOut('GETadmin-orders');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETadmin-orders"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>admin/orders</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETadmin-orders"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETadmin-orders"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETadmin-activity-log">GET admin/activity-log</h2>

<p>
</p>



<span id="example-requests-GETadmin-activity-log">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/admin/activity-log" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/activity-log"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETadmin-activity-log">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: XSRF-TOKEN=eyJpdiI6ImZVZzh3U2hBTW5iNEFhMXBuQk1oRkE9PSIsInZhbHVlIjoieVEwTHV1bkdPUHNSU3pNdDV6U3FVdHFGdThtNmJiQ25RTmxIejduTWRDZWxiLzVhZlUzT2Rub2Rtdk52WitPRlY5aVJLN25pam1QakphUUt5TDZOaklIbmZia0dtNm9KcGIxNGdsV2lhdWFNVk9WMUpkamZHbHlmbXVUUWIrdkgiLCJtYWMiOiI1ZmQ0YmM2YzRkMDczYTEwYjJlZDQwNmFhYTI3OTliYTU4Yjc0ODI1YTI3ZjQ4MDczMTY4YThmYjMzZDc3OGZjIiwidGFnIjoiIn0%3D; expires=Tue, 26 May 2026 16:32:40 GMT; Max-Age=7200; path=/; samesite=lax; laravel-session=eyJpdiI6IjZTNVIvaDBkdTVOemViOHZoa0FtL0E9PSIsInZhbHVlIjoiMm52OGdKV0pqMWF4ZUVKQmZFRE5SVlVBU012TGJEU3R5RTg4UFp2ZzFPdDYyYlpFSmFhcWQrS2ZhR0JzOFFWNGlSVU14b1VXcDF5WnhKbjQxNDJTaXRXazhBUmU2Z2ZJZWZHa2p1M0FrVU1lOXM5Vmh6bkMwNW9jNmwyWDU1dG4iLCJtYWMiOiIyNjRiYjM2NjI2OTE2ZGI5ZGZiYzAyZWI2YmZmOTA2OWMxNGFjMTljZGJiMjdlYWEyNTIwN2NkM2EzOWZjMDAxIiwidGFnIjoiIn0%3D; expires=Tue, 26 May 2026 16:32:40 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETadmin-activity-log" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETadmin-activity-log"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETadmin-activity-log"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETadmin-activity-log" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETadmin-activity-log">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETadmin-activity-log" data-method="GET"
      data-path="admin/activity-log"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETadmin-activity-log', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETadmin-activity-log"
                    onclick="tryItOut('GETadmin-activity-log');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETadmin-activity-log"
                    onclick="cancelTryOut('GETadmin-activity-log');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETadmin-activity-log"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>admin/activity-log</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETadmin-activity-log"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETadmin-activity-log"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETadmin-reports">GET admin/reports</h2>

<p>
</p>



<span id="example-requests-GETadmin-reports">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/admin/reports" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/reports"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETadmin-reports">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: XSRF-TOKEN=eyJpdiI6IjAwOVFabi9uamFSM25kR2oyYmF3K3c9PSIsInZhbHVlIjoiOWo4bUdVdnU0eDAvR2tKN21nRktoMlQrVW9ydHptYXBsd2VOQTJhclJuNUlJRVF3bTErR2ZVNFU0UkpoWk9vVTFIb29nWXQ1TXh2b0xOVmFpWmtGVUt4RTBIQTBnSE9KSDNJcWRLNEI4UCs4cnh6Rm5kSHJ1SjdmZ1MxMC9BQmciLCJtYWMiOiI5OGQxNjZjMmM5ZWY5ZTBjNGMzOTFiY2NmNjViNTg4N2NmYzE3YmEyMTM3YWZmNDFhMDg0ZmJiMDI0ZGUxNzc3IiwidGFnIjoiIn0%3D; expires=Tue, 26 May 2026 16:32:40 GMT; Max-Age=7200; path=/; samesite=lax; laravel-session=eyJpdiI6IjNvWDkwaUxRSHRObjBBUW5mS2RGL0E9PSIsInZhbHVlIjoiMlhzWS9FRGNLbCtja21wNGtRL1VvNVR0SzVyY2RTbnQ4T0VFd1Jjb3NEbVhQaUpmcEl1M2hCZHgvZGphWUwzem13NnZObGx4RklZZ2hIaUk0Z3RkUHpaMUFKUVVLbU5UcVlpakUzU1JQWFZPd2xBY01Xampkd05TM3Rwd3BraEEiLCJtYWMiOiIwYzBiZGY3YzU3M2M2YzQwYmI3YTQxZDRlMDM3MWQ0ZmUzNmUwMzdjYTA0MDFlMWFmOThhYzhjMmVkYTZlMmMyIiwidGFnIjoiIn0%3D; expires=Tue, 26 May 2026 16:32:40 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETadmin-reports" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETadmin-reports"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETadmin-reports"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETadmin-reports" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETadmin-reports">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETadmin-reports" data-method="GET"
      data-path="admin/reports"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETadmin-reports', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETadmin-reports"
                    onclick="tryItOut('GETadmin-reports');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETadmin-reports"
                    onclick="cancelTryOut('GETadmin-reports');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETadmin-reports"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>admin/reports</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETadmin-reports"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETadmin-reports"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETadmin-reports-export-excel">Export sales report to Excel</h2>

<p>
</p>



<span id="example-requests-GETadmin-reports-export-excel">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/admin/reports/export/excel" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/reports/export/excel"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETadmin-reports-export-excel">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: XSRF-TOKEN=eyJpdiI6Imx1UDhPUnV4NERqRUV1amlpSXp1emc9PSIsInZhbHVlIjoiOFlxU0d0R2t0cisweWxRZTE0b0RMdkM3dGUzcjhWL3gxQS9IV29oYksrSERLTlIrMDZOZmlxOVlvNzBIVS9qMytwUnVacElwa0VVK2I1YW9mNW5hdTZpVnVpRnRKVU9uTkgxemNGelJBT0V3Z3ZtNTBhVWdhUGN5Yk10Ty9IWnUiLCJtYWMiOiI0YzIxMjk4ZTEwYWNhMWVmM2U2Yjg1Njc1MmJlYTc0ZTVhZjg4MDU4NWM5MjE3YTc4ZmJiZjE0NjRkNGI2NTk5IiwidGFnIjoiIn0%3D; expires=Tue, 26 May 2026 16:32:40 GMT; Max-Age=7200; path=/; samesite=lax; laravel-session=eyJpdiI6IlhBM21VN3NTSnk3Mmxxc3ovSlAyVVE9PSIsInZhbHVlIjoiRXJyTXc0M0pldWRyZ1ZhOFlOWFgrckZ4U0psM3pXRlE4eS94aTU2SVM4eE5qWTgzWlFBMElKRi8wamNYU2JsbzcxbFpTcmllY01hM0xaRW9pNkhGZldqVkdKaEdNWFNvOUlXUEFSMmFya1JiLzRNL1NIS1BXZ1orNmIwNVNaT2giLCJtYWMiOiI2YzlhOTY0NTI5NmJmNjcyZWMwMmQ3ZTA3YjhiOWRkZjdkNzIxNGMzMzM1YTk5MWRlODZlYTM0MzkyMDAzYzNmIiwidGFnIjoiIn0%3D; expires=Tue, 26 May 2026 16:32:40 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETadmin-reports-export-excel" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETadmin-reports-export-excel"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETadmin-reports-export-excel"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETadmin-reports-export-excel" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETadmin-reports-export-excel">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETadmin-reports-export-excel" data-method="GET"
      data-path="admin/reports/export/excel"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETadmin-reports-export-excel', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETadmin-reports-export-excel"
                    onclick="tryItOut('GETadmin-reports-export-excel');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETadmin-reports-export-excel"
                    onclick="cancelTryOut('GETadmin-reports-export-excel');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETadmin-reports-export-excel"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>admin/reports/export/excel</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETadmin-reports-export-excel"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETadmin-reports-export-excel"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETadmin-reports-export-pdf">Export sales report to PDF</h2>

<p>
</p>



<span id="example-requests-GETadmin-reports-export-pdf">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/admin/reports/export/pdf" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/admin/reports/export/pdf"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETadmin-reports-export-pdf">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: XSRF-TOKEN=eyJpdiI6ImluaW9RY0x4WjAyZVk3L1VQVkx1ZEE9PSIsInZhbHVlIjoiZW9lZ1NqS1dGaitLbFJJUW1LbzdTZFFFSjQwb2VTVVlPMXNJeURjZkNxTU9wbUdqV2J0dVlLRWNpMUlaUUh6a0VaNnVCeTYvbDRiUGR4K1BjWTZ3VFVGTmR5RU9PeHVBSWMwMGFCa3E1c0k3TkY1VlIrbVJFNjA1c1lzSVpGa3giLCJtYWMiOiIyODMyN2Y0OTU1OWI4YWZkYWE1NTRmNDI3ZTJmYWU5M2IwMGNkODhjMjY4YWUyNGYzNGM5MDg4MmE5MDc2MDlhIiwidGFnIjoiIn0%3D; expires=Tue, 26 May 2026 16:32:40 GMT; Max-Age=7200; path=/; samesite=lax; laravel-session=eyJpdiI6IlM5a1VGb1hucFVqSDBuS2swUFdWU0E9PSIsInZhbHVlIjoiYUZEWlVZeDUvdkgyKzF3QTkzM2dlOWhEdnVvVjZaQUF5TUFZNVU4V1NhZjRLVDh0Y2xlemN3dlhOMmJIclk2aWxhU3k2WE5aTWxvU1h3MUpueUxJWEo3V1Ura1RmOWp5R21ZNW9NUmJXVG9xNy9XUXBqeDMrbk0zVHpydEx0TXoiLCJtYWMiOiIwNTFiZWZmMWNiM2NiMzEyYzFmOGExNjA2NmNjNGQ5MjA3Mzg5NDY0MjQyOTNmMzFhMDliM2QzMWIyYjg0NGFiIiwidGFnIjoiIn0%3D; expires=Tue, 26 May 2026 16:32:40 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETadmin-reports-export-pdf" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETadmin-reports-export-pdf"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETadmin-reports-export-pdf"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETadmin-reports-export-pdf" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETadmin-reports-export-pdf">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETadmin-reports-export-pdf" data-method="GET"
      data-path="admin/reports/export/pdf"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETadmin-reports-export-pdf', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETadmin-reports-export-pdf"
                    onclick="tryItOut('GETadmin-reports-export-pdf');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETadmin-reports-export-pdf"
                    onclick="cancelTryOut('GETadmin-reports-export-pdf');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETadmin-reports-export-pdf"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>admin/reports/export/pdf</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETadmin-reports-export-pdf"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETadmin-reports-export-pdf"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETstorage--path-">GET storage/{path}</h2>

<p>
</p>



<span id="example-requests-GETstorage--path-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/storage/|{+-0p" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/storage/|{+-0p"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETstorage--path-">
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETstorage--path-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETstorage--path-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETstorage--path-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETstorage--path-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETstorage--path-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETstorage--path-" data-method="GET"
      data-path="storage/{path}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETstorage--path-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETstorage--path-"
                    onclick="tryItOut('GETstorage--path-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETstorage--path-"
                    onclick="cancelTryOut('GETstorage--path-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETstorage--path-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>storage/{path}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETstorage--path-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETstorage--path-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>path</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="path"                data-endpoint="GETstorage--path-"
               value="|{+-0p"
               data-component="url">
    <br>
<p>Example: <code>|{+-0p</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTstorage--path-">PUT storage/{path}</h2>

<p>
</p>



<span id="example-requests-PUTstorage--path-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/storage/|{+-0p" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/storage/|{+-0p"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTstorage--path-">
</span>
<span id="execution-results-PUTstorage--path-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTstorage--path-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTstorage--path-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTstorage--path-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTstorage--path-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTstorage--path-" data-method="PUT"
      data-path="storage/{path}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTstorage--path-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTstorage--path-"
                    onclick="tryItOut('PUTstorage--path-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTstorage--path-"
                    onclick="cancelTryOut('PUTstorage--path-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTstorage--path-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>storage/{path}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTstorage--path-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTstorage--path-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>path</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="path"                data-endpoint="PUTstorage--path-"
               value="|{+-0p"
               data-component="url">
    <br>
<p>Example: <code>|{+-0p</code></p>
            </div>
                    </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
