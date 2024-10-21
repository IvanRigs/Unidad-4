const closeModalNewProduct = () => {
    const myModal = bootstrap.Modal.getOrCreateInstance('#newProduct')
    myModal.hide();
};

const openModalnewProduct = () => {
    const myModal = bootstrap.Modal.getOrCreateInstance('#newProduct')
    myModal.show();
};

const closeModalEditProduct = () => {
    const myModal = bootstrap.Modal.getOrCreateInstance('#editProduct')
    myModal.hide();
};

const openModalEditProduct = () => {
    const myModal = bootstrap.Modal.getOrCreateInstance('#editProduct')
    myModal.show();
};


console.log('Hola');