import { createApp, createSSRApp, nextTick } from "/v/_nuxt/node_modules/.cache/vite/client/deps/vue.js?v=15553336";
import { $fetch } from "/v/_nuxt/node_modules/ofetch/dist/index.mjs?v=15553336";
import { baseURL } from "/v/_nuxt/@id/virtual:nuxt:/Users/kamilwawrzynczuk/Desktop/Projects/em-light/.nuxt/paths.mjs";
import { applyPlugins, createNuxtApp } from "/v/_nuxt/node_modules/nuxt/dist/app/nuxt.js?v=15553336";
import "/v/_nuxt/@id/virtual:nuxt:/Users/kamilwawrzynczuk/Desktop/Projects/em-light/.nuxt/css.mjs?t=1715857006913";
import plugins from "/v/_nuxt/@id/virtual:nuxt:/Users/kamilwawrzynczuk/Desktop/Projects/em-light/.nuxt/plugins/client.mjs?t=1715857006913";
import RootComponent from "/v/_nuxt/@id/virtual:nuxt:/Users/kamilwawrzynczuk/Desktop/Projects/em-light/.nuxt/root-component.mjs";
import { appRootId } from "/v/_nuxt/@id/virtual:nuxt:/Users/kamilwawrzynczuk/Desktop/Projects/em-light/.nuxt/nuxt.config.mjs";
if (!globalThis.$fetch) {
  globalThis.$fetch = $fetch.create({
    baseURL: baseURL()
  });
}
let entry;
if (process.server) {
  entry = async function createNuxtAppServer(ssrContext) {
    const vueApp = createApp(RootComponent);
    const nuxt = createNuxtApp({ vueApp, ssrContext });
    try {
      await applyPlugins(nuxt, plugins);
      await nuxt.hooks.callHook("app:created", vueApp);
    } catch (err) {
      await nuxt.hooks.callHook("app:error", err);
      nuxt.payload.error = nuxt.payload.error || err;
    }
    if (ssrContext?._renderResponse) {
      throw new Error("skipping render");
    }
    return vueApp;
  };
}
if (process.client) {
  if (process.dev && import.meta.webpackHot) {
    import.meta.webpackHot.accept();
  }
  let vueAppPromise;
  entry = async function initApp() {
    if (vueAppPromise) {
      return vueAppPromise;
    }
    const isSSR = Boolean(
      window.__NUXT__?.serverRendered || document.getElementById("__NUXT_DATA__")?.dataset.ssr === "true"
    );
    const vueApp = isSSR ? createSSRApp(RootComponent) : createApp(RootComponent);
    const nuxt = createNuxtApp({ vueApp });
    try {
      await applyPlugins(nuxt, plugins);
    } catch (err) {
      await nuxt.callHook("app:error", err);
      nuxt.payload.error = nuxt.payload.error || err;
    }
    try {
      await nuxt.hooks.callHook("app:created", vueApp);
      await nuxt.hooks.callHook("app:beforeMount", vueApp);
      vueApp.mount("#" + appRootId);
      await nuxt.hooks.callHook("app:mounted", vueApp);
      await nextTick();
    } catch (err) {
      await nuxt.callHook("app:error", err);
      nuxt.payload.error = nuxt.payload.error || err;
    }
    return vueApp;
  };
  vueAppPromise = entry().catch((error) => {
    console.error("Error while mounting app:", error);
  });
}
export default (ctx) => entry(ctx);
