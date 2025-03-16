<div class="relative h-screen overflow-hidden">
    <div x-data="{ active: 0, images: [
        'https://wallpapers.com/images/hd/chrome-hearts-hoodie-rh85y49m84f6sui4.jpg',
        'https://wallpapers.com/images/hd/chrome-hearts-display-figure-bfeoq5ra0pc66xjp.jpg',
        'https://wallpapers.com/images/hd/chrome-hearts-club-be0b195uxic2r0b4.jpg'
    ] }"
    x-init="setInterval(() => { active = (active + 1) % images.length }, 4000)"
    class="relative w-full h-screen">
    
    <!-- Background Images -->
    <template x-for="(image, index) in images" :key="index">
        <div class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000"
            :class="active === index ? 'opacity-100' : 'opacity-0'"
            :style="'background-image: url(' + image + ')'">
        </div>
    </template>

</div>

  <!-- Description at the bottom corner -->
  <div class="absolute bottom-20 left-0 p-6 z-10" data-aos="fade-up"
  data-aos-duration="1500">
<!--
    <button wire:navigate href=""
    class="rounded-lg bg-gray-900 font-bold py-3.5 px-6 border border-transparent text-center text-base text-white transition-all shadow hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
    >
    Shop now
    </button>
-->
  </div>

   
</div>


