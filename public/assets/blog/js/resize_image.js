

class Resize extends FileReader {
    constructor(file) {
        super(onload)
        this.file = file;
        this.newFile;
        this.typeImage = file.type;
        this.nameImage;
        this.newFileImage;
        this.imageUrl = '';
        this.setname(file.name);
    }
    async resize(size = 100, quality = 100, element) {
        let fileNew;
        const reader = new FileReader();
        super.readAsDataURL(this.file);
        this.onload = function (event) {

            const imgUrl = event.target.result;
            const image = document.createElement('img');
            image.src = imgUrl;
            image.onload = function (e) {
                const canvas = document.createElement('canvas');
                canvas.width = size;
                const ratio = size / e.target.width;
                canvas.height = e.target.height * ratio;
                const context = canvas.getContext('2d');
                context.drawImage(image, 0, 0, canvas.width, canvas.height);
                this.imageUrl = context.canvas.toDataURL(this.typeImage, quality);
                const newImage = document.createElement('img');
                newImage.src = this.imageUrl;
                element.src = this.imageUrl;
              return canvas.toBlob(blob => {
                     new File([blob], element.name, { type: blob.type });
                    
                })
            }
        }
    }
    send(url, token, typeAds, file) {
        const form = new FormData();
        form.append('file', this.newFile);
        form.append('type', typeAds)
        console.log(file)
        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token
            },
            credentials: 'same-origin',
            body: form
        }).then(response => response.json())
        .then(data => console.log(data)).catch(err => console.log(err))
    }
    preview(element) {
        element.src = this.imageUrl;
    }
    setname(name) {
        this.nameImage = name;
    }
    get getname() {
        return this.nameImage;
    }
}