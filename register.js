//This is the service worker with the combined offline experience (Offline page + Offline copy of pages)
if (location.protocol != 'https:')
{
 location.href = 'https:' + window.location.href.substring(window.location.protocol.length);
}
//Add this below content to your HTML page, or add the js file to your page at the very top to register service worker
if (navigator.serviceWorker.controller) {
  console.log('active service worker found, no need to register')
} else {

//Register the ServiceWorker
  navigator.serviceWorker.register('/sw.js', {scope: '/'}).then(function(reg) 
  {
    console.log('Service worker has been registered for scope:'+ reg.scope);
  });
}



