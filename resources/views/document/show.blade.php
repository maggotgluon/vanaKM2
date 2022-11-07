<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$documents->Doc_Name}}
        </h2>
        <x-button class="py-0" href="{{url()->previous()}}">{{__('Back')}}</x-button>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex flex-col">

                        <p>
                            {{$documents->Doc_Type}}
                        </p>

                        <p>
                            <span class="text-sm ">last update {{$documents->updated_at}}</span>
                        </p>

                        <br>

                    <!-- {{$dar}} -->
                    <!-- {{ Auth::user()->id }} -->
                    <hr>
                    <!-- <iframe src="{{asset($dar->Doc_Location)}}" width="100%" height="500px"> -->

                    <script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>

                    {{$documents->Doc_Location}}
                    <div class="bg-gray-300 p-4">
                        <x-button onclick="savePdf(file)" class="w-max py-1 m-2">download</x-button>
                        <x-button id="prev" class="w-max py-1 m-2">Previous</x-button>
                        <x-button id="next" class="w-max py-1 m-2">Next</x-button>

                        <span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>
                    </div>
                    {{asset($documents->Doc_Location)}}
                    <canvas id="the-canvas" width="100%"></canvas>
                    <hr>
                    <script src="https://unpkg.com/downloadjs@1.4.7"></script>
                    <script type="text/javascript" src="https://unpkg.com/pdf-lib/dist/pdf-lib.min.js"></script>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script type="text/javascript">

    const {
        degrees,
        PDFDocument,
        rgb,
        StandardFonts
    } = PDFLib

    const file = "{{asset($documents->Doc_Location)}}"
    // document.querySelector('#frame').src = url
    modifyPdf(file)
    async function modifyPdf(url) {
        console.log(url)
        const existingPdfBytes = await fetch(url).then(res => res.arrayBuffer())

        const pdfDoc = await PDFDocument.load(existingPdfBytes)
        const helveticaFont = await pdfDoc.embedFont(StandardFonts.Helvetica)
        pdfDoc.setTitle
        const pages = pdfDoc.getPages('test title')

        const {width,height} = pages[0].getSize()
        for(page in pages){
            console.log(page);
            pages[page].drawText('Document under Controlled', {
                x: width/2 -200,
                y: 10,
                size: 70,
                font: helveticaFont,
                color: rgb(0.95, 0.1, 0.1),
                opacity:0.5,
                rotate: degrees(60),
            })

            pages[page].drawText('For view only', {
                x: width/2 -200,
                y: height/2 -200,
                size: 70,
                font: helveticaFont,
                color: rgb(0.95, 0.1, 0.1),
                opacity:0.5,
                rotate: degrees(60),
            })
        }

        /********************** Print Metadata **********************/

        console.log('Title:', pdfDoc.getTitle());
        console.log('Author:', pdfDoc.getAuthor());
        console.log('Subject:', pdfDoc.getSubject());
        console.log('Creator:', pdfDoc.getCreator());
        console.log('Keywords:', pdfDoc.getKeywords());
        console.log('Producer:', pdfDoc.getProducer());
        console.log('Creation Date:', pdfDoc.getCreationDate());
        console.log('Modification Date:', pdfDoc.getModificationDate());

        /********************** Export PDF **********************/

        const pdfBytes = await pdfDoc.save()
        // renderInIframe(pdfBytes);

        console.log('render')
        const blob = new Blob([pdfBytes], {
            type: 'application/pdf'
        });
        const blobUrl = URL.createObjectURL(blob);
        // document.querySelector('#frame').src = blobUrl;
        // console.log()
        showPDF(blobUrl,'the-canvas')

        function showPDF (file,canvasContainer){
            // Loaded via <script> tag, create shortcut to access PDF.js exports.
            var pdfjsLib = window['pdfjs-dist/build/pdf'];

            // The workerSrc property shall be specified.
            pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';

            var pdfDoc = null,
                pageNum = 1,
                pageRendering = false,
                pageNumPending = null,
                scale = 5,
                canvas = document.getElementById(canvasContainer),
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
            pdfjsLib.getDocument(file).promise.then(function(pdfDoc_) {
                pdfDoc = pdfDoc_;
                document.getElementById('page_count').textContent = pdfDoc.numPages;

                // Initial/first page rendering
                renderPage(pageNum);
            });
        }
        return blobUrl
    }
    async function savePdf(url) {
        // console.log(url)
        const existingPdfBytes = await fetch(url).then(res => res.arrayBuffer())

        const pdfDoc = await PDFDocument.load(existingPdfBytes)
        const helveticaFont = await pdfDoc.embedFont(StandardFonts.Helvetica)
        pdfDoc.setTitle
        const pages = pdfDoc.getPages('test title')

        const {width,height} = pages[0].getSize()
        for(page in pages){
            console.log(page);
            pages[page].drawText('you just hit save', {
                x: width/2 - 300,
                y: height/2 + 300,
                size: 70,
                font: helveticaFont,
                color: rgb(0.95, 0.1, 0.1),
                opacity:0.5,
                rotate: degrees(-45),
            })
        }

        /********************** Print Metadata **********************/

        console.log('Save');

        /********************** Export PDF **********************/

        const pdfBytes = await pdfDoc.save()
        const saveName="{{$documents->Doc_Name}}"+"-Rev"+"{{$documents->Doc_ver}}"
        console.log("file",saveName)
        download(pdfBytes, saveName, "application/pdf")

        return pdfBytes
    }

</script>


