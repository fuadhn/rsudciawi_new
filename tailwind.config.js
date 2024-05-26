/** @type {import('tailwindcss').Config} */
module.exports = {
  prefix: 'rsc-',
  content: [
    // Frontpage
    // "./functions.php",
    // "./includes/filters.php",
    // "./includes/functions.php",
    // "./includes/hooks.php",
    // "./header.php",
    // "./template-parts/header/header-primary.php",
    // "./front-page.php",
    // "./template-parts/section/slideshow.php",
    // "./template-parts/section/contact.php",
    // "./template-parts/section/about.php",
    // "./template-parts/section/service.php",
    // "./template-parts/section/promo.php",
    // "./template-parts/section/blog.php",
    // "./template-parts/section/pkrs.php",
    // "./template-parts/section/gallery.php",
    // "./footer.php",
    // "./template-parts/footer/footer-primary.php",
    // "./src/css/frontpage.css",
    // "./dist/js/main.js",
    // "./dist/js/frontpage.js"

    // Dokter
    // "./functions.php",
    // "./includes/filters.php",
    // "./includes/functions.php",
    // "./includes/hooks.php",
    // "./header.php",
    // "./template-parts/header/header-primary.php",
    // "./pages/dokter.php",
    // "./footer.php",
    // "./template-parts/footer/footer-primary.php",
    // "./src/css/dokter.css",
    // "./dist/js/main.js",
    // "./dist/js/dokter.js"

    // Single Dokter
    "./functions.php",
    "./includes/filters.php",
    "./includes/functions.php",
    "./includes/hooks.php",
    "./header.php",
    "./template-parts/header/header-primary.php",
    "./single-dokter.php",
    "./footer.php",
    "./template-parts/footer/footer-primary.php",
    "./src/css/single-dokter.css",
    "./dist/js/main.js",
    "./dist/js/single-dokter.js"

    // Single Layanan
    // "./functions.php",
    // "./includes/filters.php",
    // "./includes/functions.php",
    // "./includes/hooks.php",
    // "./header.php",
    // "./template-parts/header/header-primary.php",
    // "./single-layanan.php",
    // "./footer.php",
    // "./template-parts/footer/footer-primary.php",
    // "./src/css/single-layanan.css",
    // "./dist/js/main.js",
    // "./dist/js/single-layanan.js"

    // Promo
    // "./functions.php",
    // "./includes/filters.php",
    // "./includes/functions.php",
    // "./includes/hooks.php",
    // "./header.php",
    // "./template-parts/header/header-primary.php",
    // "./pages/promo.php",
    // "./footer.php",
    // "./template-parts/footer/footer-primary.php",
    // "./src/css/promo.css",
    // "./dist/js/main.js",
    // "./dist/js/promo.js"

    // Single Promo
    // "./functions.php",
    // "./includes/filters.php",
    // "./includes/functions.php",
    // "./includes/hooks.php",
    // "./header.php",
    // "./template-parts/header/header-primary.php",
    // "./single-promo.php",
    // "./footer.php",
    // "./template-parts/footer/footer-primary.php",
    // "./src/css/single-promo.css",
    // "./dist/js/main.js",
    // "./dist/js/single-promo.js"

    // PKRS
    // "./functions.php",
    // "./includes/filters.php",
    // "./includes/functions.php",
    // "./includes/hooks.php",
    // "./header.php",
    // "./template-parts/header/header-primary.php",
    // "./pages/pkrs.php",
    // "./template-parts/section/gallery.php",
    // "./footer.php",
    // "./template-parts/footer/footer-primary.php",
    // "./src/css/pkrs.css",
    // "./dist/js/main.js",
    // "./dist/js/pkrs.js"

    // Single Kegiatan
    // "./functions.php",
    // "./includes/filters.php",
    // "./includes/functions.php",
    // "./includes/hooks.php",
    // "./header.php",
    // "./template-parts/header/header-primary.php",
    // "./single-kegiatan.php",
    // "./template-parts/section/gallery.php",
    // "./footer.php",
    // "./template-parts/footer/footer-primary.php",
    // "./src/css/single-kegiatan.css",
    // "./dist/js/main.js",
    // "./dist/js/single-kegiatan.js"

    // Blog
    // "./functions.php",
    // "./includes/filters.php",
    // "./includes/functions.php",
    // "./includes/hooks.php",
    // "./header.php",
    // "./template-parts/header/header-primary.php",
    // "./index.php",
    // "./home.php",
    // "./archive.php",
    // "./search.php",
    // "./footer.php",
    // "./template-parts/footer/footer-primary.php",
    // "./src/css/home.css",
    // "./dist/js/main.js",
    // "./dist/js/home.js"

    // Single Page
    // "./functions.php",
    // "./includes/filters.php",
    // "./includes/functions.php",
    // "./includes/hooks.php",
    // "./header.php",
    // "./template-parts/header/header-primary.php",
    // "./page.php",
    // "./footer.php",
    // "./template-parts/footer/footer-primary.php",
    // "./src/css/page.css",
    // "./dist/js/main.js",
    // "./dist/js/page.js"

    // Single Post
    // "./functions.php",
    // "./includes/filters.php",
    // "./includes/functions.php",
    // "./includes/hooks.php",
    // "./header.php",
    // "./template-parts/header/header-primary.php",
    // "./single.php",
    // "./template-parts/section/gallery.php",
    // "./footer.php",
    // "./template-parts/footer/footer-primary.php",
    // "./src/css/single.css",
    // "./dist/js/main.js",
    // "./dist/js/single.js"
  ],
  theme: {
    extend: {
      colors: {
        'rscprimary': '#118a6b',
        'rscprimary-light': '#638f7e',
        'rscsecondary-first': '#ffa280',
        'rscsecondary': '#e17852',
        'rscsecondary-third': '#cb572c',
        'rscsecondary-light': '#e8825a',
        'rscbrown': '#a59673',
        'rscdark': '#1f2937',
        'rscwhatsapp': '#25d366'
      },
      fontFamily: {
        'nunito': 'Nunito',
        'open-sans': 'Open Sans'
      }
    },
  },
  plugins: [],
}