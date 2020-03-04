const options = {
    containers: ["#content"],
    cache: false
};

const swup = new Swup(
    options
);

swup.on('contentReplaced', function () {
    window.scrollTo(0, 0);
});
