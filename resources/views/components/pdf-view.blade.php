    <script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
    <!-- <script src="https://cdnjs.com/libraries/pdf.js"></script> -->

<div>
    <div class="flex gap-4 p-4 items-center">
        <x-button id="prev">Previous</x-button>
        <x-button id="next">Next</x-button>

        <x-badge label="Page:" class="ml-auto"/><x-badge id="page_num"/> / <x-badge id="page_count"/>
    </div>

    <!-- {{$pdf}} -->
    <canvas id="the-canvas"></canvas>
    

    <!-- <iframe id="pdf" src="{{$pdf}}#toolbar=0" data="toolbar=0" 
    type="application/pdf"
    width="100%" height="auto" style="aspect-ratio:1/1.4142"></iframe> -->
    <!-- <div class="bg-gray-300 p-4">
        <x-button onclick="savePdf(file)" class="w-max py-1 m-2">download</x-button>
        <x-button id="prev" class="w-max py-1 m-2">Previous</x-button>
        <x-button id="next" class="w-max py-1 m-2">Next</x-button>

        <span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>
    </div>

    <canvas id="the-canvas" width="100%"></canvas>
    <hr>
    <script src="https://unpkg.com/downloadjs@1.4.7"></script>
    <script type="text/javascript" src="https://unpkg.com/pdf-lib/dist/pdf-lib.min.js"></script> -->

</div>

<script differ>
    // If absolute URL from the remote server is provided, configure the CORS
    // header on that server.
    var url = '{{$pdf}}';

    // Loaded via <script> tag, create shortcut to access PDF.js exports.
    var pdfjsLib = window['pdfjs-dist/build/pdf'];

    // The workerSrc property shall be specified.
    pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';

    var pdfDoc = null,
        pageNum = 1,
        pageRendering = false,
        pageNumPending = null,
        scale = 2,
        canvas = document.getElementById('the-canvas'),
        ctx = canvas.getContext('2d');

    /**
     * Get page info from document, resize canvas accordingly, and render page.
     * @param num Page number.
     */
    function renderPage(num) {
        pageRendering = true;
        // Using promise to fetch the page
        pdfDoc.getPage(num).then(function(page) {
            var viewport = page.getViewport({scale: scale});
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            // Render PDF page into canvas context
            var renderContext = {
            canvasContext: ctx,
            viewport: viewport
            };
            var renderTask = page.render(renderContext);

            // Wait for rendering to finish
            renderTask.promise.then(function() {
            pageRendering = false;
            if (pageNumPending !== null) {
                // New page rendering is pending
                renderPage(pageNumPending);
                pageNumPending = null;
            }
            });
        });

        // Update page counters
        document.getElementById('page_num').textContent = num;
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
    document.getElementById('prev').addEventListener('click', onPrevPage);

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
    document.getElementById('next').addEventListener('click', onNextPage);

    /**
     * Asynchronously downloads PDF.
     */
    pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
        pdfDoc = pdfDoc_;
        document.getElementById('page_count').textContent = pdfDoc.numPages;

        // Initial/first page rendering
        renderPage(pageNum);
    });




</script>
<!--
<script type="text/javascript">
    const { degrees, PDFDocument, rgb, StandardFonts } = PDFLib
    createPdf();

    async function createPdf() {
        const url = '{{$pdf}}'
        const existingPdfBytes = await fetch(url).then(res => res.arrayBuffer())

        // Load a PDFDocument from the existing PDF bytes
        const pdfDoc = await PDFDocument.load(existingPdfBytes)

        // Embed the Helvetica font
        const helveticaFont = await pdfDoc.embedFont(StandardFonts.Helvetica)

        // Get the first page of the document
        const pages = pdfDoc.getPages()
        const firstPage = pages[0]

        // Get the width and height of the first page
        const { width, height } = firstPage.getSize()

        // Draw a string of text diagonally across the first page
        firstPage.drawText('This text was added with JavaScript!', {
            x: 5,
            y: height / 2 + 300,
            size: 50,
            font: helveticaFont,
            color: rgb(0.95, 0.1, 0.1),
            rotate: degrees(-45),
        })

        // Serialize the PDFDocument to bytes (a Uint8Array)
        const pdfBytes = await pdfDoc.saveAsBase64()
        document.getElementById('pdf').src = pdfBytes;
    }


</script> -->
