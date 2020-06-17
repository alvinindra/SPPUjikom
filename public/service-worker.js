importScripts('https://storage.googleapis.com/workbox-cdn/releases/5.1.2/workbox-sw.js');

if (workbox)
    console.log(`Workbox berhasil dimuat`);
else
    console.log(`Workbox gagal dimuat`);

workbox.setConfig({
    "debug": false
});

// Start controlling any existing clients as soon as it activates
workbox.core.clientsClaim()

// Skip over the SW waiting lifecycle stage
workbox.core.skipWaiting()

workbox.precaching.cleanupOutdatedCaches()

workbox.routing.registerRoute(new RegExp('/'), new workbox.strategies.NetworkFirst({}), 'GET')

workbox.routing.registerRoute(
    new RegExp('https://storage.googleapis.com/workbox-cdn/releases/5.1.2/workbox-sw.js'),
    new workbox.strategies.CacheFirst({}), 'GET'
)
