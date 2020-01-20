// //This is the service worker with the combined offline experience (Offline page + Offline copy of pages)
var version = 'v2::';
//Install stage sets up the offline page in the cache and opens a new cache
self.addEventListener('install', function(event) {
  event.waitUntil(preLoad());
});

var preLoad = function(){
  console.log('Install Event processing');
  return caches.open('stritart').then(function(cache) {
    console.log('Cached index and offline page during Install');
    return cache.addAll(["/offline.html", "/index", "index.php", "/runner/home", "/runner-thanks", "/request/", "/user/home", "/user/cart", "/user/thanks", "/market/", "/order/"]);
  });
}

self.addEventListener('fetch', function(event) {
  console.log('The service worker is serving the asset.');
  event.respondWith(checkResponse(event.request).catch(function() {
    return returnFromCache(event.request)}
  ));
  event.waitUntil(addToCache(event.request));
});

self.addEventListener("activate", function(event) {
  /* Just like with the install event, event.waitUntil blocks activate on a promise.
     Activation will fail unless the promise is fulfilled.
  */
  console.log('WORKER: activate event in progress.');

  event.waitUntil(
    caches
      /* This method returns a promise which will resolve to an array of available
         cache keys.
      */
      .keys()
      .then(function (keys) {
        // We return a promise that settles when all outdated caches are deleted.
        return Promise.all(
          keys
            .filter(function (key) {
              // Filter by keys that don't start with the latest version prefix.
              return !key.startsWith(version);
            })
            .map(function (key) {
              /* Return a promise that's fulfilled
                 when each outdated cache is deleted.
              */
              return caches.delete(key);
            })
        );
      })
      .then(function() {
        console.log('WORKER: activate completed.');
      })
  );
});

var checkResponse = function(request){
  return new Promise(function(fulfill, reject) {
    fetch(request).then(function(response){
      if(response.status !== 404) {
        fulfill(response)
      } else {
        reject()
      }
    }, reject)
  });
};

var addToCache = function(request){
  return caches.open('stritart').then(function (cache) {
    return fetch(request).then(function (response) {
      console.log('add page to offline '+response.url)
      return cache.put(request, response);
    });
  });
};

var returnFromCache = function(request){
  return caches.open('stritart').then(function (cache) {
    return cache.match(request).then(function (matching) {
     if(!matching || matching.status == 404) {
       return cache.match('/offline.html')
     } else {
       return matching
     }
    });
  });
};


