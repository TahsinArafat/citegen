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
                // APA format: Retrieved Month Day, Year, Time
                accessedDate = 'Retrieved ' + new Intl.DateTimeFormat('en-US', { month: 'long', day: 'numeric', year: 'numeric' }).format(date) + ', ' + time;
            } else {
                // MLA format: Accessed Day Month Year, Time
                accessedDate = 'Accessed ' + new Intl.DateTimeFormat('en-GB', { day: 'numeric', month: 'long', year: 'numeric' }).format(date) + ', ' + time;
            }
            const fullHtml = baseHtml + ' ' + accessedDate + '.';
            const fullText = baseText + ' ' + accessedDate + '.';
            citationP.innerHTML = fullHtml;
            wrapper.dataset.fullText = fullText;
        }
        
        select.addEventListener('change', updateCitation);
        updateCitation(); // Initial update
        
        copyButton.addEventListener('click', function() {
            const text = wrapper.dataset.fullText;
            navigator.clipboard.writeText(text).then(() => {
                const originalText = copyButton.textContent;
                copyButton.textContent = 'Copied!';
                setTimeout(() => {
                    copyButton.textContent = originalText;
                }, 2000);
            }).catch(() => {
                alert('Failed to copy citation');
            });
        });
    });
});