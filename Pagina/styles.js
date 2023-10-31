const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link');
const btnUser = document.querySelector('.btn-user');
const iconClose = document.querySelector('.icon-close');


loginLink.onclick = () => {
    wrapper.classList.remove('active');
}

btnUser.onclick = () => {
    wrapper.classList.add('active-user');
}

iconClose.onclick = () => {
    wrapper.classList.remove('active-user');
}