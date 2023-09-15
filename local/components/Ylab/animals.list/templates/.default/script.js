BX.ready(function () {
    const deleteBtn = document.querySelector('.animals.list-delete-btn');
    const actions = document.querySelectorAll('.animals.list-action');
    const table = document.querySelector('.animals.list table');

    const handleDeleteClick = () => {
        const ids = [];

        // Собираем ID выбранных строк
        table.querySelectorAll('tbody tr.selected').forEach((tr) => {
            ids.push(tr.getAttribute('data-id'));
        });

        if (ids.length > 0) {
            // Вызываем обработчик удаления из компонента
            BX.ajax.runComponentAction('animals.list', 'deleteItems', {
                mode: 'ajax',
                data: {ids},
            }).then(() => {
                // Обновляем страницу после удаления
                window.location.reload();
            });
        }
    };

    // Обработчик клика на кнопке удаления
    deleteBtn.addEventListener('click', handleDeleteClick);

    // Обработчик клика на элементах меню действий
    actions.forEach((action) => {
        action.addEventListener('click', (event) => {
            event.stopPropagation();

            const tr = event.target.closest('tr');
            tr.classList.toggle('selected');
        });
    });
});
