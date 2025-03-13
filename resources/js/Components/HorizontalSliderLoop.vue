<script setup>

const props = defineProps({
    images: Array
})

</script>

<template>
    <div class="scroll imgBox" style="--time:25s">
        <div>
            <img v-for="(img, index) in props.images" :key="index" :src="img" :alt="'img-'+(index+1)">
        </div>
        <div>
            <img v-for="(img, index) in props.images" :key="index" :src="img" :alt="'img-'+(index+1)">
        </div>
    </div>
</template>

<style scoped>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: #000;
    flex-direction: column;
}

.scroll {
    position: relative;
    display: flex;
    overflow: hidden;
    width: 1200px;
    mask-image: linear-gradient(90deg, transparent, #fff 20%, #fff 80%, transparent);
    -webkit-mask-image: linear-gradient(90deg, transparent, #fff 20%, #fff 80%, transparent)
}

.scroll div {
    white-space: nowrap;
    animation: scroll var(--time) linear infinite;
    animation-delay: calc(var(--time)*-1);

}

.scroll div:nth-child(2) {
    animation: scroll2 var(--time) linear infinite;
    animation-delay: calc(var(--time)/-2);
}

@keyframes scroll {
    0% {
        transform: translateX(100%);
    }

    100% {
        transform: translateX(-100%);
    }
}

@keyframes scroll2 {
    0% {
        transform: translateX(0);
    }

    100% {
        transform: translateX(-200%);
    }
}

.scroll div span {
    display: inline-flex;
    margin: 10px;
    letter-spacing: 0.2em;
    background: #333;
    color: #fff;
    padding: 5px 10px;
    border-radius: 5px;
    transition: 0.5s;
}

.scroll div span:hover {
    background: #3fd2f9;
    cursor: pointer;
}

.imgBox div {
    display: flex;
    align-items: center;
    justify-content: center;
}

.imgBox img {
    height: 70px;
    min-width: 100px;
    max-height: 50px;
    object-fit: contain;
    margin-left: 30px;
    margin-right: 30px;
}

@media(max-width: 1450px) {
    .scroll {
        width: 900px !important;
    }
}
@media(max-width: 1024px) {
    .scroll {
        width: calc(100vh*70/100) !important;
    }
    .imgBox img {
        min-width: 70px !important;
        max-height: 40px !important;
    }
}
@media(max-width: 710px) {
    .scroll {
        width: calc(100vh/2) !important;
    }
}
@media(max-width: 550px) {
    .scroll {
        width: calc(100vh*40/100) !important;
    }
}
</style>
