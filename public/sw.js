const CACHE_NAME = "Welora-V1";
const urlsToCache = [
    "/",
    "/cart",
    "/login",
    "/assets/style.css",
    "/manifest.json",
];

self.addEventListener("install", (event) => {
    console.log("SW installing...");
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => cache.addAll(urlsToCache))
    );
});

self.addEventListener("activate", (event) => {
    console.log("SW activated");
    event.waitUntil(
        caches.keys().then((names) =>
            Promise.all(
                names.map((name) => {
                    if (name !== CACHE_NAME) return caches.delete(name);
                })
            )
        )
    );
});

self.addEventListener("fetch", (event) => {
    event.respondWith(
        caches.match(event.request).then((res) => res || fetch(event.request))
    );
});
