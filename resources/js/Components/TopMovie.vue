<script setup>

const props = defineProps({
    image: String,
    title: String,
    titleEng: String,
    href: String,
})

</script>

<template>
    <div class="flex flex-row gap-[15px] w-full h-[500px] group overflow-hidden">
        <div style="background: linear-gradient(98deg, #171532 0%, #171532 31.21%, rgba(0, 0, 0, 0.00) 56.26%);"
            class="w-full h-full"></div>
        <!-- Title Holder -->
        <span class="flex gap-[5px] absolute right-[5px] bottom-[5px]">
            <slot name="badges"></slot>
            <p>Kollide Kompanii</p>
            <p>Monsters, INC.</p>
            <p>Animeeritud film mis avastab Monstropolise maailma, kus koletised toodavad linna energiat hirmutades
                lapsi öösel.</p>
            <div>
                <button>Osta Pilet</button>
                <button>Uuri Veel</button>
            </div>
        </span>
    </div>
</template>