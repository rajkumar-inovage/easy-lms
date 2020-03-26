/*
 Copyright 2019 IndiaTests. All Rights Reserved.
 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at
 http://www.apache.org/licenses/LICENSE-2.0
 */

'use strict';

const appPath = '/repos/easycoachingapp/';

const staticAssets = [
	appPath,
	appPath + 'index.html',
];

self.addEventListener ('install', async event => {
	const cache = await caches.open ('EasyCoaching-V1');
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