// for sidebar toggle
const menuItems = document.querySelectorAll('.menu-item');

// for message toggle
const messagesNotifications =  document.querySelector('#message-notifications');
const messages = document.querySelector('.messages');
// for search message
const message = document.querySelectorAll('.message');
const messageSearch = document.querySelector('#history-donation-search');


// side bar notifications
// remove active class from all menu items
const changeActiveItemns = () => {
    menuItems.forEach(item => {
        item.classList.remove('active');
    })
}


menuItems.forEach(item => {
    item.addEventListener('click', () => {
        changeActiveItemns();
        item.classList.add('active');
        if (item.id != 'notifications') {
            document.querySelector('.notifications-popup').
                style.display = 'none';
        } else {
            document.querySelector('.notifications-popup').
                style.display = 'block';
            document.querySelector('#notifications .notification-count').
                style.display = 'none';
        }

    })
})

// side bar messages
messagesNotifications.addEventListener('click', () => {
    messages.style.boxShadow = '0 0 1rem var(--color-primary)';
    messagesNotifications.querySelector('.notification-count').
        style.display = 'none';
    setTimeout(() => {
        messages.style.boxShadow = 'none';
    }, 2000);
})


// search history message notifications
const searchMessage = () => {
    const val =  messageSearch.value.toLowerCase();
    //console.log(val);
    message.forEach(user => {
        let name = user.querySelector('h5').textContent.toLowerCase();
        if (name.indexOf(val) != -1) {
            user.style.display = 'flex';
        } else {
            user.style.display = 'none';
        }
    })
}
messageSearch.addEventListener('keyup', searchMessage);
