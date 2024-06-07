window.onload = () => {

    const uploadFile = document.getElementById("upload-file");
    const uploadBth = document.getElementById("upload-bth");

    uploadBth.addEventListener("click", function () {
        uploadFile.click();
    });
}