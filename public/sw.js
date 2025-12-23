const CACHE_NAME = "Welora-V2";

const urlsToCache = ["/", "/assets/style.css", "/manifest.json"];

self.addEventListener("install", (event) => {
    console.log("SW installing...");
    self.skipWaiting();
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
                    if (name !== CACHE_NAME) {
                        console.log("Menghapus cache lama:", name);
                        return caches.delete(name);
                    }
                })
            )
        )
    );
    return self.clients.claim();
});

self.addEventListener("fetch", (event) => {
    if (event.request.method !== "GET") {
        return;
    }

    event.respondWith(
        fetch(event.request)
            .then((networkResponse) => {
                return networkResponse;
            })
            .catch(() => {
                return caches.match(event.request);
            })
    );
});
