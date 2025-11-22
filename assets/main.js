import sliderProducts from './components/ProductsSlider/ProductsSlider.js';
import productGallery from './components/ProductGallery/productGallery.js';
import productAccordion from './components/ProductAccordion/productAccordion.js';
import productSizeSelect from "./components/Variations/variations.js";
import beddingComponents from './components/BeddingComponents/bedding-components.js'
import sliderHero from "./blocks/Hero/hero.js";
import sliderAbout from "./blocks/ThreeImages/three-images.js";
import smoothScroll from "./components/SmoothScroll/smoothScroll.js";
import tabsCategory from "./components/Catalog/tabs-category.js";

document.addEventListener('DOMContentLoaded', () => {

    smoothScroll();
    sliderProducts();
    productAccordion();
    // productSizeSelect();
    beddingComponents();
    sliderHero();
    sliderAbout();
    tabsCategory();
    productGallery();

});
