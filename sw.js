/*
 Copyright 2019 IndiaTests. All Rights Reserved.
 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at
 http://www.apache.org/licenses/LICENSE-2.0
 */

'use strict';

const appPath = '/staging/its/';

const staticAssets = [
	appPath,
	appPath + 'index.php',
	appPath + 'login/page/index', 
	appPath + 'themes/la/assets/css/style.css',
	appPath + 'themes/la/assets/css/bootstrap.min.css',
	appPath + 'themes/la/assets/css/chart.min.css',
	appPath + 'themes/la/assets/css/colors-alert.css',
	appPath + 'themes/la/assets/css/colors-background.css',
	appPath + 'themes/la/assets/css/colors-text.css',
	appPath + 'themes/la/assets/css/colors-buttons.css',
	appPath + 'themes/la/assets/css/colors-calendar.css',
	appPath + 'themes/la/assets/css/colors-progress-bars.css',
	appPath + 'themes/la/assets/css/essentials.css',
	appPath + 'themes/la/assets/css/fontawesome.css',
	appPath + 'themes/la/assets/css/toastr.min.css',
	appPath + 'themes/la/assets/css/sidebar-skins.css',
	appPath + 'themes/la/assets/js/app.js',
	appPath + 'themes/la/assets/js/bootstrap.bundle.min.js',
	appPath + 'themes/la/assets/js/chart.bundle.min.js',
	appPath + 'themes/la/assets/js/countdown.min.js',
	appPath + 'themes/la/assets/js/jquery.min.js',
	appPath + 'themes/la/assets/js/jquery.validate.min.js',
	appPath + 'themes/la/assets/img/favicon.png',
	appPath + 'themes/la/assets/img/loader.gif',
];

self.addEventListener ('install', async event => {
	const cache = await caches.open ('IndiaTests-V1');
	cache.addAll (staticAssets);
	console.log ('ServiceWorker Installed');
});

self.addEventListener ('fetch', event => {
	const request = event.request;
	const url = new URL (request.url);

	if (url.origin == location.origin) {
		event.respondWith (cacheFirst(request));		
	} else {
		event.respondWith (networkFirst(request));		
	}	
	console.log ('ServiceWorker Fetch');
});

async function cacheFirst (request) { 
	const cachedResponse = await caches.match (request);
	return cachedResponse || fetch (request);
}

async function networkFirst (request) {
	const cache = await caches.open ('IndiaTests-V1-dynamic');
	try {
		const response = await fetch(request);
		cache.put (request, response.clone());
		return response;
	} catch (error) {
		const cachedResponse = await cache.match (request);
		return cachedResponse || await caches.match (appPath + 'fallback.json');
	}
}