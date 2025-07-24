document.addEventListener('DOMContentLoaded', function() {
    const wrappers = document.querySelectorAll('.citegen-citation-wrapper');
    wrappers.forEach(wrapper => {
        const select = wrapper.querySelector('.citegen-style-select');
        const citationP = wrapper.querySelector('.citegen-citation');
        const copyButton = wrapper.querySelector('.citegen-copy-button');
        
        function updateCitation() {
            const style = select.value;
            const baseHtml = wrapper.dataset[style + 'Html'];
            const baseText = wrapper.dataset[style + 'Text'];
            const date = new Date();
            const time = date.toLocaleTimeString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
            let accessedDate;
            if (style === 'apa') {
                accessedDate = new Intl.DateTimeFormat('en-US', { month: 'long', day: 'numeric', year: 'numeric' }).format(date) + ', ' + time;
            } else {
                accessedDate = new Intl.DateTimeFormat('en-GB', { day: 'numeric', month: 'long', year: 'numeric' }).format(date) + ', ' + time;
            }
            const fullHtml = baseHtml + ' Accessed ' + accessedDate + '.';
            const fullText = baseText + ' Accessed ' + accessedDate + '.';
            citationP.innerHTML = fullHtml;
            wrapper.dataset.fullText = fullText;
        }
        
        select.addEventListener('change', updateCitation);
        updateCitation(); // Initial update
        
        copyButton.addEventListener('click', function() {
            const text = wrapper.dataset.fullText;
            navigator.clipboard.writeText(text).then(() => {
                copyButton.textContent = 'Copied!';
                setTimeout(() => {
                    copyButton.textContent = 'Copy';
                }, 2000);
            }).catch(() => {
                alert('Failed to copy citation');
            });
        });
    });
});