import sliderProducts from './components/ProductsSlider/ProductsSlider.js';
import productGallery from './components/ProductGallery/productGallery.js';
import productAccordion from './components/ProductAccordion/productAccordion.js';
import variationsController from './components/Variations/variations.js';
import productSizeSelect from "./components/Variations/variations.js";

document.addEventListener('DOMContentLoaded', () => {

    sliderProducts();
    productGallery();
    productAccordion();
    // variationsController()
    productSizeSelect();

});
