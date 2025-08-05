// vite.config.js
import path from "path";
import { defineConfig } from "file:///var/www/sites/Comcash/node_modules/vite/dist/node/index.js";
import laravel from "file:///var/www/sites/Comcash/node_modules/laravel-vite-plugin/dist/index.mjs";
import tailwindcss from "file:///var/www/sites/Comcash/node_modules/tailwindcss/lib/index.js";
var __vite_injected_original_dirname = "/var/www/sites/Comcash";
var vite_config_default = defineConfig({
  build: {
    minify: false,
    sourcemap: true
  },
  plugins: [
    laravel({
      input: ["resources/js/app.js", "resources/js/comcash/main.ts", "resources/js/comcash/main2.ts", "resources/js/comcash/main3.ts"],
      refresh: true
    })
  ],
  resolve: {
    alias: {
      "@": path.resolve(__vite_injected_original_dirname, "resources/js/comcash")
    }
  },
  css: {
    postcss: {
      plugins: [tailwindcss]
    }
  }
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcuanMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCIvdmFyL3d3dy9zaXRlcy9Db21jYXNoXCI7Y29uc3QgX192aXRlX2luamVjdGVkX29yaWdpbmFsX2ZpbGVuYW1lID0gXCIvdmFyL3d3dy9zaXRlcy9Db21jYXNoL3ZpdGUuY29uZmlnLmpzXCI7Y29uc3QgX192aXRlX2luamVjdGVkX29yaWdpbmFsX2ltcG9ydF9tZXRhX3VybCA9IFwiZmlsZTovLy92YXIvd3d3L3NpdGVzL0NvbWNhc2gvdml0ZS5jb25maWcuanNcIjtpbXBvcnQgcGF0aCBmcm9tICdwYXRoJztcbmltcG9ydCB7IGRlZmluZUNvbmZpZyB9IGZyb20gJ3ZpdGUnO1xuaW1wb3J0IGxhcmF2ZWwgZnJvbSAnbGFyYXZlbC12aXRlLXBsdWdpbic7XG5pbXBvcnQgdGFpbHdpbmRjc3MgZnJvbSAndGFpbHdpbmRjc3MnXG5cblxuZXhwb3J0IGRlZmF1bHQgZGVmaW5lQ29uZmlnKHtcbiAgICBidWlsZDoge1xuICAgICAgICBtaW5pZnk6IGZhbHNlLCBcbiAgICAgICAgc291cmNlbWFwOiB0cnVlLCBcbiAgICB9LFxuICAgIHBsdWdpbnM6IFtcbiAgICAgICAgbGFyYXZlbCh7XG4gICAgICAgICAgICBpbnB1dDogWydyZXNvdXJjZXMvanMvYXBwLmpzJywgJ3Jlc291cmNlcy9qcy9jb21jYXNoL21haW4udHMnLCAncmVzb3VyY2VzL2pzL2NvbWNhc2gvbWFpbjIudHMnLCAncmVzb3VyY2VzL2pzL2NvbWNhc2gvbWFpbjMudHMnXSxcbiAgICAgICAgICAgIHJlZnJlc2g6IHRydWUsXG4gICAgICAgIH0pLFxuICAgIF0sXG4gICAgcmVzb2x2ZToge1xuICAgICAgICBhbGlhczoge1xuICAgICAgICAgICdAJzogcGF0aC5yZXNvbHZlKF9fZGlybmFtZSwgJ3Jlc291cmNlcy9qcy9jb21jYXNoJylcbiAgICAgICAgfVxuICAgIH0sXG4gICAgY3NzOiB7XG4gICAgICAgIHBvc3Rjc3M6IHtcbiAgICAgICAgICBwbHVnaW5zOiBbdGFpbHdpbmRjc3NdLFxuICAgICAgICB9LFxuICAgICAgfSxcbn0pO1xuIl0sCiAgIm1hcHBpbmdzIjogIjtBQUFvUCxPQUFPLFVBQVU7QUFDclEsU0FBUyxvQkFBb0I7QUFDN0IsT0FBTyxhQUFhO0FBQ3BCLE9BQU8saUJBQWlCO0FBSHhCLElBQU0sbUNBQW1DO0FBTXpDLElBQU8sc0JBQVEsYUFBYTtBQUFBLEVBQ3hCLE9BQU87QUFBQSxJQUNILFFBQVE7QUFBQSxJQUNSLFdBQVc7QUFBQSxFQUNmO0FBQUEsRUFDQSxTQUFTO0FBQUEsSUFDTCxRQUFRO0FBQUEsTUFDSixPQUFPLENBQUMsdUJBQXVCLGdDQUFnQyxpQ0FBaUMsK0JBQStCO0FBQUEsTUFDL0gsU0FBUztBQUFBLElBQ2IsQ0FBQztBQUFBLEVBQ0w7QUFBQSxFQUNBLFNBQVM7QUFBQSxJQUNMLE9BQU87QUFBQSxNQUNMLEtBQUssS0FBSyxRQUFRLGtDQUFXLHNCQUFzQjtBQUFBLElBQ3JEO0FBQUEsRUFDSjtBQUFBLEVBQ0EsS0FBSztBQUFBLElBQ0QsU0FBUztBQUFBLE1BQ1AsU0FBUyxDQUFDLFdBQVc7QUFBQSxJQUN2QjtBQUFBLEVBQ0Y7QUFDTixDQUFDOyIsCiAgIm5hbWVzIjogW10KfQo=
