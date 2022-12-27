
    const searchBar = document.querySelector(".search_input_scroll");
    const searchBar2 = document.querySelector(".search");
    const DELAY_AFTER_ANIMATION = 1500;
    const PLACEHOLDERS = [
        "Laptop gaming",
        "Điện thoại",
        "PC",
        "Màn hình",
        "Tai nghe",
        "Camera"
    ];

    const getRandomDelayBetween = (min, max) =>
        Math.floor(Math.random() * (max - min + 1) + min);

    const setPlaceholder = (inputNode, placeholder) => {
        if(inputNode){
            inputNode.setAttribute("placeholder", placeholder);
        }
    };

    const animateLetters = (
        currentLetters,
        remainingLetters,
        inputNode,
        onAnimationEnd
    ) => {
        if (!remainingLetters.length) {
            return (
                typeof onAnimationEnd === "function" &&
                onAnimationEnd(currentLetters.join(""), inputNode)
            );
        }

        currentLetters.push(remainingLetters.shift());

        setTimeout(() => {
            setPlaceholder(inputNode, currentLetters.join(""));
            animateLetters(currentLetters, remainingLetters, inputNode, onAnimationEnd);
        }, getRandomDelayBetween(50, 90));
    };

    const animatePlaceholder = (inputNode, placeholder, onAnimationEnd) => {
        animateLetters([], placeholder.split(""), inputNode, onAnimationEnd);
    };

    const onAnimationEnd = (placeholder, inputNode) => {
        setTimeout(() => {
            let newPlaceholder =
                PLACEHOLDERS[Math.floor(Math.random() * PLACEHOLDERS.length)];
            do {
                newPlaceholder =
                    PLACEHOLDERS[Math.floor(Math.random() * PLACEHOLDERS.length)];
            } while (placeholder === newPlaceholder);

            animatePlaceholder(inputNode, newPlaceholder, onAnimationEnd);
        }, DELAY_AFTER_ANIMATION);
    };

    window.addEventListener("load", () => {
        // If we want multiple different placeholders, we pass our callback
        animatePlaceholder(
            searchBar,
            PLACEHOLDERS[0],
            onAnimationEnd
        );
        animatePlaceholder(
            searchBar2,
            PLACEHOLDERS[0],
            onAnimationEnd
        );
    });
