import { createApp } from "vue";
import SwitchingHumburger from "./components/SwitchingHumburger.vue"
import HeaderSlideShow from "./components/HeaderSlideShow.vue"
import FooterSlideShow from "./components/FooterSlideShow.vue"
import TopImage from "./components/TopImage.vue"
import ReviewHubObject from "./components/ReviewHubObject.vue"
import SwitchingGr from "./components/SwitchingGr.vue"

createApp({
    components:{
        // SwitchingReviewArea,
        SwitchingHumburger,
        HeaderSlideShow,
        FooterSlideShow,
        TopImage,
        ReviewHubObject,
        SwitchingGr
    }
}).mount('#app')