// If absolute URL from the remote server is provided, configure the CORS
// header on that server.
// var url =
//     "https://raw.githubusercontent.com/mozilla/pdf.js/ba2edeae/web/compressed.tracemonkey-pldi-09.pdf";
var url = $("#the-canvas").data("url");
console.log(url);

var pdfDoc = null,
    pageNum = 1,
    pageRendering = false,
    pageNumPending = null,
    scale = 0.8,
    canvas = document.getElementById("the-canvas"),
    ctx = canvas.getContext("2d");

/**
 * Get page info from document, resize canvas accordingly, and render page.
 * @param num Page number.
 */
function renderPage(num) {
    pageRendering = true;
    // Using promise to fetch the page
    pdfDoc.getPage(num).then(function (page) {
        var viewport = page.getViewport({
            scale: scale,
        });
        canvas.height = viewport.height;
        canvas.width = viewport.width;

        // Render PDF page into canvas context
        var renderContext = {
            canvasContext: ctx,
            viewport: viewport,
        };
        var renderTask = page.render(renderContext);

        // Wait for rendering to finish
        renderTask.promise.then(function () {
            pageRendering = false;
            if (pageNumPending !== null) {
                // New page rendering is pending
                renderPage(pageNumPending);
                pageNumPending = null;
            }
        });
    });

    // Update page counters
    document.getElementById("page_num").textContent = num;
    document.getElementById("page_num2").textContent = num;
}

/**
 * If another page rendering in progress, waits until the rendering is
 * finised. Otherwise, executes rendering immediately.
 */
function queueRenderPage(num) {
    if (pageRendering) {
        pageNumPending = num;
    } else {
        renderPage(num);
    }
}

/**
 * Displays previous page.
 */
function onPrevPage() {
    if (pageNum <= 1) {
        return;
    }
    pageNum--;
    queueRenderPage(pageNum);
}
document.getElementById("prev").addEventListener("click", onPrevPage);
document.getElementById("prev2").addEventListener("click", onPrevPage);

/**
 * Displays next page.
 */
function onNextPage() {
    if (pageNum >= pdfDoc.numPages) {
        return;
    }
    pageNum++;
    queueRenderPage(pageNum);
}
document.getElementById("next").addEventListener("click", onNextPage);
document.getElementById("next2").addEventListener("click", onNextPage);

/**
 * Asynchronously downloads PDF.
 */
pdfjsLib.getDocument(url).promise.then(function (pdfDoc_) {
    pdfDoc = pdfDoc_;
    document.getElementById("page_count").textContent = pdfDoc.numPages;
    document.getElementById("page_count2").textContent = pdfDoc.numPages;

    // Initial/first page rendering
    renderPage(pageNum);
});

function onZoomIn() {
    if (scale >= 2) {
        return;
    }
    scale += 0.1;
    queueRenderPage(pageNum);
}
document.getElementById("zoom-in").addEventListener("click", onZoomIn);

/**
 * Zoom out on the PDF.
 */
function onZoomOut() {
    if (scale <= 0.5) {
        return;
    }
    scale -= 0.1;
    queueRenderPage(pageNum);
}
document.getElementById("zoom-out").addEventListener("click", onZoomOut);
