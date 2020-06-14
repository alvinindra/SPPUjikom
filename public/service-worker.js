importScripts('https://storage.googleapis.com/workbox-cdn/releases/5.1.2/workbox-sw.js');

if (workbox)
    console.log(`Workbox berhasil dimuat`);
else
    console.log(`Workbox gagal dimuat`);

workbox.precaching.precacheAndRoute([{
        url: '/css/app.css',
        revision: '1'
    },
    {
        url: '/css/dashboard.css',
        revision: '1'
    },
    {
        url: '/css/dashboard.rtl.css',
        revision: '1'
    },
    {
        url: '/css/tabler.css',
        revision: '1'
    },
    {
        url: '/css/tabler.rtl.css',
        revision: '1'
    },
    {
        url: '/css/daterangepicker.css',
        revision: '1'
    },
    {
        url: '/js/dashboard.js',
        revision: '1'
    },
    {
        url: '/js/core.js',
        revision: '1'
    },
    {
        url: '/js/require.min.js',
        revision: '1'
    },
]);
