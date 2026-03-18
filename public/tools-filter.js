function filterTools(category) {
    const tools = document.querySelectorAll('#tools-list article');
    tools.forEach(tool => {
        if (category === 'all' || tool.dataset.category === category) {
            tool.style.display = '';
        } else {
            tool.style.display = 'none';
        }
    });
}
