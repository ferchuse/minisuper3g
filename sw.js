//Service Worker https://vaadin.com/learn/tutorials/learn-pwa/turn-website-into-a-pwa?hss_channel=tw-33905417&utm_campaign=Learning%20Center&utm_medium=social&utm_content=92191959&utm_source=twitter

self.addEventListener('install', async event => {
  console.log('install event')
});

self.addEventListener('fetch', async event => {
  console.log('fetch event')
});