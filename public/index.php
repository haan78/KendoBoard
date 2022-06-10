<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Shiai</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="/icons/apple-touch-icon.png" sizes="180x180">
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#317EFB" />
</head>

<body>

    <div id="app"></div>
    <link rel="stylesheet" type="text/css" href="/main.css" />
    <script type="module" src="/main.js"></script>
    <script>
        if('serviceWorker' in navigator){
            navigator.serviceWorker.register('/sw.js').then(reg => console.log('service worker registered')).catch(err => console.log('service worker not registered', err));
        }
    </script>
    <style>
        body {
            margin:0;
            padding: 0;
           /* height: 100vh;*/
            overflow: hidden;
        }
        #app {
            height: 100vh;
            /*overflow: hidden;*/
        }
        
    </style>
</body>

</html>