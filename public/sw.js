importScripts(
    "https://storage.googleapis.com/workbox-cdn/releases/6.4.1/workbox-sw.js"
);

// For Offline Capability
// workbox.routing.setDefaultHandler(new workbox.strategies.NetworkFirst());

workbox.recipes.offlineFallback();