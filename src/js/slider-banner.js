document.addEventListener("DOMContentLoaded", function () {
    console.log("=== PROGRAM SLIDER INIT START ===");

    const slider = document.querySelector(".program-slider .slider");
    const tabs = document.querySelectorAll(".program-tabs .program-tab");

    console.log("✔ Slider element:", slider);
    console.log("✔ Tabs found:", tabs.length);

    if (!slider) {
        console.error("❌ Slider not found!");
        return;
    }
    if (typeof Flickity === "undefined") {
        console.error("❌ Flickity is NOT LOADED!");
        return;
    }

    // INIT FLICKITY
    const flkty = new Flickity(slider, {
        cellAlign: "center",
        wrapAround: true,
        pageDots: false,
        prevNextButtons: true,
        adaptiveHeight: true
    });

    console.log("✔ Flickity instance created:", flkty);

    // CLICK TAB -> GO TO SLIDE
    tabs.forEach((tab, index) => {
        tab.addEventListener("click", () => {
            console.log("➡ Tab clicked index:", index);

            flkty.select(index);

            tabs.forEach(t => t.classList.remove("is-active"));
            tab.classList.add("is-active");

            console.log("✔ Tab activated:", tab.innerText);
        });
    });

    // SLIDE CHANGE -> UPDATE TAB
    flkty.on("change", (index) => {
        console.log("🎯 Flickity changed to slide:", index);

        tabs.forEach(t => t.classList.remove("is-active"));
        if (tabs[index]) {
            tabs[index].classList.add("is-active");
            console.log("✔ Tab synced:", tabs[index].innerText);
        } else {
            console.warn("⚠ No tab found for index:", index);
        }
    });

// dOT MB
    const slidermb = document.querySelector('.program-slider .slider');
    const dots = document.querySelectorAll('.mobile-dots .dot');

    if (slidermb && typeof Flickity !== 'undefined') {
        const flk = Flickity.data(slider);

        // Khi đổi slide → update dot
        flk.on('change', i => {
            dots.forEach((d, index) => {
                d.classList.toggle('is-active', index === i);
            });
        });

        // Khi click dot → đổi slide
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => flk.select(index));
        });
    }
    console.log("=== PROGRAM SLIDER INIT END ===");
});

