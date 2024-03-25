// import { ofetch } from "ofetch";
// import { stringify } from "qs";
// import type { $Fetch, NitroFetchOptions, NitroFetchRequest } from "nitropack";


// function wrapFetch(fetch: $Fetch) {
//     return (
//       request: NitroFetchRequest,
//       options: NitroFetchOptions<any> = {}
//     ): ReturnType<$Fetch> => {
//       // modify request if has params in options
//       let modifiedRequest, modifiedOptions;
//       if (options?.query) {
//         // append query string and delete query from options
//         modifiedRequest = request + "?" + stringify(options.query);
//         modifiedOptions = options;
//         delete modifiedOptions.query;
//       } else {
//         // use as is
//         modifiedRequest = request;
//         modifiedOptions = options;
//       }
  
//       return fetch(modifiedRequest, modifiedOptions);
//     };
//   }
  
//   export const useApi = () => {
//     const config = useRuntimeConfig();
  
//     return wrapFetch(
//       ofetch.create({
//         baseURL: config.apiUrl || config.public.apiUrl,
//         headers: {
//           "Content-Type": "application/json",
//           Accept: "application/ld+json",
//         },
//       })
//     );
//   };