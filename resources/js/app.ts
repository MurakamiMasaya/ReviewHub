import { createApp } from "vue";
import SwitchingHumburger from "./components/SwitchingHumburger.vue"
import HeaderSlideShow from "./components/HeaderSlideShow.vue"
import FooterSlideShow from "./components/FooterSlideShow.vue"

createApp({
    components:{
        // SwitchingReviewArea,
        SwitchingHumburger,
        HeaderSlideShow,
        FooterSlideShow
    }
}).mount('#app')