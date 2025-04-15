function downloadPDF() {
    const { jsPDF } = window.jspdf;

    const table = document.querySelector("#score-table table");
    const actionHeaders = table.querySelectorAll("th:last-child, td:last-child");
    actionHeaders.forEach(el => el.style.display = 'none');

    html2canvas(table).then(canvas => {
        const doc = new jsPDF();
        const imgData = canvas.toDataURL("image/png");
        const imgProps = doc.getImageProperties(imgData);
        const pdfWidth = doc.internal.pageSize.getWidth();
        const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

        doc.addImage(imgData, "PNG", 10, 10, pdfWidth - 20, pdfHeight + 10);
        doc.save("Test_Score_History.pdf");

        actionHeaders.forEach(el => el.style.display = '');
    });
}
